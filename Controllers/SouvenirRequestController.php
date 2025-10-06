<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Souvenir;

class SouvenirRequestController extends Controller
{
    // อันนี้ของ Artist 

    // หน้า คำร้องของที่ระลึก
    public function my()
    {
        $souvenirs = Souvenir::orderBy('created_at', 'desc')->get();
        return view('artist.my_souvenirs', compact('souvenirs'));
    }

    // หน้าฟอร์มของที่ระลึก
    public function create()
    {
        return view('artist.souvenir_request');
    }

    // เพิ่มคำขอลงดาต้าเบส
    public function insert(Request $request)
    {
        $request->validate([
            'souvenirs_name' => 'required|string|max:255',
            'quantity_left' => 'nullable|integer',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // อัปโหลดรูป
        $imgUrl = null;
        if ($request->hasFile('image_path')) {
            $imgPath = $request->file('image_path')->store('souvenirs', 'public');
            $imgUrl = asset('storage/' . $imgPath);
        }

        // บันทึกลงดาต้าเบส
        Souvenir::create([
            'souvenirs_name' => $request->souvenirs_name,
            'quantity_left' => $request->quantity_left,
            'description' => $request->description,
            'image_path' => $imgUrl,
            'souvenirs_status' => 'pending',
            'artist_id' => 1,
        ]);

        return redirect()->route('artist.S_my')->with('success', 'ส่งคำร้องเรียบร้อยแล้ว');
    }

    // แก้ไขคำขอ
    public function edit($id)
    {
        $souvenir = Souvenir::find($id);
        return view('artist.edit_souvenirs', compact('souvenir'));
    }

    // บันทึกแก้ไขคำขอ
    public function update(Request $request, $id)
    {
        $request->validate([
            'souvenirs_name' => 'required|string|max:255',
            'quantity_left' => 'nullable|integer',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $req = Souvenir::find($id);

        // อัปรูปใหม่
        $imgUrl = $req->image_path;
        if ($request->hasFile('image_path')) {
            $imgPath = $request->file('image_path')->store('souvenirs', 'public');
            $imgUrl = asset('storage/' . $imgPath);
        }

        // อัปเดตข้อมูล
        $req->update([
            'souvenirs_name' => $request->souvenirs_name,
            'quantity_left' => $request->quantity_left,
            'description' => $request->description,
            'image_path' => $imgUrl,
        ]);
        return redirect()->route('artist.S_my')->with('success', 'แก้ไขคำร้องเรียบร้อยแล้ว');
    }

    // ลบคำขอ
    public function destroy($id)
    {
        $req = Souvenir::find($id);
        $req->delete();
        return redirect()->route('artist.S_my')->with('success', 'ลบคำร้องเรียบร้อยแล้ว');
    }

    // อันนี้ของ Admin 

    // หน้าคำขอ ของที่ระลึก
    public function adminIndex()
    {
        $souvenirs = Souvenir::all();
        return view("admin.admin_S_requests", compact('souvenirs'));
    }

    // ยืนยัน
    public function approve($id)
    {
        $svn = Souvenir::findOrFail($id);
        $svn->update(['souvenirs_status' => 'approved']);
        return redirect()->back()->with('success');
    }

    // ปฏิเสธ
    public function unapprove($id)
    {
        $svn = Souvenir::findOrFail($id);
        $svn->update(['souvenirs_status' => 'rejected']);
        return redirect()->back()->with('reject');
    }
}