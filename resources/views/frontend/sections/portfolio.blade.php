<section id="portfolio" class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="title m-0 txt-xs-center txt-sm-center">
                    <h2 class="upper">Selected Works<span class="red-dot"></span></h2>
                    <hr>
                </div>
            </div>
            <div class="col-md-6">
                <ul id="filters" class="no-fix mt-25">
                    <li data-filter="*" class="active">All</li>
                    @foreach ($all_categories as $cat)    
                    <li data-filter=".{{$cat->slug}}">{{$cat->slug}}</li>
                    @endforeach
                </ul>
                <!-- end of portfolio filters-->
            </div>
        </div>
        <!-- end of row-->
    </div>
    <div class="section-content pb-0">
        <div id="works" class="four-col wide mt-50">
            @foreach ($all_portfolios as $port)
            <div class="work-item @foreach ($port->category as $cat)  
                {{$cat->slug}}
                @endforeach">
                <div class="work-detail">
                    <a href="{{ route('portfolio.single.page', $port->slug) }}">
                        <img style="width: 100%;height: 350px;object-fit: cover" src="{{ url('storage/portfolios/'.$port->featured)}}" alt="">
                        <div class="work-info">
                            <div class="centrize">
                                <div class="v-center">
                                    <h3>{{$port->title}}</h3>
                                    @foreach ($port->category as $item)  
                                    {{Str::upper($item->name)}}@if (!$loop->last),@endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <!-- end of portfolio grid-->
    </div>
</section>