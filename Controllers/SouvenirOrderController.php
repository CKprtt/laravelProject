<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Souvenir;
use App\Models\SouvenirOrder;

class SouvenirOrderController extends Controller
{

    // หน้าประวัติของที่ระลึก
    public function indexSouvenir()
    {
        $orders = SouvenirOrder::with('souvenir')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $souvenirs = Souvenir::where('status', 'approved')
            ->where('quantity_left', '>', 0)
            ->get();

        return view('souvenirs.indexSouvenir', compact('orders', 'souvenirs'));
    }

    // จองของที่ระลึก
    public function store(Request $request, $souvenirId)
    {
        $souvenir = Souvenir::findOrFail($souvenirId);

        if ($souvenir->status !== 'approved' || $souvenir->quantity_left < 1) {
            return back()->with('err', 'ของที่ระลึกไม่พร้อมจอง');
        }

        $order = new SouvenirOrder;
        $order->user_id = Auth::id();
        $order->souvenir_id = $souvenir->id;
        $order->quantity = 1;
        $order->save();

        $souvenir->quantity_left -= 1;
        $souvenir->save();

        return redirect()->route('souvenirs.indexSouvenir')->with('ok', 'จองของที่ระลึกเรียบร้อยแล้ว');
    }

    public function history()
{
    $orders = SouvenirOrder::with('souvenir')
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('souvenirs.showSouvenir', compact('orders'));
}


    // ยกเลิกการจอง
    public function destroy($id)
    {
        $order = SouvenirOrder::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $souvenir = Souvenir::find($order->souvenir_id);
        if ($souvenir) {
            $souvenir->quantity_left += 1;
            $souvenir->save();
        }

        $order->delete();

        return back()->with('ok', 'ยกเลิกการจองแล้ว');
    }
    
}



