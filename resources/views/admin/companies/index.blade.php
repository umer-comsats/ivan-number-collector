@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
    <h1><i class="fa fa-th-list"></i> Companies</h1>
    <p>View all the companies here</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Companies</li>
    <li class="breadcrumb-item active"><a href="#">List</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
    <div class="tile">
        <div class="tile-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
                <tr>
                <th>Logo</th>
                <th>Company Name</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td>
                        <img src="{{ asset("logo/$company->logo_path") }}" width="50" height="50" alt="">
                    </td>
                    <td>{{ $company->name }}</td>
                    <td>
                        <a href="#" onclick="copyLink('{{ route('companies.show', $company->slug) }}')" class="btn btn-primary btn-sm">Copy URL</a>
                        <a href="{{ route('admin.numbers.index',['company' => $company->id]) }}" class="btn btn-warning btn-sm">View Numbers</a>
                        <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-info btn-sm">Edit</a>
                        <form action="{{ route('admin.companies.destroy', $company->id) }}" method="post" style="display: inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        @if ($message = Session::get('message'))
            toastr.info('{{ $message }}')
        @endif

        function copyLink(link) {
            navigator.clipboard.writeText(link);
            toastr.success('Link copied')
        }
    </script>
@endsection