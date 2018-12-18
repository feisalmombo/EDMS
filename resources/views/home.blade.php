@extends('layouts.app')

@section('title', 'Home')

@section('content')


<div class="col-lg-12">
    <h1 class="page-header">Dashboard</h1>
</div>

<hr style="border-top:3px dotted #eee;" />
<div class="row">
   <div class="col-lg-12">
    <div class="col-lg-4">
        <a href="{{url('/employee-management/employee')}}" style="text-decoration: none;">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title">
                    <h3>Employees</h3>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-9 text-left">
                        <div><i class="fa fa-check fa-5x"></i></div>
                    </div>
                    <div class="huge">{{ count($employees) }}</div>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-lg-4">
 <a href="{{url('system-management/department')}}" style="text-decoration: none;">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">
            <h3>Department</h3>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-9 text-left">
                <div><i class="fa fa-times fa-5x"></i></div>
            </div>
            <div class="huge">{{ count($departments) }}</div>
        </div>
    </div>
</div>
</a>
</div> 
<div class="col-lg-4">
 <a href="{{url('system-management/division')}}" style="text-decoration: none;">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">
            <h3>Division</h3>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-9 text-left">
                <div><i class="fa fa-th-list fa-5x"></i></div>
            </div>
            <div class="huge">{{ count($divisions) }}</div>
        </div>
    </div>
</div>
</a>
</div>  
</div> 
</div>

<hr style="border-top:3px dotted #eee;" />
<div class="row">
   <div class="col-lg-12">
    <div class="col-lg-4">
        <a href="{{url('system-management/country')}}" style="text-decoration: none;">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title">
                    <h3>Country</h3>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-9 text-left">
                        <div><i class="fa fa-check fa-5x"></i></div>
                    </div>
                    <div class="huge">{{ count($countries) }}</div>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-lg-4">
 <a href="{{url('system-management/state')}}" style="text-decoration: none;">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">
            <h3>State</h3>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-9 text-left">
                <div><i class="fa fa-times fa-5x"></i></div>
            </div>
            <div class="huge">{{ count($states) }}</div>
        </div>
    </div>
</div>
</a>
</div> 
<div class="col-lg-4">
 <a href="{{url('system-management/city')}}" style="text-decoration: none;">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">
            <h3>City</h3>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-9 text-left">
                <div><i class="fa fa-th-list fa-5x"></i></div>
            </div>
            <div class="huge">{{ count($cities) }}</div>
        </div>
    </div>
</div>
</a>
</div>  
</div> 
</div>

</a>
</div>   
</div> 
</div>
@endsection
