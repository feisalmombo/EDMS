<div class="form-group">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">{{isset($title) ? $title : 'Search'}}</h3>

    </div>
    <!-- /.box-header -->
    <div class="box-body">
      
      {{-- slot contain information about search form--}}

      {{ $slot }}

    </div>
    <!-- /.box-body -->
    <div class="form-group">
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">
          <span class="fa fa-search" aria-hidden="true"></span>
          Search
        </button>
      </div>
    </div>
  </div>
</div>