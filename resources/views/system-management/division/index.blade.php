@extends('layouts.app')
@section('content')
<!-- Main content -->
<section class="content">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-8">
						<h3 class="box-title">List of divisions</h3>
					</div>
					<div class="col-sm-4">
						<a class="btn btn-primary pull-right" href="{{ route('division.create') }}">Add new division</a>
					</div>
				</div>
			</div>
			
		</div>
		<!-- /.box-header -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6"></div>
				<div class="col-sm-6"></div>
			</div>

			<form method="POST" action="{{ route('/system-management.division.search') }}">
				{{ csrf_field() }}
				@component('layouts.search', ['title' => 'Search'])
				@component('layouts.two-cols-search-row', ['items' => ['Name'], 
				'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
				@endcomponent
				@endcomponent
			</form>

			<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-12">
						<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
							<thead>
								<tr role="row">
									<th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="division: activate to sort column ascending">Division Name</th>
									<th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($divisions as $division)
								<tr role="row" class="odd">
									<td>{{ $division->name }}</td>
									<td>
										<a href="/system-management/division/{{ $division->id }}/edit"><button class="btn btn-warning"> Edit</button></a>
									</td>
									<td>

										<a class="btn btn-danger" data-toggle="modal" href='#{{ $division->id }}'>Delete</a>
										<div class="modal fade" id="{{ $division->id }}">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">Confimation</h4>
													</div>
													<div class="modal-body">
														Are you sure you want to delete division name <p style="color: blue;">{{ $division->name }}</p>
													</div>
													<form action="/system-management/division/{{ $division->id}}" method="POST" role="form">

														{{ csrf_field() }}
														{{ method_field('DELETE') }}

														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
															<button type="submit" class="btn btn-primary">Yes</button>
														</div>
													</div>
												</form>
											</div>
										</div>

									</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th width="20%" rowspan="1" colspan="1">Division Name</th>
									<th rowspan="1" colspan="2">Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($divisions)}} of {{count($divisions)}} entries</div>
					</div>
					<div class="col-sm-7">
						<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
							{{ $divisions->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
</section>
<!-- /.content -->
</div>
@endsection