<section id="home">
    <!-- Home Slider-->
    <div id="home-slider" class="flexslider">
        <ul class="slides">
            @foreach ($all_slider as $item)
            <li>
                <img src="{{url('storage/sliders/'.$item->photo)}}" alt="">
                <div class="slide-wrap">
                    <div class="slide-content">
                        <div class="container">
                            <h1>{{$item->title}}<span class="red-dot"></span></h1>
                            <h6>{{$item->subtitle}}.</h6>
                            <p>
                                @foreach (json_decode($item->btns) as $btn)
                                    <a href="{{$btn->btn_link}}" class="btn btn-light-out {{$btn->btn_type}}">{{$btn->btn_title}}</a>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <!-- End Home Slider-->
</section>
<!-- End Home Section-->