<section class="dark">
  <div class="container">
    <div class="row">
      @foreach ($all_counter as $item)
      <div class="col-md-3 col-sm-6">
        <div class="counter">
          <div class="counter-icon"><i class="{{$item->icon}}"></i>
          </div>
          <div class="counter-content">
            <h5><span data-count="{{$item->count}}" class="number-count">{{$item->count}}</span><span
                class="red-dot"></span></h5><span>{{$item->name}}</span>
          </div>
        </div>
        <!-- end of counter-->
      </div>
      @endforeach
    </div>
    <!-- end of row-->
  </div>
  <!-- end of container-->
</section>