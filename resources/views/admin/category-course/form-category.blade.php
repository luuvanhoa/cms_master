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

@section('content')
	<section id="widget-grid" class="">
		<div class="row">
			<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
					<div>
						<div class="widget-body">
							{!! Form::open(array(
                                'id' => 'submit_form',
                                'class' => 'form-horizontal ',
                                'method' => 'POST',
                                'enctype' => "multipart/form-data",
                        	  	'url'=> route('category-course-add')
                            )) !!}
							<fieldset>
								<legend>Input info category</legend>
								@if (count($errors) > 0)
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
								<div class="x_panel">
									<div class="form-group">
										<label class="col-md-2 control-label">Category Parent</label>
										<div class="col-md-8">
											{!! Form::select('parent_id',
												$category,
												'',
												array( 'class' => 'form-control' )
											) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Category Name</label>
										<div class="col-md-8">
											<input class="form-control" id="name" name="name" placeholder="Category Name" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Catecode</label>
										<div class="col-md-8">
											{!! Form::text('catecode', '', array('class' => 'form-control', 'placeholder' => 'Catecode')) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Image</label>
										<div class="col-md-8">
											<input name="image" class="form-control" type="file">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Show on frontend</label>
										<div class="col-md-8">
											{!! Form::select('show_frontend',
												array('0' => 'hidden', '1' => 'show'),
												'',
												array( 'class' => 'form-control' )
											) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Status</label>
										<div class="col-md-8">
											<div class="radio">
												<label><input type="radio" class="flat" value="1" checked name="status"> Show</label>
											</div>
											<div class="radio">
												<label><input type="radio" class="flat" value="0" name="status"> Hidden</label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Description</label>
										<div class="col-md-8">
											<script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
											<textarea class="ckeditor form-control" name="description" id="description" rows="5"></textarea>
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
										<label class="col-md-2 control-label">Meta title</label>
										<div class="col-md-8">
											{!! Form::text('meta_title', '', array('class' => 'form-control', 'placeholder' => 'Meta title')) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Meta keyword</label>
										<div class="col-md-8">
											{!! Form::text('meta_keyword', '', array('class' => 'form-control', 'placeholder' => 'Meta keyword')) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Meta Description</label>
										<div class="col-md-8">
											{!! Form::text('meta_description', '', array('class' => 'form-control', 'placeholder' => 'Meta Description')) !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label"></label>
										<div class="col-md-8">
											<button type="button" class="btn btn-default" onclick="window.history.back();"><i class="fa fa-repeat"></i> Back</button>
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
										</div>
									</div>
							</fieldset>
						</div>
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

