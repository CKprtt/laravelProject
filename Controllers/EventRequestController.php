<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRequest;

class EventRequestController extends Controller
{
    // Artist: ฟอร์มส่งคำร้อง
    public function create()
    {
        return view('artist.hall_request');
    }

    // Artist: บันทึกคำร้องใหม่
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'proposal'   => 'nullable|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'poster'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'type_hall'  => 'required|in:Yes,No',
        ]);

        $posterUrl = null;
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $posterUrl = asset('storage/' . $path);
        }

        EventRequest::create([
            'event_name'   => $request->event_name,
            'proposal'     => $request->proposal,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
            'poster_path'  => $posterUrl,
            'type_hall'    => $request->type_hall,
            'event_status' => 'pending',
            'artist_id'    => 1, 
        ]);

        return redirect()->route('artist.requests')->with('success', 'ส่งคำร้องเรียบร้อยแล้ว');
    }

    // Artist: แสดงคำร้องของฉัน
    public function myRequests()
    {
        $requests = EventRequest::all();
        return view('artist.my_requests', compact('requests'));
    }

    // Admin: แสดงคำร้องทั้งหมด
    public function index()
    {
        $requests = EventRequest::all();
        return view('admin.admin_requests', compact('requests'));
    }

    // Admin: อนุมัติ
    public function approve($id)
    {
        $req = EventRequest::findOrFail($id);
        $req->update(['event_status' => 'approved']);
        return redirect()->back()->with('success', 'อนุมัติแล้ว');
    }

    // Admin: ปฏิเสธ
    public function reject($id)
    {
        $req = EventRequest::findOrFail($id);
        $req->update(['event_status' => 'rejected']);
        return redirect()->back()->with('error', 'ปฏิเสธแล้ว');
    }

    // Artist: ลบคำร้อง
    public function destroy($id)
    {
        $req = EventRequest::findOrFail($id);
        $req->delete();
        return redirect()->route('artist.requests')->with('success', 'ลบคำร้องเรียบร้อยแล้ว');
    }
}