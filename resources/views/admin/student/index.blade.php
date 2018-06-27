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
										<th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>Thông tin</th>
										<th>Điện thoại</th>
										<th>Danh sách khóa học</th>
										<th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Last login</th>
										<th><i class="fa fa-fw fa-user txt-color-blue hidden-md hidden-sm hidden-xs"></i>Tình trạng</th>
										<th>Thao tác</th>
									</tr>
								</thead>
								<tbody>
								@if(!empty($users))
									<?php $userGroup = array(
                                        '1' => 'Member',
                                        '2' => 'Manager',
                                        '10' => 'Admin'
                                    );?>

									@foreach ( $users as $user )
										<tr>
											<td>{{$user->id}}</td>
											<td>{{$user->username}}</td>
											<td>{{$user->email}}</td>
											<td>{{$user->status}}</td>
											<td>{{$user->phone}}</td>
											<td>
												<?php echo $userGroup[$user->group_id];?>
											</td>
											<td>{{$user->created_at}}</td>
											<td>{{$user->last_login}}</td>
											<td role="gridcell" aria-describedby="jqgrid_act">
												<a href="{{route('user-edit', $user->id)}}" data-toggle="tooltip" title="Chỉnh sửa học viên" class="btn btn-xs btn-default">
													<i class="fa fa-pencil"></i>
												</a>
												<a href="{{route('user-del', $user->id)}}" data-toggle="tooltip" title="Xóa học viên" class="btn btn-xs btn-default">
													<i class="fa fa-times"></i>
												</a>
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
											@if($students->perPage() > $students->total()) :
											{{ $students->total() }}
											@else {{ $students->perPage() }}
											@endif
										</span> của
										<span class="text-primary">{{ $students->total() }}</span> học viên
									</div>
								</div>
								<div class="col-xs-12 col-sm-6">
									<div class="dataTables_paginate paging_simple_numbers" id="datatable_fixed_column_paginate">
										{!! $students->render() !!}
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
	</script>
@endsection