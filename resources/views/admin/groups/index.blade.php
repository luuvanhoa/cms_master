@extends('layouts.admin')

@section('breadcrumbs_no_url')
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
			<h3 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-user"></i> List Groups</h3>
		</div>
		<div class="col-xs-6">
			<a href="{{route('group-add')}}" class="mt20 pull-right btn btn-primary">Add New Group</a>
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
										<th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>Group name</th>
										<th>Group ACP</th>
										<th>Create By</th>
										<th>Create Time</th>
										<th>Modified By</th>
										<th>Modified Time</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@if(!empty($groups)) 
									@foreach ( $groups as $group )
										<tr>
											<td>{{$group->name}} - {{$group->id}}</td>
											<td align="center">
                                                <?php $labelStatus = ($group->group_acp == 1) ? 'success' : 'danger'; ?>
                                                <button type="button" class="btn btn-<?php echo $labelStatus; ?> btn-xs">
                                                    <?php echo ($group->group_acp == 1) ? "Yes" : "No";?>
                                                </button>
                                            </td>
											<td>{{$group->created_by}}</td>
											<td>{{$group->created_time}}</td>
											<td>{{$group->modified_by}}</td>
											<td>{{$group->modified_time}}</td>
											<td role="gridcell" aria-describedby="jqgrid_act">
												<a href="{{route('group-edit', $group->id)}}" data-toggle="tooltip" title="Edit user" class="btn btn-xs btn-default">
													<i class="fa fa-pencil"></i> Edit
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
										Show <span class="txt-color-darken">
											@if($groups->perPage() > $groups->total()) :
											{{ $groups->total() }}
											@else {{ $groups->perPage() }}
											@endif
										</span> of
										<span class="text-primary">{{ $groups->total() }}</span> groups
									</div>
								</div>
								<div class="col-xs-12 col-sm-6">
									<div class="dataTables_paginate paging_simple_numbers" id="datatable_fixed_column_paginate">
										{!! $groups->render() !!}
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