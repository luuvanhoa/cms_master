@extends('layouts.admin')

@section('breadcrumbs_no_url')
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
			<h3 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-users"></i> Add new group</h3>
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
							'url'=> route('group-add-post')
						)) !!}
							<fieldset>
								<legend>Input info group</legend>
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
									<label class="col-md-2 control-label">Group name <span class="required">*</span></label>
									<div class="col-md-10">
										<input class="form-control" id="name" name="name" placeholder="Group name" type="text">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Group ACP</label>
									<div class="col-md-8">
										<div class="radio">
											<label><input type="radio" class="flat" value="1" checked name="group_acp"> Yes</label>
										</div>
										<div class="radio">
											<label><input type="radio" class="flat" value="0" name="group_acp"> No</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Privilege ID</label>
									<div class="col-md-10">
										<input name="privilege_id" class="form-control" placeholder="Privilege ID" type="text">
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
