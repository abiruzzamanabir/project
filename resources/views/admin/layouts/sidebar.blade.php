			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li> 
								<a href="{{ route('admin.dashboard.page') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a>
								@if (in_array('Slider',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('slider.index') }}"><i class="fa fa-slideshare"></i> <span>Slider</span></a>
								@endif
								@if (in_array('Testimonial',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="#"><i class="fa fa-quote-left"></i> <span>Testimonial</span></a>
								@endif
								@if (in_array('Our client',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('client.index') }}"><i class="fa fa-user"></i> <span>Our Client</span></a>
								@endif
								@if (in_array('Our team',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="#"><i class="fa fa-users"></i> <span>Our Team</span></a>
								@endif
								
							</li>
							@if (in_array('Portfolio',json_decode(Auth::guard('admin')->user()->role->permission)))
							<li class="submenu">
								<a href="#"><i class="fa fa-briefcase"></i> <span> Portfolio</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="#">Portfolio</a></li>
									<li><a href="#">Category</a></li>
									<li><a href="#">Tags</a></li>
								</ul>
							</li>
							@endif
							@if (in_array('Post',json_decode(Auth::guard('admin')->user()->role->permission)))
							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Posts</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="#">All Posts</a></li>
									<li><a href="#">Category</a></li>
									<li><a href="#">Tags</a></li>
								</ul>
							</li>
							@endif

                            <li class="menu-title"> 
								<span>Admin Option</span>
							</li>
							@if (in_array('Admin user',json_decode(Auth::guard('admin')->user()->role->permission)))	
							<li class="submenu">
								<a href="#"><i class="fa fa-user"></i> <span>Admin User</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('admin-user.index') }}">Users</a></li>
									<li><a href="{{route('role.index')}}">Role</a></li>
									<li><a href="{{ route('permission.index') }}">Permission</a></li>
								</ul>
							</li>
							@endif
                            <li> 
								<a href="#"><i class="fa fa-tasks"></i> <span>Theme Option</span></a>
							</li>
                            <li> 
								<a href="#"><i class="fa fa-cog"></i> <span>Setting</span></a>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->