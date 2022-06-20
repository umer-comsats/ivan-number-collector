@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
    <h1><i class="fa fa-th-list"></i> Edit Company</h1>
    <p>Edit new company here</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Companies</li>
    <li class="breadcrumb-item active"><a href="#">Edit</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Company</h3>
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('admin.companies.update', $company->id) }}">
            @csrf
            @method('patch')
            <div class="tile-body">
                <div class="form-group row">
                <label class="control-label col-md-3">Name</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" name="name" value="{{ $company->name }}" placeholder="Enter full name">
                </div>
                </div>
                <div class="form-group row">
                <label class="control-label col-md-3">Action Line</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" name="action_line" value="{{ $company->action_line }}" placeholder="e.g Share number" required>
                </div>
                </div>
                <div class="form-group row">
                <label class="control-label col-md-3">Logo</label>
                <div class="col-md-8">
                    <input type="file" name="logo">
                </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">Current Logo</label>
                    <div class="col-md-8"><img src="{{ asset('logo/'.$company->logo_path) }}" height="100" width="100" alt=""></div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">Checkbox Items</label>
                    <div class="col-md-8">
                        <button type="button" class="btn btn-info btn-sm" onclick="addItem(this)">Add</button>
                        <div class="items">
                            @foreach ($company->items as $item)
                            <input type="text" value="{{ $item->name }}" class="form-control mt-3" name="items[]" style="width: 20%">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tile-footer">
            <div class="row">
                <div class="col-md-8 col-md-offset-3">
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                </div>
            </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  
  <script>
    function addItem(e) {
        e.preventDefault;
        let elem = $('<input type="text" class="form-control mt-3" name="items[]" style="width: 20%">')
        $(".items").append(elem);
        elem.focus();
    }
  </script>
@endsection