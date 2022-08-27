<section>
    <div class="container">
        <div class="title center">
            <h4 class="upper">This is the way we do business.</h4>
            <h2>Prices<span class="red-dot"></span></h2>
            <hr>
        </div>
        <div class="section-content">
            <div class="row">
                @php
                $i=1;
                @endphp
                @foreach ($all_pricing as $item)
                @php
                if ($i==1) {
                $classname='';
                } else if($i==2){
                $classname='featured';
                }
                else if($i==3){
                $classname='';
                }
                @endphp
                <div class="col-md-4">
                    <div class="pricing-table {{$classname}}">
                        <div class="pricing-head"><i class="icon-globe"></i>
                            <h4 class="upper">{{$item->name}}</h4>
                        </div>
                        <div class="price">
                            <h2><span>$</span>{{$item->price}}<span>/m</span></h2>
                        </div>
                        <ul class="features nav">
                            <li><span>{{$item->memory}}{{$item->memory_type}}</span> Memory</li>
                            <li><span>{{$item->processor}} Core</span> Processor</li>
                            <li><span>{{$item->disk}}GB</span> SSD Disk</li>
                            <li><span>{{$item->transfer}}TB</span> Transfer</li>
                        </ul>
                        <div class="pricing-footer"><a href="{{$item->link}}" class="btn btn-color">Order Now</a>
                        </div>
                    </div>
                    <!-- end of pricing table-->
                </div>
                @php
                $i++;
                @endphp
                @endforeach
            </div>
            <!-- end of row-->
        </div>
        <!-- end of section content-->
    </div>
    <!-- end of container-->
</section>