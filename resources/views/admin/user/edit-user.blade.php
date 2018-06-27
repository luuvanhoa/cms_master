@extends('layouts.admin')

@section('breadcrumbs_no_url')
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
			<h3 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-user"></i> Edit user</h3>
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
								<legend>Input info user</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Username</label>
									<div class="col-md-10">
										<input value="{{ $user->username }}" disabled class="form-control" id="username" name="username" placeholder="Username" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Fullname</label>
									<div class="col-md-10">
										<input value="{{ $user->fullname }}" class="form-control" id="fullname" name="fullname" placeholder="Fullname" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Status</label>
									<div class="col-md-10">
										{!! Form::select('status',
											array(
											  	'1' => 'Active',
											  	'2' => 'In Active'
											),
											$user->status,
											array( 'class' => 'form-control' )
										) !!}
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Email</label>
									<div class="col-md-10">
										<input value="{{ $user->email }}" disabled class="form-control" id="email" name="email" placeholder="email" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Group user</label>
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
									<label class="col-md-2 control-label">Password</label>
									<div class="col-md-10">
										<input name="password" class="form-control" placeholder="Password" type="password">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Phone number</label>
									<div class="col-md-10">
										<input value="{{ $user->phone }}" name="phone" class="form-control" placeholder="Phone number" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Birthday</label>
									<div class="col-md-10">
										<input value="{{ $user->birthday }}" type="text" name="birthday" placeholder="Birthday" class="form-control datepicker" data-dateformat='dd-mm-yy'>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Address</label>
									<div class="col-md-10">
										<input value="{{ $user->address }}" name="address" class="form-control" placeholder="Address" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label"></label>
									<div class="col-md-10">
										<button type="button" class="btn btn-default" onclick="window.history.back();">
											<i class="fa fa-repeat"></i> Back
										</button>
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
