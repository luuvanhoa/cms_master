@extends('layouts.admin')

@section('content')
	<section id="widget-grid" class="">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
				<h3 class="page-title txt-color-blueDark"><i class="fa fa-th-list"></i> Category Courses List</h3>
			</div>

			<div class="col-xs-6">
				<a href="{{route('category-course-add')}}" class="mt20 pull-right btn btn-primary">Add New Category Course</a>
			</div>
		</div>
		<div class="row">
			<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false">
					<div>
						<!-- widget content -->
						<div class="widget-body no-padding">
							<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
								<thead>
									<tr align="center">
										<th>CategoryName</th>
										<th>Catecode</th>
										<th class="text-center">Level</th>
										<th class="text-center">Status</th>
										<th class="text-center">Show FE</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@if (!empty($categories))
									@foreach($categories as $key => $category)
										<tr>
											<td><div class="line-cate">{{ $category->name }} - {{ $category->id }}</div></td>
											<td>{{$category->catecode}}</td>
											<td align="center">{{$category->level}}</td>
											<td align="center">
												<?php $labelStatus = ($category->status == 1) ? 'success' : 'danger'; ?>
												<button type="button" class="btn btn-<?php echo $labelStatus; ?> btn-xs">
                                                    <?php echo env('STATUS_' . $category->status, '');?>
												</button>
											</td>
											<td align="center">{{$category->show_frontend}}</td>
											<td class="action-td" role="gridcell" aria-describedby="jqgrid_act">
												<a href="<?php echo route('category-course-edit', $category->id); ?>" data-toggle="tooltip" title="Chỉnh sửa danh mục" class="btn btn-xs btn-default">
													<i class="fa fa-pencil"></i>
												</a>
											</td>
										</tr>
									@endforeach
								@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</article>
		</div>
	</section>

@endsection

@section('footer_js')
<script type="text/javascript">

</script>
@endsection