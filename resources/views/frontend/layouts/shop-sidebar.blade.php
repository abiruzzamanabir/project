
  <div class="sidebar">
    <div class="widget">
      <h6 class="upper">Categories</h6>
      <ul class="nav">
        @foreach ($category as $cat)      
        <li><a href="{{ route('product.category.page', $cat->slug) }}">{{$cat->name}} ({{count($cat->products)}})</a>
        </li>
        @endforeach
      </ul>
    </div>
    <!-- end of widget        -->
    <div class="widget">
      <h6 class="upper">Trending Products</h6>
      <ul class="nav product-list">
        @foreach ($latest as $item)
            
        <li>
          <div class="product-thumbnail">
            <a href="{{ route('product.single.page', $item->slug) }}"><img src="{{url('storage/products/'.$item->featured)}}" alt=""></a>
          </div>
          <div class="product-summary"><a href="{{ route('product.single.page', $item->slug) }}">{{$item->name}}</a><span>${{$item->price}}</span>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
    <!-- end of widget          -->
    <div class="widget">
      <h6 class="upper">Search Shop</h6>
      <form action="{{ route('product.search') }}" method="GET">
        <input type="text" name="search" placeholder="Search.." class="form-control">
      </form>
    </div>
    <!-- end of widget        -->
    <div class="widget">
      <h6 class="upper">Popular Tags</h6>
      <div class="tags clearfix">@foreach ($tag as $t)<a href="{{ route('product.tag.page', $t->slug) }}">{{$t->name}} ({{count($t->products)}})</a>@endforeach
      </div>
    </div>
    <!-- end of widget      -->
  </div>
  <!-- end of sidebar-->