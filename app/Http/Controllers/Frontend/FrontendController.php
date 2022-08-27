<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\PricingTable;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\Vision;

class FrontendController extends Controller
{
    public function showHomePage()
    {
        $clients = Client::get();
        $slider= Slider::where('status',true)->get();
        $vision= Vision::where('status',true)->get();
        $testimonial= Testimonial::latest()->where('status',true)->take(5)->get();
        return view('frontend.pages.index', [
            'all_client' => $clients,
            'all_slider' => $slider,
            'all_vision' => $vision,
            'all_testimonial' => $testimonial,
        ]);
    }
    public function showAboutPage()
    {
        $testimonial= Testimonial::latest()->where('status',true)->take(5)->get();
        $teams= Team::where('status',true)->get();
        $clients = Client::get();
        $skills= Skill::where('status',true)->get();
        $services= Service::where('status',true)->get();
        return view('frontend.pages.about', [
            'all_client' => $clients,
            'all_testimonial' => $testimonial,
            'all_teams' => $teams,
            'all_skills' => $skills,
            'all_services' => $services,
        ]);
    }
    public function showPricingPage()
    {
        $pricing= PricingTable::where('status',true)->get();
        $counter= Counter::where('status',true)->get();
        return view('frontend.pages.pricing',[
            'all_pricing' => $pricing,
            'all_counter' => $counter,
        ]);
    }
}
