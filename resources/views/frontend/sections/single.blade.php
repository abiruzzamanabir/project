<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="{{ asset('frontend/images/bg/5.jpg') }}" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">Single Item<span class="red-dot"></span></h1>
              <h4>Our best work.</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
  </section>
  <section class="b-0">
    <div class="container">
      <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true, &quot;directionNav&quot;: true}" class="flexslider nav-inside">
        <ul class="slides">
            @foreach (json_decode($single_post->gallery) as $item)    
            <li>
              <img src="{{url('storage/portfolios/'.$item)}}" alt="">
              
            </li>
            @endforeach
        </ul>
      </div>
    </div>
  </section>
  <section class="p-0 b-0">
    <div class="boxes">
      <div class="container-fluid">
        <div class="row">
            @php
                $i=1;
            @endphp
            @foreach (json_decode($single_post->steps) as $item)
            @php
                if ($i==1) {
                    $no=1;
                    $bgcolor='#eaeaea';
                } else if($i==2){ 
                    $no=2;
                    $bgcolor='#f0f0f0';
                } else if($i==3){     
                    $no=3;
                    $bgcolor='#f4f4f4';
                }
            @endphp
            <div data-bg-color="{{$bgcolor}}" class="col-md-4">
              <div class="number-box"><span>Step No.</span>
                <h2>0{{$no}}<span class="red-dot"></span></h2>
                <h4>{{$item->title}}.</h4>
                <p>{{$item->sdesc}}</p>
              </div>
            </div>
            @php
                $i++;
            @endphp
            @endforeach
        </div>
        <!-- end of row-->
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="project-detail">
            <p><strong>Client:</strong>{{$single_post->client}}.</p>
            <p><strong>Date:</strong>{{date('d F, Y',strtotime($single_post->date))}}</p>
            <p><strong>Link:</strong><a href="#">{{$single_post->link}}</a>
            </p>
            <p><strong>Type:</strong>@foreach ($single_post->category as $item)  
                {{$item->name}}@if (!$loop->last),@endif
                @endforeach</p>
          </div>
        </div>
        <div class="col-sm-8">
            {!! htmlspecialchars_decode($single_post->desc) !!}
        </div>
      </div>
    </div>
  </section>
  <section class="controllers p-0">
    <div class="container">
        <div class="projects-controller"><a href="{{$prev_post}}" class="prev"><span><i class="ti-arrow-left"></i>Previous</span></a><a href="#" class="all"><span><i class="ti-layout-grid2"></i></span></a><a href="{{$next_post}}" class="next"><span>Next<i class="ti-arrow-right"></i></span></a>
      </div>
    </div>
  </section>