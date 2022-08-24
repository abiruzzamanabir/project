<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class FrontendController extends Controller
{
    public function showHomePage()
    {
        $clients = Client::get();
        $slider= Slider::where('status',true)->get();
        return view('frontend.pages.index', [
            'all_client' => $clients,
            'all_slider' => $slider,
        ]);
    }
}
