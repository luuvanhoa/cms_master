<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
			<a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>CMS - Team master</span></a>
		</div>
		<div class="clearfix"></div>
		<!-- menu profile quick info -->
		<div class="profile clearfix">
			<div class="profile_pic">
				{!! Html::image('st-admin/images/img.jpg', 'me', array('class' =>'img-circle profile_img')) !!}
			</div>
			<div class="profile_info">
				<span>Welcome,</span>
				<h2>John Doe</h2>
			</div>
		</div>
		<!-- /menu profile quick info -->
		<br />
		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
				<h3>General</h3>
				<ul class="nav side-menu">
					<li><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
					<li>
						<a><i class="fa fa-users"></i> Groups <span class="fa fa-chevron-down"></span><span class="label label-success pull-right">Coming Soon</span></a>
						<ul class="nav child_menu">
							<li><a href="#">Group list</a></li>
							<li><a href="#">Add new category course</a></li>
						</ul>
					</li>
					<li>
						<a><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="{{route('user-list')}}">Users list</a></li>
							<li><a href="{{route('user-add')}}">Add new user</a></li>
							<li><a href="{{route('student-list')}}">Students list</a></li>
						</ul>
					</li>
					<li>
						<a><i class="fa fa-child"></i> Teachers <span class="fa fa-chevron-down"></span><span class="label label-success pull-right">Coming Soon</span></a>
						<ul class="nav child_menu">
							<li><a href="#">Teachers list</a></li>
							<li><a href="#">Add new Teachers</a></li>
						</ul>
					</li>
					<li>
						<a><i class="fa fa-book"></i> Courses <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="{{route('course-list')}}">Courses list</a></li>
							<li><a href="{{route('course-add')}}">Add new course</a></li>
						</ul>
					</li>
					<li>
						<a><i class="fa fa-folder"></i> Category courses <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="{{route('category-course-list')}}">Category courses list</a></li>
							<li><a href="{{route('category-course-add')}}">Add new category course</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="menu_section">
				<h3>Articles</h3>
				<ul class="nav side-menu">
					<li>
						<a><i class="fa fa-file-archive-o"></i> Category articles <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="{{route('article-category')}}">Category article list</a></li>
							<li><a href="{{route('article-category-add')}}">Add new category article</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<!-- /sidebar menu -->
		<!-- /menu footer buttons -->
		<div class="sidebar-footer hidden-small">
			<a data-toggle="tooltip" data-placement="top" title="Settings">
				<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="FullScreen">
				<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Lock">
				<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
				<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
			</a>
		</div>
		<!-- /menu footer buttons -->
	</div>
</div>
<!-- top navigation -->
<div class="top_nav">
	<div class="nav_menu">
		<nav>
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						{!! Html::image('st-admin/images/img.jpg', 'me') !!}
						John Doe
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="javascript:;"> Profile</a></li>
						<li>
							<a href="javascript:;">
								<span class="badge bg-red pull-right">50%</span>
								<span>Settings</span>
							</a>
						</li>
						<li><a href="javascript:;">Help</a></li>
						<li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
<!-- /top navigation -->