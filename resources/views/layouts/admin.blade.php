<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title> CMS - Team master </title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf_token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::style('st-admin/css/font-awesome.min.css') !!}
	{!! Html::style('st-admin/css/nprogress.css') !!}
	{!! Html::style('st-admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') !!}
	{!! Html::style('st-admin/vendors/bootstrap-daterangepicker/daterangepicker.css') !!}

	@yield('header_css')

	{!! Html::style('st-admin/css/custom.css') !!}

	<!-- FAVICONS -->
	<link rel="shortcut icon" href="{{asset('st-admin/images/favicon.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{asset('st-admin/images/favicon.ico')}}" type="image/x-icon">
</head>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<!-- END NAVIGATION -->
			@include('layouts/admin/sidebar')

			<!-- MAIN PANEL -->
			<div class="right_col" role="main">
				<?php $nameRoute = Request::route()->getName();?>
				@yield('breadcrumbs_no_url')
				@yield('content')
			</div>
			<footer><!-- footer content -->
				<div class="pull-right">Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a></div>
				<div class="clearfix"></div>
			</footer> <!-- /footer content -->
		</div> <!-- main_container -->
	</div> <!-- container body -->

	{!! Html::script('st-admin/vendors/jquery/dist/jquery.min.js') !!}
	{!! Html::script('st-admin/vendors/bootstrap/dist/js/bootstrap.min.js') !!}
	<script>var token = $('meta[name="csrf_token"]').attr("content");</script>
	@yield('footer_js')

	{!! Html::script('st-admin/vendors/fastclick/lib/fastclick.js') !!}
	{!! Html::script('st-admin/vendors/nprogress/nprogress.js') !!}
	{!! Html::script('st-admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') !!}
	{!! Html::script('st-admin/vendors/moment/min/moment.min.js') !!}
	{!! Html::script('st-admin/vendors/bootstrap-daterangepicker/daterangepicker.js') !!}
	{!! Html::script('st-admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}

	@yield('js_customer')
	{!! Html::script('st-admin/js/custom.min.js') !!}


</body>
</html>