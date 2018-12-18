@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Add new department
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" method="POST" action="{{ route('department.store') }}">
					{{ csrf_field() }}

					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name" class="col-md-2 control-label">Department Name</label>

						<div class="col-md-6">
							<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

							@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-2">
							<button type="submit" class="btn btn-primary">
								Create
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
