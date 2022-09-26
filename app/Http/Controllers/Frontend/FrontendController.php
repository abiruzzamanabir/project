<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Counter;
use App\Models\Expertise;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PricingTable;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Slider;
use App\Models\Tag;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\Vision;

class FrontendController extends Controller
{
    public function showHomePage()
    {
        $post= Post::where('status',true)->latest()->get();
        $post= Post::where('status',true)->latest()->get();
        $category= PostCategory::where('status',true)->get();
        $tag= Tag::where('status',true)->get();
        $clients = Client::get();
        $slider= Slider::where('status',true)->get();
        $expertise= Expertise::where('status',true)->get();
        $vision= Vision::where('status',true)->get();
        $testimonial= Testimonial::latest()->where('status',true)->take(5)->get();
        $portfolios= Portfolio::latest()->where('status',true)->take(8)->get();
        $categories= Category::where('status',true)->get();
        return view('frontend.pages.index', [
            'all_client' => $clients,
            'all_slider' => $slider,
            'all_expertise' => $expertise,
            'all_vision' => $vision,
            'all_testimonial' => $testimonial,
            'all_portfolios' => $portfolios,
            'all_categories' => $categories,
            'all_post' => $post,
            'category' => $category,
            'taglist' => $tag,
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
    public function showSingleportfolioPage($slug)
    {
        $portfolio = Portfolio::where('slug',$slug)->first();
        $previous = Portfolio::where('slug', '<', $portfolio->slug)->max('slug');
        $next = Portfolio::where('slug', '>', $portfolio->slug)->min('slug');
        return view('frontend.pages.portfolio',[
            'single_post' => $portfolio,
            'prev_post' => $previous,
            'next_post' => $next,
        ]);
    }
    public function showSinglepostPage($slug)
    {
        $post = Post::where('slug',$slug)->first();
        return view('frontend.pages.post',[
            'single_post' => $post,
        ]);
    }
    public function showBlogPage()
    {
        $post= Post::where('status',true)->latest()->get();
        $category= PostCategory::where('status',true)->get();
        $tag= Tag::where('status',true)->get();
        return view('frontend.pages.blog',[
            'all_post' => $post,
            'category' => $category,
            'taglist' => $tag,
        ]);
    }
}
