<div class="col-md-3 col-md-offset-1">
          <div class="sidebar hidden-sm hidden-xs">
            <div class="widget">
              <h6 class="upper">Search blog</h6>
              <form action="{{ route('blog.search') }}" method="GET">
                <input type="text" name="search" placeholder="Search.." class="form-control">
              </form>
            </div>
            <!-- end of widget        -->
            <div class="widget">
              <h6 class="upper">Categories</h6>
              <ul class="nav">
                @foreach ($category as $cat) 
                <li><a href="{{ route('blog.category.page', $cat->slug) }}">{{$cat->name}} ({{count($cat->posts)}})</a>
                </li>
                @endforeach
          
              </ul>
            </div>
            <!-- end of widget        -->
            <div class="widget">
              <h6 class="upper">Popular Tags</h6>
              <div class="tags clearfix">
                @foreach ($taglist as $tag)
                <a href="{{ route('blog.tag.page', $tag->slug) }}">{{$tag->name}} ({{count($tag->posts)}})</a>
                @endforeach
              </div>
            </div>
            <!-- end of widget      -->
            <div class="widget">
              <h6 class="upper">Latest Posts</h6>
              <ul class="nav">
                @foreach ($latest as $item)    
                <li><a href="{{ route('post.single.page', $item->slug) }}">{{$item->title}}<i class="ti-arrow-right"></i><span>{{date('d F , 
                  Y',strtotime($item->created_at))}}</span></a>
                </li>
                @endforeach
              </ul>
            </div>
            <!-- end of widget          -->
          </div>
          <!-- end of sidebar-->
        </div>