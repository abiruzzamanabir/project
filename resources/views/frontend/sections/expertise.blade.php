<section class="p-0 b-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-4 img-side img-left mb-0">
                <div class="img-holder">
                    <img src="frontend/images/bg/33.jpg" alt="" class="bg-img">
                    <div class="centrize">
                        <div class="v-center">
                            <div class="title txt-xs-center">
                                <h4 class="upper">This is what we love to do.</h4>
                                <h3>Expertise<span class="red-dot"></span></h3>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of side background image-->
            <div class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4">
                <div class="services">
                    <div class="row">
                        @foreach ($all_expertise as $item)
                            
                        <div class="col-sm-6 border-bottom border-right">
                            <div class="service"><i class="{{$item->icon}}"></i><span class="back-icon"><i
                                        class="{{$item->icon}}"></i></span>
                                <h4>{{$item->title}}</h4>
                                <hr>
                                <p class="alt-paragraph">{{$item->subtitle}}</p>
                            </div>
                            <!-- end of service-->
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- end of row-->
            </div>
        </div>
        <!-- end of row -->
    </div>
</section>