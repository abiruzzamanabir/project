<section class="page-title parallax">
  <div data-parallax="scroll" data-image-src="frontend/images/bg/18.jpg" class="parallax-bg"></div>
  <div class="parallax-overlay">
    <div class="centrize">
      <div class="v-center">
        <div class="container">
          <div class="title center">
            <h1 class="upper">This is our blog<span class="red-dot"></span></h1>
            <h4>We have a few tips for you.</h4>
            <hr>
          </div>
        </div>
        <!-- end of container-->
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="blog-posts">



          @foreach ($all_post as $post)

          <article class="post-single">
            <div class="post-info">
              <h2><a href="#">{{$post->title}}</a></h2>
              <h6 class="upper"><span>By</span><a href="#"> {{$post->author->fast_name}}
                  {{$post->author->last_name}}</a><span class="dot"></span><span>{{date('d F
                  Y',strtotime($post->created_at))}}</span><span class="dot"></span>
                @foreach ($post->tag as $tag)
                <a href="#" class="post-tag">{{$tag->name}}</a> @if (!$loop->last)
                    |
                @endif
                @endforeach
              </h6>
            </div>
            @php
                $featured= json_decode($post->featured);
            @endphp

            @if ($featured->post_type=='gallery')
            <div class="post-media">
              <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true"
                class="flexslider nav-outside">
                <ul class="slides">
                  @foreach (json_decode($featured->gallery) as $item)    
                  <li>
                    <img src="{{ url('storage/posts/'.$item)}}" alt="">
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
            @endif
            @if ($featured->post_type=='standard')
            <div class="post-media">
              <a href="#">
                <img src="{{ url('storage/posts/'.$featured->standard)}}" alt="">
              </a>
            </div>
            @endif
            @if ($featured->post_type=='video')
            <div class="post-media">
              <div class="media-video">
                <iframe src="{{$featured->video}}" frameborder="0"></iframe>
              </div>
            </div>
            @endif
            @if ($featured->post_type=='audio')
            <div class="post-media">
              <div class="media-audio">
                <iframe
                  src="{{$featured->audio}}"
                  frameborder="0"></iframe>
              </div>
            </div>
            @endif
            @if ($featured->post_type=='quote')
            <blockquote class="italic">
              <p>{{$featured->quote}}</p>
            </blockquote>
            @endif
            
            <div class="post-body">
              <p>
                {!! Str::of(htmlspecialchars_decode($post->content)) ->words(30) !!}
              </p>
              <p><a href="{{ route('post.single.page', $post->slug) }}" class="btn btn-color btn-sm">Read More</a>
              </p>
            </div>
          </article>
          @endforeach
          <!-- end of article-->
        </div>
        <ul class="pagination">
          <li><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="ti-arrow-left"></i></span></a>
          </li>
          <li class="active"><a href="#">1</a>
          </li>
          <li><a href="#">2</a>
          </li>
          <li><a href="#">3</a>
          </li>
          <li><a href="#">4</a>
          </li>
          <li><a href="#">5</a>
          </li>
          <li><a href="#" aria-label="Next"><span aria-hidden="true"><i class="ti-arrow-right"></i></span></a>
          </li>
        </ul>
        <!-- end of pagination-->
      </div>
      @include('frontend.layouts.side-bar')
    </div>
    <!-- end of row-->
  </div>
  <!-- end of container-->
</section>