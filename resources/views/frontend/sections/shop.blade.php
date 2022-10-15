<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="{{ asset('frontend/images/bg/19.jpg') }}" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">Shop</h1>
              <h4>Free Delivery Worldwide.</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
            @include('frontend.layouts.shop-sidebar')
        </div>
        
        <div class="col-md-9">
          <div class="shop-menu">
            <div class="row">
              <div class="col-sm-8">
                <h6 class="upper">Displaying 6 of 18 results</h6>
              </div>
              <div class="col-sm-4">
                <div class="form-select">
                  <select name="type" class="form-control">
                    <option selected="selected" value="">Sort By</option>
                    <option value="">What's new</option>
                    <option value="">Price high to low</option>
                    <option value="">Price low to high</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- end of row-->
          </div>
          <div class="container-fluid">
            <div class="row">
              @forelse ($all_products as $item) 
              <div class="col-md-4 col-sm-6">
                <div class="shop-product">
                  <div class="product-thumb">
                    <a href="{{ route('product.single.page', $item->slug) }}">
                      <img src="{{ url('storage/products/'. $item->featured) }}" alt="">
                    </a>
                    <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a>
                    </div>
                  </div>
                  <div class="product-info">
                    <h4 class="upper"><a href="{{ route('product.single.page', $item->slug) }}">{{$item->name}}</a></h4><span>${{$item->price}}</span>
                    <div class="save-product"><a href="#"><i class="icon-heart"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              @empty
              <h1 class="text-center text-danger">No Product Found</h1>
              @endforelse 
              
              
            </div>
            <!-- end of row-->
            @if ($all_products->lastPage() > 1)
        <ul class="pagination">
          <li><a
              href="{{$all_products->previousPageUrl()}}" style="{{ ($all_products->currentPage() == 1) ? 'pointer-events: none' : '' }}" aria-label="Previous"><span aria-hidden="true"><i
                  class="ti-arrow-left"></i></span></a>
          </li>
          @for ($i = 1; $i <= $all_products->lastPage(); $i++)
            <li class="{{ ($all_products->currentPage() == $i) ? ' active' : '' }}"><a
                href="{{$all_products->url($i)}}">{{$i}}</a>
            </li>
          @endfor
            <li><a
                href="{{$all_products->nextPageUrl()}}" style="{{ ($all_products->currentPage() == $all_products->lastPage()) ? 'pointer-events: none' : '' }}" aria-label="Next"><span aria-hidden="true"><i
                    class="ti-arrow-right"></i></span></a>
            </li>
        </ul>
        @endif
            <!-- end of pagination-->
          </div>
        </div>
      </div>
    </div>
    <!-- end of container-->
  </section>