@extends('layouts.app')
@section('title', 'change_password')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Change Password
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="/account/process_change_password">

					{{ csrf_field() }}


					<div class="form-group">
						<label for="old_password" class="col-md-2 control-label">Old Password</label>

						<div class="col-md-6">
							<input id="old_password" type="password" class="form-control" name="old_password">
						</div>
					</div>

					<div class="form-group">
						<label for="password" class="col-md-2 control-label">New Password</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control" name="password">
						</div>
					</div>

					<div class="form-group">
						<label for="password_confirmation" class="col-md-2 control-label">Confirm New Password</label>

						<div class="col-md-6">
							<input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-2 col-sm-offset-2">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection