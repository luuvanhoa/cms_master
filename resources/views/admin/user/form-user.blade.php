@extends('layouts.admin')

@section('breadcrumbs_no_url')
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
			<h3 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-user"></i> Add new user</h3>
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
							'autocomplete'=>"off",
							'url'=> route('user-add-post')
						)) !!}
							<fieldset>
								<legend>Input info user</legend>
								@if (count($errors) > 0)
									<div class="alert alert-danger">
										<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
										</ul>
									</div>
								@endif
								<div class="form-group">
									<label class="col-md-2 control-label">Username <span class="required">*</span></label>
									<div class="col-md-10">
										{!! Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Username')) !!}
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Fullname</label>
									<div class="col-md-10">
										{!! Form::text('fullname', '', array('class' => 'form-control', 'placeholder' => 'Fullname')) !!}
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
											'',
											array( 'class' => 'form-control' )
										) !!}
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Email <span class="required">*</span></label>
									<div class="col-md-10">
										{!! Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email')) !!}
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
											'',
											array( 'class' => 'form-control' )
										) !!}
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Password <span class="required">*</span></label>
									<div class="col-md-10">
										<input autocomplete="off" name="password" class="form-control" placeholder="Password" type="password">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Phone number</label>
									<div class="col-md-10">
										{!! Form::text('phone', '', array('class' => 'form-control', 'placeholder' => 'Phone number')) !!}
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Birthday</label>
									<div class="col-md-10">
										{!! Form::text('birthday', '', array('class' => 'form-control datepicker', 'placeholder' => 'Birthday', 'data-dateformat' => 'dd-mm-yy')) !!}
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Address</label>
									<div class="col-md-10">
										{!! Form::text('address', '', array('class' => 'form-control', 'placeholder' => 'Address')) !!}
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
