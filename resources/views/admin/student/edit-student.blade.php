@extends('layouts.admin')

@section('breadcrumbs_no_url')
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
			<h3 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-user"></i> Chỉnh sửa người dùng</h3>
		</div>
	</div>
@endsection

@section('content')

<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
				<div>
					<div class="widget-body">
						{!! Form::open(array(
							'id' => 'submit_form',
							'class' => 'form-horizontal ',
							'method' => 'POST',
							'url'=> route('user-edit-post', $user->id)
						)) !!}
							<fieldset>
								<legend>Chỉnh sửa thông tin người dùng</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Tên đăng nhập</label>
									<div class="col-md-10">
										<input value="{{ $user->username }}" disabled class="form-control" id="username" name="username" placeholder="Họ tên" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Họ tên</label>
									<div class="col-md-10">
										<input value="{{ $user->fullname }}" class="form-control" id="fullname" name="fullname" placeholder="Họ tên" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Email</label>
									<div class="col-md-10">
										<input value="{{ $user->email }}" disabled class="form-control" id="email" name="email" placeholder="email" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Nhóm người dùng</label>
									<div class="col-md-10">
										{!! Form::select('group_id',
											array(
											  	'1' => 'Member',
											  	'2' => 'Manager',
											  	'10' => 'Admin'
											),
											$user->group_id,
											array( 'class' => 'form-control' )
										) !!}
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Mật khẩu</label>
									<div class="col-md-10">
										<input name="password" class="form-control" placeholder="Mật khẩu" type="password">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Điện thoại</label>
									<div class="col-md-10">
										<input value="{{ $user->phone }}" name="phone" class="form-control" placeholder="Điện thoại" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Ngày sinh</label>
									<div class="col-md-10">
										<input value="{{ $user->birthday }}" type="text" name="birthday" placeholder="Ngày sinh" class="form-control datepicker" data-dateformat='dd-mm-yy'>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Địa chỉ</label>
									<div class="col-md-10">
										<input value="{{ $user->address }}" name="address" class="form-control" placeholder="Địa chỉ" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label"></label>
									<div class="col-md-10">
										<button type="button" class="btn btn-default" onclick="window.history.back();">Trở lại</button>
										<button type="submit" class="btn btn-primary">Lưu người dùng</button>
									</div>
								</div>
							</fieldset>
						{!! Form::close() !!}
					</div>
					<!-- end widget content -->
				</div>
				<!-- end widget div -->
			</div>
		</article>
	</div>
</section>

@endsection
