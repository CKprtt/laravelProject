<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\ArtistProfile;
use App\Models\Event;

class EventRequestController extends Controller
{


    // อันนี้ของ Artist 

    // หน้า คำร้องของจัดงาน
    public function my()
    {
        $requests = EventRequest::orderBy('created_at', 'desc')->get();
        return view('artist.my_requests', compact('requests'));
    }

    // หน้าฟอร์มจัดงาน
    public function create()
    {
        return view('artist.event_request');
    }

    // เพิ่มขอลงดาต้าเบส
    public function insert(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'proposal'   => 'nullable|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'poster'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'type_hall'  => 'required|in:Yes,No',
        ]);

        $artist = ArtistProfile::where('users_id', Auth::id())->first();

        if (!$artist) {
            return redirect()->back()->with('error', 'ไม่พบโปรไฟล์ศิลปินของคุณ');
        }

        // อัปโหลดรูป
        $posterUrl = null;
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $posterUrl = asset('storage/' . $path);
        }

        // บันทึกลงดาต้าเบส
        EventRequest::create([
            'event_name'   => $request->event_name,
            'proposal'     => $request->proposal,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
            'poster_path'  => $posterUrl,
            'type_hall'    => $request->type_hall,
            'event_status' => 'pending',
            'artist_id'    => $artist->artist_id,
        ]);

        return redirect()->route('artist.my')->with('success', 'ส่งคำร้องเรียบร้อยแล้ว');
    }

    // แก้ไขคำขอ
    public function edit($id)
    {
        $event = EventRequest::find($id);
        return view('artist.edit_request', compact('event'));
    }

    // บันทึกแก้ไขคำขอ
    public function update(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'proposal'   => 'nullable|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'poster'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'type_hall'  => 'required|in:Yes,No',
        ]);

        $req = EventRequest::findOrFail($id);

        // อัปรูปใหม่
        $posterUrl = $req->poster_path;
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $posterUrl = asset('storage/' . $path);
        }

        // อัปเดตข้อมูล
        $req->update([
            'event_name'  => $request->event_name,
            'proposal'    => $request->proposal,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'poster_path' => $posterUrl,
            'type_hall'   => $request->type_hall,
        ]);

        return redirect()->route('artist.my')->with('success', 'แก้ไขคำร้องเรียบร้อยแล้ว');
    }

    // ลบคำขอ
    public function destroy($id)
    {
        $req = EventRequest::findOrFail($id);
        $req->delete();
        return redirect()->route('artist.my')->with('success', 'ลบคำร้องเรียบร้อยแล้ว');
    }

    // อันนี้ของ Admin 

    // หน้าคำขอ จัดงาน
    public function adminIndex()
    {
        $requests = EventRequest::all();
        return view('admin.admin_E_requests', compact('requests'));
    }

    // อนุมัติ
    public function approve($id)
    {
        $req = EventRequest::findOrFail($id);
        $req->update(['event_status' => 'approved']);

        Event::create([
            'events_name' => $req->event_name,
            'description' => $req->proposal,
            'poster_path' => $req->poster_path,
            'start_date'  => $req->start_date,
            'end_date'    => $req->end_date,
            'type_hall'   => $req->type_hall,
        ]);

        return redirect()->back()->with('success', 'อนุมัติคำร้องเรียบร้อยแล้ว และเพิ่มในหน้า Home แล้ว');
    }

    // ปฏิเสธ
    public function unapprove($id)
    {
        $req = EventRequest::findOrFail($id);
        $req->update(['event_status' => 'rejected']);
        return redirect()->back()->with('reject');
    }
}
