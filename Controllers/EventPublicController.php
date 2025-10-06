<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\HallZone;
use App\Models\TicketBooking;
use App\Models\Souvenir;
use App\Models\EventRequest;
use App\Models\ArtistProfile;

use Illuminate\Support\Facades\Auth;


class EventPublicController extends Controller
{
    
    public function indexEvent()
    {
        // Yes = ใช้ Hall, No = ไม่ใช้ Hall (นิทรรศการ)
        $hallEvents    = Event::where('type_hall', 'Yes')->orderBy('start_at', 'asc')->get();
        $nonHallEvents = Event::where('type_hall', 'No')->orderBy('start_at', 'asc')->get();

        // เติมชื่อศิลปิน (artist_name) แบบไม่ join เหมือนเดิม
        foreach ($hallEvents as $e) {
            // 1) หา event_request ของงานนี้
            $er = EventRequest::where('event_id', $e->id)->first();

            // 2) ถ้ามี event_request → หา artist profile แล้วดึงชื่อ
            if ($er) {
                $e->artist_name = ArtistProfile::where('id', $er->artist_id)->value('artist_name');
                // ถ้าคอลัมน์ใน artist_profiles เป็น 'name' ให้เปลี่ยนเป็น ->value('name')
            } else {
                $e->artist_name = null;
            }
        }
        /*เพิ่มชนิดงานเพื่อให้หน้า index กรองข้อมูลก่อน ว่าใช้ hall หรือว่าไม่ได้ใช้ */
        /* Yes ใช้Hall  No ไม่ใช้Hall */

        foreach ($nonHallEvents as $e) {
            $er = EventRequest::where('event_id', $e->id)->first();
            if ($er) {
                $e->artist_name = ArtistProfile::where('id', $er->artist_id)->value('artist_name');
            } else {
                $e->artist_name = null;
            }
        }

        // ผูก "souvenirs พรีวิว" ให้แต่ละงาน (เอาเฉพาะที่ approved และยังเหลือ) โชว์สูงสุด 3 ชิ้น
        /*
        foreach ($events as $e) {
            $e->souvenirs = Souvenir::where('event_id', $e->id)
                ->where('status','approved')          // ถ้าตารางคุณใช้ 'souvenirs_status' ให้เปลี่ยนบรรทัดนี้
                ->where('quantity_left','>',0)
                ->orderBy('id')
                ->take(3) 
                ->get();
        }
        */
        return view('events.indexEvent', ['hallEvents'=> $hallEvents,'nonHallEvents' => $nonHallEvents,]);
    }

    
    public function showEvent($id)
    {
        $event = Event::findOrFail($id);

        $eventRequest = EventRequest::where('event_id', $event->id)->first();
        if ($eventRequest !== null) {
            $artistId = $eventRequest->artist_id; // ดึง artist_id จาก eventRequest
            $artistName = ArtistProfile::where('id', $artistId)->value('artist_name'); // ดึงชื่อศิลปิน
        } else {
            $artistName = null; // ถ้าไม่มี eventRequest ให้ค่า null
        }

        // อ่าน type_hall ก่อน ถ้าไม่มี ใช้ fallback หรือ 'No'
        $type = 'No'; // ตั้ง default
        if ($event->type_hall != null) {
            $type = $event->type_hall;
        } else if ($eventRequest != null && $eventRequest->type_hall != null) {
            $type = $eventRequest->type_hall;
        }
        // ตรวจสอบให้เป็น Yes/No
        if ($type != 'Yes' && $type != 'No') {
            $type = 'No';
        }
        // กำหนด boolean ว่าเป็นงานใน Hall หรือไม่
        $isHall = ($type == 'Yes');

        $zones = null; //  ตั้งให้เป็นว่างเมื่อไม่ใช่ Hall 
        $zoneA = null;
        $zoneB = null;
        $zoneC = null;

        if ($isHall) { // ทำงานเฉพาะเมื่อเป็น Hall
            $zones = HallZone::orderBy('id')->get();
            foreach ($zones as $zone) {
                $used = TicketBooking::where('event_id', $id)
                    ->where('zone_id', $zone->id)
                    ->sum('qty'); 
                $zone->used = (int) $used; /*00/40 เช็คยอดจอง -> เพิ่มขึ้น 01/40*/
                
                if ($zone->zones_name === 'A') {
                    $zoneA = $zone;
                } elseif ($zone->zones_name === 'B') {
                    $zoneB = $zone;
                } elseif ($zone->zones_name === 'C') {
                    $zoneC = $zone;
                }
            }
        }

        //--------------------------------------------------------------------------
         // ของที่ระลึกของงานนี้ (เฉพาะที่ approved และยังเหลือ)
        //$souvenirs = Souvenir::where('event_id', $event->id)
            //->where(function($q){ $q->where('status','approved'); })
            //->where('quantity_left','>',0)
            //->orderBy('id')->get();

        // ถ้าล็อกอินอยู่ เอาการจองของฉันงานนี้ (ไว้โชว์ข้อความ)
        $myBooking = null;
        if (Auth::check()) {
            $myBooking = TicketBooking::where('user_id', Auth::user()->id)
                        ->where('event_id', $event->id)
                        ->first();
        }
        return view('events.showEvent', compact('event','zones','myBooking','artistName', 'zoneA', 'zoneB', 'zoneC','isHall'));
    }
}