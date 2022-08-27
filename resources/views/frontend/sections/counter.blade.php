<section class="dark">
    <div class="container">
      <div class="row">
        @php
            $i=1;
        @endphp
        @foreach ($all_counter as $item)
            @php
                if ($i==1) {
                    $icon='icon-presentation';
                } else if($i==2){
                    $icon='icon-beaker';
                }
                 else if($i==3){
                    $icon='icon-hourglass';
                }
                 else if($i==4){
                    $icon='icon-chat';
                }
                
            @endphp
        <div class="col-md-3 col-sm-6">
          <div class="counter">
            <div class="counter-icon"><i class="{{$icon}}"></i>
            </div>
            <div class="counter-content">
              <h5><span data-count="{{$item->count}}" class="number-count">{{$item->count}}</span><span class="red-dot"></span></h5><span>{{$item->name}}</span>
            </div>
          </div>
          <!-- end of counter-->
        </div>
        @php
            $i++;
        @endphp
        @endforeach
        {{-- <div class="col-md-3 col-sm-6">
          <div class="counter">
            <div class="counter-icon"><i class="icon-beaker"></i>
            </div>
            <div class="counter-content">
              <h5> <span data-count="9060" class="number-count">9060</span><span class="red-dot"></span></h5><span>Lines of Code</span>
            </div>
          </div>
          <!-- end of counter-->
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="counter">
            <div class="counter-icon"><i class="icon-hourglass"></i>
            </div>
            <div class="counter-content">
              <h5><span data-count="75" class="number-count">75</span><span class="red-dot"></span></h5><span>Clients</span>
            </div>
          </div>
          <!-- end of counter-->
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="counter">
            <div class="counter-icon"><i class="icon-chat"></i>
            </div>
            <div class="counter-content">
              <h5><span data-count="872" class="number-count">872</span><span class="red-dot"></span></h5><span>Tweets</span>
            </div>
          </div>
          <!-- end of counter-->
        </div> --}}
      </div>
      <!-- end of row-->
    </div>
    <!-- end of container-->
  </section>