<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CMS - ZendVN!</title>

	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::style('st-admin/css/font-awesome.min.css') !!}
	{!! Html::style('st-admin/css/nprogress.css') !!}
	{!! Html::style('st-admin/css/animate.min.css') !!}
	{!! Html::style('st-admin/css/custom.min.css') !!}

</head>
<body class="login">
<div>
	<div class="login_wrapper">
		<div class="animate form login_form">
			<section class="login_content">
				<!-- MAIN CONTENT -->
				{!! Form::open(array(
                    'id' => 'submit_form',
                    'class' => 'lockscreen animated flipInY',
                    'method' => 'POST',
                    'url'=> route('login_post')
                )) !!}
					<h1>Login Administrators</h1>
					<div>
						<input type="text" class="form-control" placeholder="Username" required="" />
					</div>
					<div>
						<input type="password" class="form-control" placeholder="Password" required="" />
					</div>
					<div>
						<a class="btn btn-primary submit" href="index.html">Log in</a>
					</div>
					<div class="clearfix"></div>
					<div class="separator">
						<div>
							<h1><i class="fa fa-paw"></i> CMS - ZendVN!</h1>
							<p>©2018 All Rights Reserved. CMS - ZendVN! 2018. Privacy and Terms</p>
						</div>
					</div>
				{!! Form::close() !!}
			</section>
		</div>
	</div>
</div>
</body>
</html>


