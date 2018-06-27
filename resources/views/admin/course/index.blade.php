@extends('layouts.admin')

@section('breadcrumbs_no_url')
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
			<h3 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-user"></i> Courses list</h3>
		</div>
		<div class="col-xs-6">
			<a href="{{route('course-add')}}" class="mt20 pull-right btn btn-success">Add New Courses</a>
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
										<th>Course Name</th>
										<th>Category</th>
										<th>Teacher</th>
										<th>Tuition fee</th>
										<th class="text-center">Status</th>
										<th class="text-center">Publish time</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
								@if(!empty($courses))
									@foreach ( $courses as $course )
										<tr>
											<td><a href="{{route('course-edit', $course->id)}}"><strong>{{$course->name}}</strong></a></td>
											<td>{{$course->category_name}}</td>
											<td>Lưu Trường Hải Lân</td>
											<td>
												<p><?php if($course->price > 0) {
													echo "<strong>".number_format($course->price)." VNĐ</strong>";
												} ?> </p>
											</td>
											<td align="center">
												<p><?php $labelStatus = ($course->status == 1) ? 'success' : 'danger'; ?>
												<button type="button" class="btn btn-<?php echo $labelStatus; ?> btn-xs">
                                                    <?php echo env('STATUS_' . $course->status, '');?>
												</button></p>
											</td>
											<td align="center"><strong>{{date('Y-m-d H:i:s')}}</strong></td>
											<td align="center" role="gridcell" aria-describedby="jqgrid_act">
												<a href="{{route('course-edit', $course->id)}}" data-toggle="tooltip" title="Chỉnh sửa" class="btn btn-xs btn-default">
													<i class="fa fa-pencil"></i> Edit
												</a>
												<button type="button" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> Info</button>
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
											@if($courses->perPage() > $courses->total()) :
											{{ $courses->total() }}
											@else {{ $courses->perPage() }}
											@endif
										</span> của
										<span class="text-primary">{{ $courses->total() }}</span> học viên
									</div>
								</div>
								<div class="col-xs-12 col-sm-6">
									<div class="dataTables_paginate paging_simple_numbers" id="datatable_fixed_column_paginate">
										{!! $courses->render() !!}
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

@endsection

@section('content_js')
	<script type="text/javascript">
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();
		});

        function viewInfo(id) {

        }
	</script>
@endsection