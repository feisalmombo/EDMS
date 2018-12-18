@if(count($errors))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>
		  <ul class="list-unstyled">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
		  </ul>
	   </strong> 
	</div>				
@endif