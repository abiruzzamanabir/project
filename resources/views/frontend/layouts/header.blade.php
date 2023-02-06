<!-- Navigation Bar-->
<header id="topnav">
	<div class="container">
		<!-- Logo container-->
		<div class="logo">
			<a href="{{ route('home.page') }}">
				@if ($theme_data->logo==='logo.png')
				<img src="{{ asset('frontend/images/logo_light.png') }}" alt="" class="logo-light">
				@else
				<img src="{{ url('storage/logo/'.$theme_data->logo)}}" alt="" class="logo-light">
				@endif
			</a>
		</div>
		<!-- End Logo container-->
		<div class="menu-extras">
			{{-- <div class="menu-item">
				<!-- Shopping cart-->
				<div class="cart">
					<a href="#">
						<i class="ti-bag"></i><span class="cart-number">2</span>
					</a>
					<div class="shopping-cart">
						<div class="shopping-cart-info">
							<div class="row">
								<div class="col-xs-6">
									<h6 class="upper">Your Cart</h6>
								</div>
								<div class="col-xs-6 text-right">
									<h6 class="upper">$399.99</h6>
								</div>
							</div>
							<!-- end of row-->
						</div>
						<ul class="nav product-list">
							<li>
								<div class="product-thumbnail">
									<img src="frontend/images/shop/2.jpg" alt="">
								</div>
								<div class="product-summary">
									<a href="#">Premium Suit Blazer</a><span>$199.99</span>
								</div>
							</li>
							<li>
								<div class="product-thumbnail">
									<img src="frontend/images/shop/5.jpg" alt="">
								</div>
								<div class="product-summary">
									<a href="#">Reiss Vara Tailored Blazer</a><span>$199.99</span>
								</div>
							</li>
						</ul>
						<p><a href="#" class="btn btn-color btn-block btn-sm">Checkout</a>
						</p>
					</div>
				</div>
				<!-- End shopping cart-->
			</div> --}}
			<div class="menu-item">
				<!-- Search Form-->
				@if ($theme_data->true)
				<div class="search">
					<a href="#">
						<i class="ti-search"></i>
					</a>
					<div class="search-form">
						<form action="#" class="inline-form">
							<div class="input-group">
								<input type="text" placeholder="Search" class="form-control"><span
									class="input-group-btn"><button type="button" class="btn btn-color"><span><i
												class="ti-search"></i></span>
									</button>
								</span>
							</div>
						</form>
					</div>
				</div>
				@endif
				<!-- End search form-->
			</div>
			<div class="menu-item">
				<!-- Mobile menu toggle-->
				<a class="navbar-toggle">
					<div class="lines">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</a>
				<!-- End mobile menu toggle-->
			</div>
		</div>
		<div id="navigation">
			<!-- Navigation Menu-->
			<ul class="navigation-menu">
				<li>
					<a href="{{ route('home.page') }}">Home</a>
				</li>
				<li>
					<a href="{{ route('about.page') }}">About</a>
				</li>
				<li>
					<a href="{{ route('pricing.page') }}">Pricing</a>
				</li>
				{{-- <li>
					<a href="#">Team</a>
				</li> --}}
				<li>
					<a href="{{ route('blog.page') }}">Blog</a>
				</li>
				<li>
					<a href="{{ route('shop.page') }}">Shop</a>
				</li>
				{{-- <li>
					<a href="#">Services</a>
				</li> --}}
				{{-- <li>
					<a href="#">Contact</a>
				</li> --}}

			</ul>
			<!-- End navigation menu        -->
		</div>
	</div>
</header>
<!-- End Navigation Bar-->