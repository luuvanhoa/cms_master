@extends('layouts.admin')

@section('header_css')
    {!! Html::style('st-admin/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') !!}
    {!! Html::style('st-admin/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') !!}
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
    {!! Html::script('st-admin/js/bootbox.min.js') !!}
    {!! Html::script('st-admin/js/sweetalert.min.js') !!}
@endsection

@section('breadcrumbs_no_url')
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
			<h3 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-user"></i> Add course for user</h3>
		</div>
	</div>
@endsection

@section('content')

    <?php $user_id = 0;?>
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
                    <div>
                        <div class="widget-body">
                            <?php if(!empty($infoUser)) : ?>
                            {!! Form::open(array(
                                'id' => 'submit_form',
                                'class' => 'form-horizontal ',
                                'method' => 'POST',
                                'url'=> route('student-add-post', $infoUser->id)
                            )) !!}
                                <fieldset>
                                    <legend>Info users</legend>

                                    <?php $user_id = $infoUser->id; ?>
                                    {!! Form::hidden('user_id', $infoUser->id) !!}
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Username</label>
                                        <div class="col-md-8">
                                            <div class="form-control" disabled>{{$infoUser->username}}</div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Fullname</label>
                                        <div class="col-md-8">
                                            <div class="form-control" disabled>{{$infoUser->fullname}}</div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email</label>
                                        <div class="col-md-8">
                                            <div class="form-control" disabled>{{$infoUser->email}}</div>
                                        </div>
                                    </div>

                                    @if(!empty($coursesOfUser) && count($coursesOfUser) > 0)
                                        <legend>List courses of user</legend>
                                        <?php $i = 1; ?>
                                        @foreach ($coursesOfUser as $course)
                                            <?php $sign = md5($course->id . $course->user_id . $course->id); ?>
                                            <div class="form-group" id="{{$sign}}">
                                                <label class="col-md-2"></label>
                                                <?php $labelStatus = ($course->status == 1) ? 'success' : 'warning'; ?>
                                                <div class="col-md-6 list-courses">
                                                    {{$i}}. {{$course->course_name}}
                                                    <?php echo
                                                        '<button type="button"
                                                            onclick="removeCourses(' . $course->id . ', ' . $course->user_id . ', \''.$sign . '\')"
                                                            class="btn btn-danger btn-xs">
                                                            <i class="fa fa-times"></i> Remove
                                                        </button>';?>
                                                    <?php echo
                                                        '<button type="button"
                                                            onclick="changeStatus(' . $course->id . ', ' . $course->user_id . ', \'' . $sign . '\')"
                                                            class="btn btn-' . $labelStatus . ' btn-xs ' . $sign . '">
                                                            ' . env('STATUS_' . $course->status, '') . '
                                                        </button>';?>
                                                </div>
                                            </div>
                                            <?php $i++; ?>
                                        @endforeach
                                    @endif

                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <legend>Input info course</legend>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Select course</label>
                                        <div class="col-md-8">
                                            {!! Form::select('course_id',
                                                $listCourseSlbox,
                                                '',
                                                array( 'class' => 'form-control' )
                                            ) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Status</label>
                                        <div class="col-md-8">
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
                                        <label class="col-md-2 control-label">Payment</label>
                                        <div class="col-md-8">
                                            {!! Form::number('payment', '', array('class' => 'form-control', 'placeholder' => 'Payment')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Payment time</label>
                                        <div class="col-md-8 input-group date" id="payment_time" style="padding-left: 10px;padding-right:  10px;">
                                            {!! Form::text('payment_time', '', array('class' => 'form-control', 'placeholder' => 'Payment')) !!}
                                            <span class="input-group-addon">
                                               <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Note</label>
                                        <div class="col-md-8">
                                            {!! Form::text('note', '', array('class' => 'form-control', 'placeholder' => 'Note')) !!}
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
                            {!! Form::close() !!}
                            <?php endif;?>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
            </article>
        </div>
    </section>

@endsection
@section('js_customer')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#payment_time').datetimepicker({
                ignoreReadonly: true,
                allowInputToggle: false,
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });

        function removeCourses(id, user_id, sign) {
            bootbox.confirm("Do you want to <strong class='red'>Delete</strong> this course?", function (result) {
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo route('student-del', $user_id);?>",
                        headers: {'X-CSRF-TOKEN': token},
                        data: {
                            id: id,
                            user_id: user_id,
                            sign: sign
                        },
                        success: function (response) {
                            var Obj = $.parseJSON(response);
                            if (Obj.status == 1) {
                                swal("Good job!", "Delete course is success!", "success");
                                $('#' + sign).remove();
                            } else {
                                swal("Oops!", "Delete course is error!", "error");
                            }
                        }
                    });
                }
            });
        }

        function changeStatus(id, user_id, sign) {
            bootbox.confirm("Do you want to <strong class='red'>Change Status</strong> this course?", function (result) {
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo route('student-status', $user_id);?>",
                        headers: {'X-CSRF-TOKEN': token},
                        data: {
                            id: id,
                            user_id: user_id,
                            sign: sign
                        },
                        success: function (response) {
                            var Obj = $.parseJSON(response);
                            if (Obj.status == 1) {
                                swal("Good job!", "Change status course is success!", "success");

                                var btn = '<button type="button"onclick="changeStatus('+id+', '+user_id+', \''+sign+'\')" class="btn btn-'+Obj.dataBtn.class+' btn-xs '+sign+'">'+Obj.dataBtn.text+'</button>';
                                $('.' + sign).remove();
                                $('#' + sign + ' .list-courses').append(btn);
                            } else {
                                swal("Oops!", "Change status course is error!", "error");
                            }
                        }
                    });
                }
            });
        }

    </script>
@endsection