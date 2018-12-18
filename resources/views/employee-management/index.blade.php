@extends('layouts.app')
@section('content')
<!-- Main content -->
<section class="content-fluid">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-8">
						<h3 class="box-title">List of employees</h3>
					</div>
					<div class="col-sm-4">
						<a class="btn btn-primary pull-right" href="{{ route('employee.create') }}">Add new employee</a>
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
			<form method="POST" action="{{ route('/employee-management.employee.search') }}">

				{{ csrf_field() }}

				@component('layouts.search', ['title' => 'Search'])
				@component('layouts.two-cols-search-row', ['items' => ['First Name', 'Department_Name'], 
				'oldVals' => [isset($searchingVals) ? $searchingVals['firstname'] : '', isset($searchingVals) ? $searchingVals['departments_name'] : '']])
				@endcomponent
				@endcomponent
			</form>
			<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-12">
						<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
							<thead>
								<tr role="row">
								 <th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Picture: activate to sort column descending" aria-sort="ascending">Picture</th>
									<th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Employee Name</th>
									<th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Address</th>
									<th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Age</th>
									<th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthdate: activate to sort column ascending">Birthdate</th>
									<th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="HiredDate: activate to sort column ascending">Hired Date</th>
									<th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Department</th>
									<th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Division</th>
									<th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
								</tr>
							</thead>
							<tbody>
							
								@foreach ($employees as $employee)
								<tr role="row" class="odd">
									<td><img src="{{ asset('storage/' .$employee->picture) }}" width="50px" height="50px"/>
								</td> 
								<td class="sorting_1">{{ $employee->firstname }} {{$employee->middlename}} {{$employee->lastname}}</td>
								<td class="hidden-xs">{{ $employee->address }}</td>
								<td class="hidden-xs">{{ $employee->age }}</td>
								<td class="hidden-xs">{{ $employee->birthdate }}</td>
								<td class="hidden-xs">{{ $employee->date_hired }}</td>
								<td class="hidden-xs">{{ $employee->departments_name }}</td>
								<td class="hidden-xs">{{ $employee->divisions_name }}</td>
								<td>
									<a href="/employee-management/employee/{{ $employee->id }}/edit"><button class="btn btn-warning"> Edit</button></a>
								</td>
								<td>

									<a class="btn btn-danger" data-toggle="modal" href='#{{ $employee->id }}'>Delete</a>
									<div class="modal fade" id="{{ $employee->id }}">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title">Confimation</h4>
												</div>
												<div class="modal-body">
													Are you sure you want to delete employee name <p style="color: blue;">{{ $employee->firstname }}</p>
												</div>
												<form action="/employee-management/employee/{{ $employee->id}}" method="POST" role="form">

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
								<tr role="row">
									<th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Picture: activate to sort column descending" aria-sort="ascending">Picture</th>
									<th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Employee Name</th>
									<th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Address</th>
									<th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Age</th>
									<th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthdate: activate to sort column ascending">Birthdate</th>
									<th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="HiredDate: activate to sort column ascending">Hired Date</th>
									<th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Department</th>
									<th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Division</th>
									<th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
								</tr>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-5">
					<div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($employees)}} of {{count($employees)}} entries</div>
				</div>
				<div class="col-sm-7">
					<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
						{{ $employees->links() }}
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