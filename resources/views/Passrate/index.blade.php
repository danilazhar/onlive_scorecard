@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Passrates</li>
@endsection

@section('title')
    Passing Scores List
@endsection

@section('content')
@include('includes.alert')
    <section>
        <div class="card p-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9 align-middle pt-2">
                        <h3 class="card-title">List of Passrates</h3>
                    </div>
                    <div class="col-md-3 text-md-right">
                        @if(request()->session()->get('role_id') == 3)
                        <a href="{{ route('passrate.create') }}" class="btn btn-success create"><i class="fas fa-plus-circle nav-icon pr-2"></i>Add</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="passrates-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Department</th>
                            <th>Rate</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($passrates as $passrate)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td style="width: 500px;"><a href="{{ route('passrate.update', ['id' => $passrate->id]) }}">{{ $passrate->department->name }}</a></td>
                                <td style="width: 400px;">{{ $passrate->rate }}</td>
                                <td>{{ $passrate->status ? 'Active' : 'Inactive' }}</td>
                                <td style="width: 200px;">
                                    <a href="{{ route('passrate.update', ['id' => $passrate->id]) }}" class="btn btn-primary btn-sm edit"><i class="fas fa-pencil-alt"></i></a>
                                    @if(request()->session()->get('role_id') == 1)
                                    <a onclick="return confirm('Are you sure?')" href="{{ route('passrate.delete', ['id' => $passrate->id]) }}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
@section('footer-script')
    <script src="{{ asset('assets/js/Passrate.js') }}"></script>
@endsection
