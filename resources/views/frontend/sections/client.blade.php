<section>
    <div class="container">
        <div class="title center">
            <h4 class="upper">Some of the best.</h4>
            <h3>Our Clients<span class="red-dot"></span></h3>
            <hr>
        </div>
        <div class="section-content">
            <div class="boxes clients">
                <div class="row">
                    @php
                        $i=1;
                    @endphp
                    @foreach ($all_client as $client)    
                    @php
                        if ($i==1) {
                            $classname='border-right border-bottom';
                            $delay='';
                        } else if($i==2){
                            $classname='border-right border-bottom';
                            $delay='500';
                        }
                         else if($i==3){
                            $classname='border-bottom';
                            $delay='1000';
                        }
                         else if($i==4){
                            $classname='border-right';
                            $delay='';
                        }
                         else if($i==5){
                            $classname='border-right';
                            $delay='500';
                        }
                         else if($i==6){
                            $classname='';
                            $delay='1000';
                        }
                        
                    @endphp
                    <div class="col-sm-4 col-xs-6 {{$classname}}">
                        <img src="{{ url('storage/clients/'. $client->photo) }}" alt="" data-animated="true" data-delay="{{$delay}}" class="client-image">
                    </div>
                    @php
                        $i++;
                    @endphp
                    @endforeach

                </div>
                <!-- end of row-->
            </div>
        </div>
        <!-- end of section content-->
    </div>
</section>