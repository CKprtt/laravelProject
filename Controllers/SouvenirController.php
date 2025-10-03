<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SouvenirController extends Controller
{
    public function s_create()
    {
        return view(view: 'artist.souvenir_request');
    }
}
