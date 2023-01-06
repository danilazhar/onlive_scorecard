@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Evaluation</li>
@endsection

@section('title')
    Employee Evaluations
@endsection

@section('content')
@include('includes.alert')
<section>
    <div class="card p-3">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8 align-middle">
                    <h3 class="card-title">List of Evaluations</h3>
                </div>
                <div class="col-md-4">
                <form action="{{ route('evaluation.create') }}" method="POST">
                    <div class="row">
                        @csrf
                        <div class="col-md-9  text-md-right">
                            <select class="form-control" id="department" name="department">
                                <option value="" selected="selected">--Please Select--</option>      
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ (request()->session()->get('role_id') == '2' && $department->id == request()->session()->get('department_id')) ? 'selected' : false }}>{{ $department->name }}</option>
                                    @endforeach 
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button id="add-new-evaluation" class="btn btn-success create">
                                <i class="fa fa-plus"></i> New
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table id="evaluations-table" class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Evaluation ID</th>
                        <th>Department</th>
                        <th>Supervisor</th>
                        <th>Employee</th>
                        <th>Evaluation Date</th>
                        <th>Points</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td></td>
                            <td style="width: 400px;"></td>
                            <td style="width: 400px;"></td>
                            <td style="width: 400px;"></td>
                            <td style="width: 500px;"></td>
                            <td style="width: 500px;"></td>
                            <td></td>
                            <td></td>
                            <td style="width: 200px;"></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
@section('footer-script')
    <script src="{{ asset('assets/js/DepartmentCriteria.js') }}"></script>
@endsection
