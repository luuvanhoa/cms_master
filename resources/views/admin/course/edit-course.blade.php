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
                    <div class="widget-body">
                        {!! Form::open(array(
                            'id' => 'submit_form',
                            'class' => 'form-horizontal ',
                            'method' => 'POST',
                            'enctype' => "multipart/form-data",
                            'url'=> route('course-edit', $course->id)
                        )) !!}
                        <fieldset>
                            <legend>Input info course</legend>
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
                                <div class="col-xs-9">
                                    <div class="form-group">
                                        <label>Description</label>
                                        {!! Form::textarea('description', $course->description, array('class' => 'form-control', 'rows' => "3", 'placeholder' => 'Description')) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Content article</label>
                                        <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
                                        <textarea class="ckeditor form-control" name="content" id="content" rows="5">
											<?php echo $course->content;?>
										</textarea>
                                        <script>
                                            CKEDITOR.replace('content', {
                                                customConfig: '{{asset("/ckeditor/config-article.js")}}',
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
                                <div class="col-xs-3">

                                    <div class="form-group">
                                        <label>Course name</label>
                                        {!! Form::text('name', $course->name, array('class' => 'form-control', 'placeholder' => 'Course name')) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Share url</label>
                                        {!! Form::text('share_url', $course->share_url, array('class' => 'form-control', 'placeholder' => 'Share url')) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Category course</label>
                                        {!! Form::select('category_id',
                                            $category,
                                            $course->category_id,
                                            array('class' => 'form-control')
                                        ) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Images</label>
                                        <input name="images" class="form-control" type="file">
                                    </div>

                                    <div class="form-group">
                                        <label>Publish time</label>
                                        <div class="input-group date" id="publish_time">
                                            {!! Form::text('publish_time', $course->publish_time, array('class' => 'form-control datepicker', 'placeholder' => 'Publish time')) !!}
                                            <span class="input-group-addon">
											   <span class="glyphicon glyphicon-calendar"></span>
											</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>

                                        <?php
                                        if ($course->status == 1) {
                                            $inactive = '';$active = 'checked';
                                        } else {
                                            $inactive = 'checked';$active = '';
                                        }
                                        $hidden = ($course->status == 2);
                                        $show = ($course->status == 1);
                                        ?>
                                        <div class="radio">
                                            <label>{{ Form::radio('status',1, $show, ['class' => 'flat']) }} Show</label>
                                        </div>
                                        <div class="radio">
                                            <label>{{ Form::radio('status',2, $hidden, ['class' => 'flat']) }} Hidden</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Teacher</label>
                                        {!! Form::select('teacher_id',
                                            array('0' => 'Select teacher course', 1000001 => 'Lưu Trường Hải Lân'),
                                            $course->teacher_id,
                                            array('class' => 'form-control')
                                        ) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Tuition fee</label>
                                        {!! Form::text('price', $course->price, array('class' => 'form-control', 'placeholder' => 'Tuition fee')) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Tuition fee old</label>
                                        {!! Form::text('price_old', $course->price_old, array('class' => 'form-control', 'placeholder' => 'Tuition fee old')) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Start sale</label>
                                        <div class="input-group date" id="start_sale">
                                            {!! Form::text('start_sale', $course->start_sale, array('class' => 'form-control datepicker', 'placeholder' => 'Start sale')) !!}
                                            <span class="input-group-addon">
											   <span class="glyphicon glyphicon-calendar"></span>
											</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>End sale</label>
                                        <div class="input-group date" id="end_sale">
                                            {!! Form::text('end_sale', $course->end_sale, array('class' => 'form-control datepicker', 'placeholder' => 'End sale')) !!}
                                            <span class="input-group-addon">
											   <span class="glyphicon glyphicon-calendar"></span>
											</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Meta title</label>
                                        {!! Form::text('meta_title', $course->meta_title, array('class' => 'form-control', 'placeholder' => 'Meta title')) !!}
                                    </div>
                                    <div class="form-group">
                                        <label>Meta keyword</label>
                                        {!! Form::text('meta_keyword', $course->meta_keyword, array('class' => 'form-control', 'placeholder' => 'Meta keyword')) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        {!! Form::text('meta_description', $course->meta_description, array('class' => 'form-control', 'placeholder' => 'Meta Description')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label></label>
                                    <div class="col-md-8">
                                        <button type="button" class="btn btn-default" onclick="window.history.back();">
                                            <i class="fa fa-repeat"></i> Back
                                        </button>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </article>
        </div>
    </section>

@endsection

@section('js_customer')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#start_sale').datetimepicker({
                ignoreReadonly: true,
                allowInputToggle: false,
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#end_sale').datetimepicker({
                ignoreReadonly: true,
                allowInputToggle: false,
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#publish_time').datetimepicker({
                ignoreReadonly: true,
                allowInputToggle: false,
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        })
    </script>
@endsection