@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
    <h1><i class="fa fa-th-list"></i> Create Company</h1>
    <p>Create new company here</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Companies</li>
    <li class="breadcrumb-item active"><a href="#">Create</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Company</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('admin.companies.store') }}">
            @csrf
            <div class="tile-body">
                <div class="form-group row">
                <label class="control-label col-md-3">Name</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" name="name" placeholder="Enter full name" required>
                </div>
                </div>
                <div class="form-group row">
                <label class="control-label col-md-3">Action Line</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" name="action_line" placeholder="e.g Share number" required>
                </div>
                </div>
                <div class="form-group row">
                <label class="control-label col-md-3">Logo</label>
                <div class="col-md-8">
                    <input type="file" name="logo" accept="image/png, image/gif, image/jpeg">
                </div>
                </div>
            </div>
            <div class="tile-footer">
            <div class="row">
                <div class="col-md-8 col-md-offset-3">
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
                </div>
            </div>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection