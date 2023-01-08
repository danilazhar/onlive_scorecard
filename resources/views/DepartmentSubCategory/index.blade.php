@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Department Evaluation Sub Categories</li>
@endsection

@section('title')
    Department Sub Categories List
@endsection

@section('content')
@include('includes.alert')
    <section>
        <div class="card p-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9 align-middle pt-2">
                        <h3 class="card-title">List of Sub Categories</h3>
                    </div>
                    <div class="col-md-3 text-md-right">
                        @if(request()->session()->get('role_id') == 1)
                        <a href="{{ route('department_subcategory.create') }}" class="btn btn-success create"><i class="fas fa-plus-circle nav-icon pr-2"></i>Add</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="department_subcategories-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Department</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Description</th>
                            <th>Critical</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($sub_categories as $subcategory)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td style="width: 400px;">{{ $subcategory->department_category->department->name }}</td>
                                <td style="width: 400px;">{{ $subcategory->department_category->category->name }}</td>
                                <td style="width: 400px;"><a href="{{ route('department_subcategory.update', ['id' => $subcategory->id]) }}">{{ $subcategory->subcategory->name }}</a></td>
                                <td style="width: 500px;">{{ $subcategory->subcategory->description }}</td>
                                <td style="width: 500px;">{{ $subcategory->critical ? 'Yes' : 'No' }}</td>
                                <td>{{ $subcategory->status ? 'Active' : 'Inactive' }}</td>
                                <td style="width: 200px;">
                                    <a href="{{ route('department_subcategory.update', ['id' => $subcategory->id]) }}" class="btn btn-primary btn-sm edit"><i class="fas fa-pencil-alt"></i></a>
                                    @if(request()->session()->get('role_id') == 1)
                                    <a onclick="return confirm('Are you sure?')" href="{{ route('department_subcategory.delete', ['id' => $subcategory->id]) }}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i></a>
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
    <script src="{{ asset('assets/js/DepartmentSubCategory.js') }}"></script>
@endsection
