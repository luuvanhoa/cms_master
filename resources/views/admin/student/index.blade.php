@extends('layouts.admin')

@section('breadcrumbs_no_url')
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
			<h3 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-user"></i> Danh sách học viên</h3>
		</div>
	</div>
@endsection

@section('content')
	<section id="widget-grid" class="">
		<div class="row">
			<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false">
					<div>
						<!-- widget content -->
						<div class="widget-body no-padding">
							<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
								<thead>
									<tr>
										<th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>Info Name</th>
										<th>Phone</th>
										<th>List course of users</th>
										<th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Last login</th>
										<th><i class="fa fa-fw fa-user txt-color-blue hidden-md hidden-sm hidden-xs"></i>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@if(!empty($students))
									@foreach ( $students as $student )
										<tr>
											<td>
												<strong>{{ $student->fullname . ' - ' .$student->user_id}}</strong>
												<p><strong>Email: </strong>{{$student->email}}</p>
											</td>
											<td align="center">{{$student->phone}}</td>
											<td>
                                                <?php
                                                $dataCourse = explode(',', $student->list_courses);
                                                $str_course = '';
                                                $total = 0;
                                                if (!empty($dataCourse)) {
                                                    foreach ($dataCourse as $stt => $course) {
                                                        $courseName = explode(':', $course);
                                                        $lStatus = ($courseName[2] == 1) ? 'blue' : 'red';
                                                        $button = '<span class="badge bg-' . $lStatus . '">' . env('STATUS_' . $courseName[2], '') . '</span>';
                                                        $str_course .= '<p class="list-course-td">' . ($stt + 1) . '. ' . $courseName[1] . ' ' . $button . '</p>';
                                                        $total++;
                                                    }
                                                }
                                                ?>
												<p><strong>Total: {{$total}}</strong></p>
												<div class="list-student">
													{!! $str_course !!}
												</div>
												<?php if($total>2){
													echo '<span class="btn btn-success btn-xs toggle-view down">View all <i class="fa fa-chevron-down"></i></span>';
												}?>
											</td>
											<td align="center">{{$student->last_login}}</td>
											<td align="center">
												<p>
													<?php $labelStatus = ($student->status == 1) ? 'success' : 'danger'; ?>
													<button type="button" class="btn btn-<?php echo $labelStatus; ?> btn-xs">
														<?php echo env('STATUS_' . $student->status, '');?>
													</button>
												</p>
											</td>
											<td align="center" role="gridcell" aria-describedby="jqgrid_act">
												<a href="{{route('student-add', $student->user_id)}}" data-toggle="tooltip" title="Chỉnh sửa học viên" class="btn btn-xs btn-default">
													<i class="fa fa-pencil"></i> Edit
												</a>
												<button type="button" class="btn btn-info btn-xs" onclick="viewInfo('<?php echo $student->user_id; ?>')"><i class="fa fa-folder"></i> Info</button>
											</td>
										</tr>
									@endforeach
								@endif
								</tbody>
							</table>

							<div class="dt-toolbar-footer">
								<div class="col-sm-6 col-xs-12 hidden-xs">
									<div class="dataTables_info" id="datatable_fixed_column_info" role="status" aria-live="polite">
										Hiển thị <span class="txt-color-darken">
											{{--@if($students->perPage() > $students->total()) :--}}
											{{--{{ $students->total() }}--}}
											{{--@else {{ $students->perPage() }}--}}
											{{--@endif--}}
										</span> của
{{--										<span class="text-primary">{{ $students->total() }}</span> học viên--}}
									</div>
								</div>
								<div class="col-xs-12 col-sm-6">
									<div class="dataTables_paginate paging_simple_numbers" id="datatable_fixed_column_paginate">
{{--										{!! $students->render() !!}--}}
									</div>
								</div>
							</div>
						</div>
						<!-- end widget content -->
					</div>
				</div>
			</article>
		</div>
	</section>

	<div id="gridSystemModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" style="float:left;" id="gridModalLabel">Info student</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="container-fluid bd-example-row">
                        <div class="list-info">
                            <span class="col-md-3 label">Username</span>
                            <span class="col-md-8 value" id="_username"></span>
                        </div>
                        <div class="list-info">
                            <span class="col-md-3 label">Fullname</span>
                            <span class="col-md-8 value" id="_fullname"></span>
                        </div>
                        <div class="list-info">
                            <span class="col-md-3 label">Email</span>
                            <span class="col-md-8 value" id="_email"></span>
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<button id="btn-view-info" type="button" data-toggle="modal" data-target="#gridSystemModal" style="display: none"></button>
@endsection

@section('js_customer')
	<script type="text/javascript">
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();

            $('.toggle-view').click(function () {
                $(this).closest('td').find('.list-student').css('max-height', 'initial');
                if ($(this).hasClass('down')) {
                    $(this).removeClass('down');
                    $(this).html('Collapse <i class="fa fa-chevron-up"></i>');
                } else {
                    $(this).addClass('down');
                    $(this).closest('td').find('.list-student').css('max-height', '40px');
                    $(this).html('View all <i class="fa fa-chevron-down"></i>');
                }
            });
        });

        function viewInfo(user_id) {
            $.ajax({
                type: "POST",
                url: "<?php echo route('student-view-info');?>",
                headers: {'X-CSRF-TOKEN': token},
                data: {
                    user_id: user_id
                },
                success: function (response) {
                    var Obj = $.parseJSON(response);
                    var userInfo = Obj.infoUser;
                    var coursesOfUser = Obj.coursesOfUser;
                    $('#_username').html(userInfo.username);
                    $('#_fullname').html(userInfo.fullname);
                    $('#_email').html(userInfo.email);
                    $('#btn-view-info').click();
                }
            });
        }
	</script>
@endsection