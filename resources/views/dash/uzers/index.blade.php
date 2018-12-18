@extends('layouts.app')
@section('title','Admins')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">

    <div class="form-group">
      <div class="row">
       <div class="col-sm-6">All Users 
         <span class="badge">{{ $users->count() }}</span>
       </div>

       <div class="col-sm-6">
        <a class="btn btn-primary pull-right" href="{{ url('/users/create')}}"> Add new User</a>
      </div>
    </div>
  </div>

  <hr>

  <div class="form-group">
   <form method="POST" action="{{ route('/users.search') }}">
     {{ csrf_field() }}
     @component('layouts.search', ['title' => 'Search'])
     @component('layouts.two-cols-search-row', ['items' => ['Name', 'First Name'], 
     'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '', isset($searchingVals) ? $searchingVals['firstname'] : '']])
     @endcomponent
   </br>
   @component('layouts.two-cols-search-row', ['items' => ['Last Name'],
   'oldVals' => [isset($searchingVals) ? $searchingVals['lastname']: '']])
   @endcomponent
   @endcomponent
 </form>
</div>

</div>
<div class="panel-body">
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>SN</th>
          <th>Name</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Created_at</th>
          <th>Updated_at</th>
          <th colspan="4">Action</th>
        </tr>
      </thead>
      @foreach($users as $user)
      <tbody>
        <tr>
          <td>{{ $counts++ }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->firstname }}</td>
          <td>{{ $user->lastname }}</td>
          <td>{{ $user->email }}</td>
          <td>
            @if($user->is_admin == false)
            <form action="/users/{{$user->id}}/is-admin" method="POST" role="form">

              {{ csrf_field() }}

              <button type="submit" class="btn btn-link">Normal User</button>
            </form>
            @else
            <form action="/users/{{$user->id}}/is-admin" method="POST" role="form">

              {{ csrf_field() }}


              <button type="submit" class="btn btn-link">Admin</button>
            </form>
            @endif
          </td>
          <td>{{ $user->created_at->diffForHumans() }}</td>
          <td>{{ $user->updated_at->diffForHumans() }}</td>
          <td>
            <a href="/users/{{ $user->id }}/edit"><button class="btn btn-warning"> Edit</button></a>
          </td>

          <td>

            <a class="btn btn-danger" data-toggle="modal" href='#{{ $user->id }}'>Delete</a>
            <div class="modal fade" id="{{ $user->id }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confimation</h4>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to delete user from <p style="color: blue;">{{ $user->email }}</p>
                  </div>
                  <form action="/users/{{ $user->id}}" method="POST" role="form">

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
          <td>
            <a href="/users/{{ $user->id }}"><button class="btn btn-primary">show</button></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <hr>

    <div class="form-group">
     <div class="row">
      <div class="col-sm-5">
        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($users)}} of {{count($users)}} entries</div>
      </div>
      <div class="col-sm-7">
        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
        {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
