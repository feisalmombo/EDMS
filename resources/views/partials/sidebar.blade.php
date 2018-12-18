<div class="panel panel-default">
	<div class="panel-heading">
		<div class="list-group">
			<a class="list-group-item {{ request()->fullUrl() == url('/home') ? 'active' : '' }}" href="/home"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home</a>

			@if(Auth::user()->is_admin == true)
			<a class="list-group-item {{ request()->fullUrl() == url('/users') ? 'active' : '' }}" href="/users"><i class="fa fa-user-secret" aria-hidden="true"></i>&nbsp; Admins</a>
			@endif

			<a class="list-group-item {{ request()->fullUrl() == url('/employee-management/employee') ? 'active' : '' }}" href="/employee-management/employee"><i class="fa fa-user" aria-hidden="true"></i>&nbsp; Employee</a>
		</div>




		{{-- Dropdown Menu --}}

		@if(Auth::user()->is_admin == true)

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span
						class="fa fa-file fa-fw" aria-hidden="true">
					</span>Managements</a>
				</h4>
			</div>
			<div id="collapseFour" class="panel-collapse collapse">
				<div class="panel-body">
					<table class="table">
						<tr>
							<td>
								<a href="/system-management/department">&nbsp;Department</a>
							</td>
						</tr>

						<tr>
							<td>
								<a href="/system-management/division">&nbsp;Division</a>
							</td>
						</tr>

						<tr>
							<td>
								<a href="/system-management/country">&nbsp;Country</a>
							</td>
						</tr>

						<tr>
							<td>
								<a href="/system-management/state">&nbsp;State</a>
							</td>
						</tr>

						<tr>
							<td>
								<a href="/system-management/city">&nbsp;City</a>
							</td>
						</tr>

					</table>
				</div>
			</div>
		</div>

		@endif
	</div>
</div>