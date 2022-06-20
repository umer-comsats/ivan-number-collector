@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
    <h1><i class="fa fa-th-list"></i> Companies Numbers</h1>
    <p>View all the numbers of the companies here</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Numbers</li>
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
                <th>Company Name</th>
                <th>Number</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($numbers as $number)
                <tr>
                    <td>{{ $number->company->name }}</td>
                    <td>{{ $number->phone_number }}</td>
                    <td>
                        <form action="{{ route('admin.numbers.destroy', $number->id) }}" method="post" style="display: inline">
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