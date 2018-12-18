<div class="form-group">
  <label for="name" class="col-sm-2 control-label">Name</label>
  <div class="col-sm-6">
   <input type="name" class="form-control" name="name" id="name" placeholder="
   Enter User Name" value="{{ isset($user->name) ? $user->name : old('name') }}">
 </div>
</div>	

<div class="form-group">
  <label for="email" class="col-sm-2 control-label">Email</label>
  <div class="col-sm-6">
   <input type="email" class="form-control" name="email" id="email" placeholder="
   Enter User Email" value="{{ isset($user->email) ? $user->email : old('email') }}">
 </div>
</div>


<div class="form-group">
  <label for="name" class="col-sm-2 control-label">First Name</label>
  <div class="col-sm-6">
   <input type="name" class="form-control" name="firstname" id="firstname" placeholder="
   Enter First Name" value="{{ isset($user->firstname) ? $user->firstname : old('firstname') }}">
 </div>
</div>   

<div class="form-group">
  <label for="name" class="col-sm-2 control-label">Last Name</label>
  <div class="col-sm-6">
   <input type="name" class="form-control" name="lastname" id="lastname" placeholder="
   Enter last Name" value="{{ isset($user->lastname) ? $user->lastname : old('lastname') }}">
 </div>
</div>  

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
<label for="password" class="col-md-2 control-label">Password</label>

  <div class="col-md-6">
    <input id="password" type="password" class="form-control" name="password" required>

    @if ($errors->has('password'))
    <span class="help-block">
      <strong>{{ $errors->first('password') }}</strong>
    </span>
    @endif
  </div>
</div>

<div class="form-group">
  <label for="password-confirm" class="col-md-2 control-label">Confirm Password</label>

  <div class="col-md-6">
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
  </div>
</div> 