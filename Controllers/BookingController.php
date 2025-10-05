<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\HallZone;
use App\Models\TicketBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id; //ดึง ID ของผู้ใช้ที่ล็อกอิน มาใช้
        
        $bookings = TicketBooking::with(['event','zone','user']) //ดึงทุก relation พร้อมกันใน query เดียว
            ->where('user_id', $userId) //เฉพาะตั๋วที่ ผู้ใช้คนนี้เป็นเจ้าของ
            ->orderBy('created_at','desc') //เรียงลำดับจากล่าสุดมาแสดงก่อน
            ->get();

        // แยก 2 จากคอลัมน์ type_hall 
        $hallBookings = [];  //ตัวแปรเก็บตั๋วแยกประเภท
        $nonHallBookings = [];
        foreach ($bookings as $b) { 
            // ถ้าไม่มีค่า ให้ถือว่า 'No' (นิทรรศการ)
            $type = $b->type_hall ?? 'No'; //ไม่มีค่า กำหนดเป็น 'No'

            if ($type === 'Yes') {
                $hallBookings[] = $b;   // จองใน Hall
            } else {
                $nonHallBookings[] = $b;  // จองนอก Hall (นิทรรศการ)
            }
        }

        // โซนทั้งหมด (ใช้เฉพาะฝั่ง Hall)
        $zones = HallZone::orderBy('id')->get();

        return view('bookings.index', ['hallBookings' => $hallBookings, 'nonHallBookings' => $nonHallBookings,'zones'=> $zones,]);
    }

    /** จองตั๋ว (ครั้งละ 1 ที่นั่ง) */
    public function store(Request $request, $eventId)
{
    $userId = Auth::user()->id;
    $event  = Event::findOrFail($eventId);

    // ใช้ค่าจาก event โดยตรง (ไม่ใช้ค่าที่มาจากฟอร์ม)
    $typeHall = $event->type_hall ?? 'No';

    if ($typeHall === 'Yes') {
        // งานใน Hall → ต้องเลือกโซน
        $request->validate(['zone_id' => 'required|integer']);

        $zone   = HallZone::findOrFail($request->zone_id);
        $zoneId = $zone->id;

        // กันโซนเต็ม
        $used = (int) TicketBooking::where('event_id', $event->id)
                    ->where('zone_id', $zoneId)
                    ->sum('qty');

        if ($used >= (int) $zone->zones_capacity) {
            return back()->with('err', 'โซนนี้เต็มแล้ว');
        }
    } else {
        $zoneId = 0; // งานนอก Hall → ไม่ใช้โซน
    }

    // สร้าง tracking
    $tracking = 'BK' . date('ymd') . '-' . $event->id . '-' . Str::upper(Str::random(8));

    // บันทึก
    $b = new TicketBooking;
    $b->tracking_number = $tracking;
    $b->user_id = $userId;
    $b->event_id = $event->id;
    $b->zone_id = $zoneId;
    $b->type_hall = $typeHall;
    $b->qty = 1;
    $b->save();

    return redirect()->route('bookings.index')->with('ok', 'จองสำเร็จ: ' . $tracking);
}

    /** ยกเลิกการจอง */
    public function cancel($id)
    {
        $userId = Auth::user()->id;

        $booking = TicketBooking::where('id',$id)
            ->where('user_id',$userId)
            ->firstOrFail();

        $booking->delete();

        return back()->with('ok','ยกเลิกการจองแล้ว');
    }

    /** เปลี่ยนโซน (เฉพาะการจองแบบ Hall) */
    public function updateZone(Request $request, $id)
    {
        $request->validate(['zone_id' => 'required|integer']);

        $userId = Auth::user()->id;

        $booking = TicketBooking::where('id',$id)
            ->where('user_id',$userId)
            ->firstOrFail();

        // ถ้าเป็น “นอก Hall” ห้ามย้ายโซน 
        // เช็คก่อนว่าการจองนี้อยู่ใน Hall หรือไม่
        if ($booking->type_hall == null) {
            $type = 'No'; // ถ้าไม่มีค่า ให้ถือว่าเป็นงานนอก Hall
        } else {
            $type = $booking->type_hall; // ใช้ค่าที่มี
        }

        // ถ้าเป็นงานนอก Hall เราไม่สามารถเปลี่ยนโซนได้
        if ($type == 'No') {
            return back()->with('err', 'การจองนอก Hall ไม่มีโซนให้เปลี่ยน');
        }


        if ((int)$request->zone_id === (int)$booking->zone_id) {
            return back()->with('ok','บันทึกแล้ว (โซนเดิม)');
        }

        // ตรวจความจุโซนปลายทาง 
        $used = (int) TicketBooking::where('event_id', $booking->event_id)
                ->where('zone_id', $request->zone_id)
                ->where('id', '!=', $booking->id)
                ->sum('qty');

        $zone     = HallZone::findOrFail($request->zone_id);
        $capacity = (int) $zone->zones_capacity;

        if ($capacity <= 0 || $used >= $capacity) {
            return back()->with('err','โซนที่ต้องการเต็มแล้ว เลือกโซนอื่น');
        }

        $booking->zone_id = (int) $request->zone_id;
        $booking->save();

        return back()->with('ok','อัปเดตการจองเรียบร้อยแล้ว');
    }
}