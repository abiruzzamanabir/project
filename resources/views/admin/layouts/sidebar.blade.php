			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li> 
								<a href="#"><i class="fa fa-home"></i> <span>Dashboard</span></a>
								<a href="#"><i class="fa fa-slideshare"></i> <span>Slider</span></a>
								<a href="#"><i class="fa fa-quote-left"></i> <span>Testimonial</span></a>
								<a href="#"><i class="fa fa-user"></i> <span>Our Client</span></a>
								<a href="#"><i class="fa fa-users"></i> <span>Our Team</span></a>
							</li>
							
							<li class="submenu">
								<a href="#"><i class="fa fa-briefcase"></i> <span> Portfolio</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="#">Portfolio</a></li>
									<li><a href="#">Category</a></li>
									<li><a href="#">Tags</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Posts</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="#">All Posts</a></li>
									<li><a href="#">Category</a></li>
									<li><a href="#">Tags</a></li>
								</ul>
							</li>

                            <li class="menu-title"> 
								<span>Admin Option</span>
							</li>
							<li class="submenu">
								<a href="#"><i class="fa fa-user"></i> <span>Admin User</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('admin-user.index') }}">Users</a></li>
									<li><a href="{{route('role.index')}}">Role</a></li>
									<li><a href="{{ route('permission.index') }}">Permission</a></li>
								</ul>
							</li>
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