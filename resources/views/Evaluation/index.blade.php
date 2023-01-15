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
                        <th>Department</th>
                        <th>Supervisor</th>
                        <th>Employee</th>
                        <th>Evaluation Date</th>
                        <th>Points</th>
                        <th>Result</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach ($evaluations as $evaluation)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td style="width: 400px;">{{ $evaluation->department->name }}</td>
                            <td style="width: 400px;">{{ $evaluation->evaluator->name }}</td>
                            <td style="width: 500px;">{{ $evaluation->user->name }}</td>
                            <td style="width: 500px;">{{ ($evaluation->date_of_audit) ? date('d-m-Y h:i A', strtotime($evaluation->date_of_audit)) : '' }}</td>
                            <td style="width: 100px;">{{ $evaluation->total_score }}</td>
                            <td style="width: 100px;">{{ $evaluation->result ? 'Passed' : 'Failed' }}</td>
                            <td>{{ ($evaluation->status == 0) ? "Draft" : (($evaluation->status == 1) ? "Saved" : "Deleted") }}</td>
                            <td style="width: 200px;">
                                <a href="{{ route('evaluation.update', ['id' => $evaluation->id]) }}" class="btn btn-primary btn-sm edit"><i class="fas fa-pencil-alt"></i></a>
                                @if(request()->session()->get('role_id') == 1 && $evaluation->status == 0)
                                <a onclick="return confirm('Are you sure?')" href="{{ route('evaluation.delete', ['id' => $evaluation->id]) }}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i></a>
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
    <script src="{{ asset('assets/js/Evaluation.js') }}"></script>
@endsection
