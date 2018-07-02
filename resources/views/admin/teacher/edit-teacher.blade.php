@extends('layouts.admin')

@section('header_css')
	{!! Html::style('st-admin/vendors/iCheck/skins/flat/green.css') !!}
@endsection

@section('footer_js')
	{!! Html::script('st-admin/vendors/iCheck/icheck.min.js') !!}
	{!! Html::script('st-admin/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') !!}
	{!! Html::script('st-admin/vendors/jquery.hotkeys/jquery.hotkeys.js') !!}
	{!! Html::script('st-admin/vendors/google-code-prettify/src/prettify.js') !!}
	{!! Html::script('st-admin/vendors/jquery.tagsinput/src/jquery.tagsinput.js') !!}
	{!! Html::script('st-admin/vendors/switchery/dist/switchery.min.js') !!}
	{!! Html::script('st-admin/vendors/select2/dist/js/select2.full.min.js') !!}
	{!! Html::script('st-admin/vendors/autosize/dist/autosize.min.js') !!}
	{!! Html::script('st-admin/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') !!}
	{!! Html::script('st-admin/vendors/starrr/dist/starrr.js') !!}
@endsection

@section('breadcrumbs_no_url')
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
			<h3 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-user"></i> Edit group</h3>
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
                            'enctype' => "multipart/form-data",
							'url'=> route('teacher-edit-post', $teacher->id)
						)) !!}
						<fieldset>
							<legend>Input info teacher</legend>
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
								<div class="col-md-8">
									<input class="form-control" disabled value="{{$teacher->username}}" id="username" name="_username" placeholder="Username" type="text">
									<input value="{{$teacher->username}}" name="username" type="hidden">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Full name <span class="required">*</span></label>
								<div class="col-md-8">
									<input class="form-control" value="{{$teacher->fullname}}" id="fullname" name="fullname" placeholder="Full name" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Avatar</label>
								<div class="col-md-8">
									<input name="avatar" class="form-control" type="file">
									@if(!empty($teacher->avatar))
										{!! Html::image(
                                            $teacher->avatar,
                                            $teacher->fullname,
                                            array(
                                                'class' =>'img-thumbnail img-responsive maxwform'
                                            ))
                                        !!}
									@endif
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Phone</label>
								<div class="col-md-8">
									<input class="form-control" value="{{$teacher->phone}}" id="phone" name="phone" placeholder="Phone" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Info</label>
								<div class="col-md-8">
									<input class="form-control" value="{{$teacher->info}}" id="info" name="info" placeholder="Info" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">ID Card</label>
								<div class="col-md-8">
									<input class="form-control" value="{{$teacher->cmnd}}" id="cmnd" name="cmnd" placeholder="ID Card" type="text">
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Status</label>
                                <div class="col-md-8">
                                    <?php
                                    if ($teacher->status == 1) {
                                        $inactive = '';$active = 'checked';
                                    } else {
                                        $inactive = 'checked';$active = '';
                                    }
                                    $hidden = ($teacher->status == 2);
                                    $show = ($teacher->status == 1);
                                    ?>
                                    <div class="radio">
                                        <label>{{ Form::radio('status',1, $show, ['class' => 'flat']) }} Active</label>
                                    </div>
                                    <div class="radio">
                                        <label>{{ Form::radio('status',2, $hidden, ['class' => 'flat']) }} In Active</label>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
								<label class="col-md-2 control-label">Description</label>
								<div class="col-md-8">
									<script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
									<textarea class="ckeditor form-control" name="description" id="description" rows="5">
                                        <?php echo $teacher->description;?>
                                    </textarea>
									<script>
                                        CKEDITOR.replace( 'description' , {
                                            customConfig	: '{{asset("/ckeditor/config-post.js")}}',
                                            filebrowserBrowseUrl: '{{ asset("/ckfinder/ckfinder.html") }}',
                                            filebrowserImageBrowseUrl: '{{ asset("/ckfinder/ckfinder.html?type=Images") }}',
                                            filebrowserFlashBrowseUrl: '{{ asset("/ckfinder/ckfinder.html?type=Flash") }}',
                                            filebrowserUploadUrl: '{{ asset("/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files") }}',
                                            filebrowserImageUploadUrl: '{{ asset("/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images") }}',
                                            filebrowserFlashUploadUrl: '{{ asset("/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash") }}'
                                        });
									</script>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"></label>
								<div class="col-md-8">
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
