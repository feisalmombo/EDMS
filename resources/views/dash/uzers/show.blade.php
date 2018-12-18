@extends('layouts.app')
@section('title','User')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
           <div class="col-sm-6">{{ $user->name }}</div>
           <div class="col-sm-6">
               <a class="btn btn-primary pull-right" href="{{ url('/users') }}">All Users</a>
           </div>
       </div>
   </div>

   <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tbody>
                <tr>
                    <td><label for="name">User Name</label></td>
                    <td>{{ $user->name }}</td>
                </tr>

                <tr>
                    <td><label for="email">User Email</label></td>
                    <td>{{ $user->email }}</td>
                </tr>

                <tr>
                    <td><label for="is_admin">First Name</label></td>
                    <td>{{ $user->firstname }}</td>
                </tr>

                <tr>
                    <td><label for="is_admin">Last Name</label></td>
                    <td>{{ $user->lastname }}</td>
                </tr>

                <tr>
                    <td><label for="created_at">Created Date:</label></td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                </tr>

                <tr>
                    <td><label for="updated_at">Updated Date:</label></td>
                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
</div>
@endsection
