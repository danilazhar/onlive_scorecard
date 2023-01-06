@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Evaluation Criterias</li>
@endsection

@section('title')
    Criteria List
@endsection

@section('content')
@include('includes.alert')
    <section>
        <div class="card p-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9 align-middle pt-2">
                        <h3 class="card-title">List of Evaluation Criterias</h3>
                    </div>
                    <div class="col-md-3 text-md-right">
                        @if(request()->session()->get('role_id') == 1)
                        <a href="{{ route('criteria.create') }}" class="btn btn-success create"><i class="fas fa-plus-circle nav-icon pr-2"></i>Add</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="criterias-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($criterias as $criteria)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td style="width: 400px;">{{ $criteria->sub_category->category->name }}</td>
                                <td style="width: 400px;">{{ $criteria->sub_category->name }}</td>
                                <td style="width: 400px;"><a href="{{ route('criteria.update', ['id' => $criteria->id]) }}">{{ $criteria->name }}</a></td>
                                <td style="width: 500px;">{{ $criteria->description }}</td>
                                <td>{{ $criteria->status ? 'Active' : 'Inactive' }}</td>
                                <td style="width: 200px;">
                                    <a href="{{ route('criteria.update', ['id' => $criteria->id]) }}" class="btn btn-primary btn-sm edit"><i class="fas fa-pencil-alt"></i></a>
                                    @if(request()->session()->get('role_id') == 1)
                                    <a onclick="return confirm('Are you sure?')" href="{{ route('criteria.delete', ['id' => $criteria->id]) }}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i></a>
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
    <script src="{{ asset('assets/js/Criteria.js') }}"></script>
@endsection
