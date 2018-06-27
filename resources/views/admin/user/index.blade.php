@extends('layouts.admin')

@section('breadcrumbs_no_url')
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
			<h3 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-user"></i> List User</h3>
		</div>
		<div class="col-xs-6">
			<a href="{{route('user-add')}}" class="mt20 pull-right btn btn-primary">Add New User</a>
		</div>
	</div>

	<div class="row">
		{!! Form::open(array(
			'id' => 'submit_form',
			'class' => 'form-horizontal ',
			'method' => 'get'
		)) !!}
		<div class="form-group form-filter">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<input type="text" class="form-control" value="{{$params['title']}}" name="title" placeholder="Fullname or ID">
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<input type="text" class="form-control" value="{{$params['email']}}" name="email" placeholder="Email">
			</div>
			<div class="col-md-2 col-sm-6 col-xs-12">
				{!! Form::select('status',
					array(
						'all' => 'Select status',
						'1' => 'Active',
						'2' => 'In Active'
					),
					$params['status'],
					array( 'class' => 'form-control' )
				) !!}
			</div>
			<div class="col-md-2 col-sm-6 col-xs-12">
				{!! Form::select('group_id',
					array(
						'all' => 'Select group',
						'1' => 'Member',
						'2' => 'Manager',
						'10' => 'Admin'
					),
					$params['group_id'],
					array( 'class' => 'form-control' )
				) !!}
			</div>
			<div class="col-md-2 col-sm-6 col-xs-12">
				<button type="submit" class="btn btn-success">Filter</button>
			</div>
		</div>

		{!! Form::close() !!}
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
										<th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>Fullname</th>
										<th>Email</th>
										<th>Status</th>
										<th><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Username</th>
										<th><i class="fa fa-fw fa-user txt-color-blue hidden-md hidden-sm hidden-xs"></i>Group</th>
										<th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Register Date</th>
										<th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Last login</th>
										<th>Action</th>
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
											<td>{{$user->fullname}} - {{$user->id}}</td>
											<td>{{$user->email}}</td>
											<td align="center">
                                                <?php $labelStatus = ($user->status == 1) ? 'success' : 'danger'; ?>
												<button type="button" class="btn btn-<?php echo $labelStatus; ?> btn-xs">
                                                    <?php echo env('STATUS_' . $user->status, '');?>
												</button>
											</td>

											<td>{{$user->username}}</td>
											<td>
												<?php echo $userGroup[$user->group_id];?>
											</td>
											<td>{{$user->created_at}}</td>
											<td>{{$user->last_login}}</td>
											<td role="gridcell" aria-describedby="jqgrid_act">
												<a href="{{route('user-edit', $user->id)}}" data-toggle="tooltip" title="Edit user" class="btn btn-xs btn-default">
													<i class="fa fa-pencil"></i>
												</a>
												<a target="_blank" href="{{route('student-add', $user->id)}}" data-toggle="tooltip" title="Add course for user" class="btn btn-info btn-xs">
													<i class="fa fa-plus"></i> Add course
												</a>
												<a href="{{route('user-del', $user->id)}}" data-toggle="tooltip" title="Delete user" class="btn btn-xs btn-default">
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
											@if($users->perPage() > $users->total()) :
											{{ $users->total() }}
											@else {{ $users->perPage() }}
											@endif
										</span> của
										<span class="text-primary">{{ $users->total() }}</span> người dùng
									</div>
								</div>
								<div class="col-xs-12 col-sm-6">
									<div class="dataTables_paginate paging_simple_numbers" id="datatable_fixed_column_paginate">
										{!! $users->render() !!}
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