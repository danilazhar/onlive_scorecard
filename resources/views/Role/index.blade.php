@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('title')
    User Roles List
@endsection

@section('content')
@include('includes.alert')
    <section>
        <div class="card p-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9 align-middle pt-2">
                        <h3 class="card-title">List of user Roles</h3>
                    </div>
                    <div class="col-md-3 text-md-right">
                        <a href="{{ route('role.create') }}" class="btn btn-success create"><i class="fas fa-plus-circle nav-icon pr-2"></i>Add</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="roles-table" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><a href="{{ route('role.update', ['id' => $role->id]) }}" class="edit">{{ $role->name }}</a></td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->creator->name }}</td>
                                <td>
                                <a href="{{ route('role.update', ['id' => $role->id]) }}" class="btn btn-primary btn-sm edit"><i class="fas fa-pencil-alt"></i></a>
                                <a href="{{ route('role.delete', ['id' => $role->id]) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i></a>
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
    <script src="{{ asset('assets/js/Role.js') }}"></script>
@endsection
