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
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
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
        $post = Post::where('status', true)->latest()->get();
        $post = Post::where('status', true)->latest()->get();
        $category = PostCategory::where('status', true)->get();
        $tag = Tag::where('status', true)->get();
        $clients = Client::get();
        $slider = Slider::where('status', true)->get();
        $expertise = Expertise::where('status', true)->get();
        $vision = Vision::where('status', true)->get();
        $testimonial = Testimonial::latest()->where('status', true)->take(5)->get();
        $portfolios = Portfolio::latest()->where('status', true)->take(8)->get();
        $categories = Category::where('status', true)->get();
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
        $testimonial = Testimonial::latest()->where('status', true)->take(5)->get();
        $teams = Team::where('status', true)->get();
        $clients = Client::get();
        $skills = Skill::where('status', true)->get();
        $services = Service::where('status', true)->get();
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
        $pricing = PricingTable::where('status', true)->get();
        $counter = Counter::where('status', true)->get();
        return view('frontend.pages.pricing', [
            'all_pricing' => $pricing,
            'all_counter' => $counter,
        ]);
    }
    
    public function showSingleportfolioPage($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->first();
        $previous = Portfolio::where('slug', '<', $portfolio->slug)->max('slug');
        $next = Portfolio::where('slug', '>', $portfolio->slug)->min('slug');
        return view('frontend.pages.portfolio', [
            'single_post' => $portfolio,
            'prev_post' => $previous,
            'next_post' => $next,
        ]);
    }
    public function showSinglepostPage($slug)
    {
        $latest = Post::where('status', true)->latest()->get()->take(5);

        $post = Post::where('slug', $slug)->first();
        $category = PostCategory::where('status', true)->get();
        $tag = Tag::where('status', true)->get();
        return view('frontend.pages.post', [
            'single_post' => $post,
            'category' => $category,
            'taglist' => $tag,
            'latest' => $latest,
        ]);
    }
    public function showBlogPage()
    {
        $latest = Post::where('status', true)->latest()->get()->take(5);
        $post = Post::where('status', true)->latest()->paginate(2);
        $category = PostCategory::where('status', true)->get();
        $tag = Tag::where('status', true)->get();
        return view('frontend.pages.blog', [
            'all_post' => $post,
            'category' => $category,
            'taglist' => $tag,
            'latest' => $latest,
        ]);
    }
    public function showBlogCategoryPage($slug)
    {
        $latest = Post::where('status', true)->latest()->get()->take(5);
        $cat = PostCategory::where('slug', $slug)->first();
        $post = $cat->posts()->paginate(5);
        $category = PostCategory::where('status', true)->get();
        $tag = Tag::where('status', true)->get();
        return view('frontend.pages.blog', [
            'all_post' => $post,
            'category' => $category,
            'taglist' => $tag,
            'latest' => $latest,
        ]);
    }
    public function showBlogTagPage($slug)
    {
        $latest = Post::where('status', true)->latest()->get()->take(5);
        $posts = Tag::where('slug', $slug)->first();
        $post = $posts->posts()->paginate(5);
        $category = PostCategory::where('status', true)->get();
        $tag = Tag::where('status', true)->get();
        return view('frontend.pages.blog', [
            'all_post' => $post,
            'category' => $category,
            'taglist' => $tag,
            'latest' => $latest,

        ]);
    }
    public function blogSearch(Request $request)
    {
        $search = $request->search;
        $latest = Post::where('status', true)->latest()->get()->take(5);
        $post = Post::where('title', 'LIKE', "%{$search}%")->orWhere('content', 'LIKE', "%{$search}%")->paginate(5);
        $category = PostCategory::where('status', true)->get();
        $tag = Tag::where('status', true)->get();
        return view('frontend.pages.blog', [
            'all_post' => $post,
            'category' => $category,
            'taglist' => $tag,
            'latest' => $latest,

        ]);
    }

    public function showSingleProductPage($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $products = Product::where('status', true)->paginate(9);
        return view('frontend.pages.single-product', [
            'all_products' => $products,
            'single_product' => $product,
        ]);
    }
    public function showShopPage()
    {
        $latest =Product::where('status', true)->latest()->get()->take(3);
        $products = Product::where('status', true)->paginate(9);
        $category =ProductCategory::where('status', true)->get();
        $tag =ProductTag::where('status', true)->get();
        return view('frontend.pages.shop', [
            'all_products' => $products,
            'category' => $category,
            'tag' => $tag,
            'latest' => $latest,
        ]);
    }
    public function showProductCategoryPage($slug)
    {
        $latest =Product::where('status', true)->latest()->get()->take(3);
        $products = Product::where('status', true)->paginate(9);
        $category =ProductCategory::where('status', true)->get();
        $tag =ProductTag::where('status', true)->get();
        return view('frontend.pages.shop', [
            'all_products' => $products,
            'category' => $category,
            'tag' => $tag,
            'latest' => $latest,
        ]);
    }
    public function showProductTagPage($slug)
    {
        $latest =Product::where('status', true)->latest()->get()->take(3);
        $products = Product::where('status', true)->paginate(9);
        $category =ProductCategory::where('status', true)->get();
        $tag =ProductTag::where('status', true)->get();
        return view('frontend.pages.shop', [
            'all_products' => $products,
            'category' => $category,
            'tag' => $tag,
            'latest' => $latest,

        ]);
    }

    public function ProductSearch(Request $request)
    {
        $search = $request->search;
        $latest = Product::where('status', true)->latest()->get()->take(5);
        $products = Product::where('name', 'LIKE', "%{$search}%")->orWhere('shortdesc', 'LIKE', "%{$search}%")->orWhere('desc', 'LIKE', "%{$search}%")->paginate(9);
        $category = ProductCategory::where('status', true)->get();
        $tag = ProductTag::where('status', true)->get();
        return view('frontend.pages.shop', [
            'all_products' => $products,
            'category' => $category,
            'tag' => $tag,
            'latest' => $latest,
        ]);
    }
}
