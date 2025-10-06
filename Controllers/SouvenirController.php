<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Souvenir;

class SouvenirController extends Controller
{
    // แสดงฟอร์ม
    public function s_create()
    {
        return view('artist.souvenir_request');
    }

}
