<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-4 img-side img-right">
                <div class="img-holder">
                    <img src="frontend/images/bg/10.jpg" alt="" class="bg-img">
                </div>
            </div>
            <!-- end of side background image-->
        </div>
        <!-- end of row-->
    </div>
    <div class="container">
        <div class="row">
            @foreach ($all_vision as $item)
            <div class="col-md-5 col-sm-8">
                <div class="title">
                    <h4 class="upper">{{$item->subtitle}}.</h4>
                    <h3>{{$item->title}}<span class="red-dot"></span></h3>
                    <hr>
                </div>
                <div class="row">
                    @foreach (json_decode($item->visions) as $vision)
                    <div class="col-sm-6">
                        <div class="text-box">

                            <h4 class="upper small-heading">{{$vision->vision_name}}</h4>
                            <p>{{$vision->vision_desc}}.</p>

                        </div>
                        <!-- end of text box-->

                    </div>
                    @endforeach
                    <!-- end of row              -->
                </div>
                @endforeach
            </div>
            <!-- end of row-->
        </div>
        <!-- end of container-->
</section>