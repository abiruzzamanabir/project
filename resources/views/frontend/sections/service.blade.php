<section class="dark p-0">
    <div class="boxes">
      <div class="container-fluid">
        <div class="row">
            @php
                $i=1;
            @endphp
            @foreach ($all_services as $item)                
            @php
                if ($i==1) {
                    $no=1;
                    $bgcolor='#1c1e20';
                } else if($i==2){ 
                    $no=2;
                    $bgcolor='#25282b';
                } else if($i==3){     
                    $no=3;
                    $bgcolor='#2A2D30';
                }
            @endphp
            <div data-bg-color="{{$bgcolor}}" class="col-md-4">
              <div class="number-box"><span>Item No.</span>
                <h2>0{{$no}}<span class="red-dot"></span></h2>
                <h4>{{$item->title}}.</h4>
                <p>{{$item->desc}}</p>
              </div>
            </div>
            @php
                $i++;
            @endphp
            @endforeach
        </div>
        <!-- end of row-->
      </div>
      <!-- end of container-->
    </div>
  </section>