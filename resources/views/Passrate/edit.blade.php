@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('passrate') }}">Passrates</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('title')
Edit Passing Score
@endsection

@section('content')
    @if (Session::has('error'))
        <div>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                {{ Session::get('error') }}
            </div>
        </div>
    @endif
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
    <form action="{{ route('passrate.postUpdate', ['id' => $passrate->id]) }}" method="POST">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control" id="department" name="department" disabled>
                                        <option value="" selected="selected">--Please Select--</option>      
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ $passrate->department_id == $department->id ? 'selected' : false }}>{{ $department->name }}</option>
                                        @endforeach                                    
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('department') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rate">Rate</label>
                                    <input type="number" name="rate" class="form-control {{ $errors->has('rate') ? 'is-invalid' : null }}"
                                        id="email" placeholder="Passing rate"  value="{{$passrate->rate}}">
                                    <span class="error invalid-feedback">{{ $errors->first('rate') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                        <button type="button" class="btn btn-default">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header"><i class="nav-icon fas fa-cog"></i>&nbsp; Settings</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="publish-date">Created at: </label>
                            <span>{{$passrate->created_at}}</span>
                        </div>
                        <div class="form-group">
                            <label for="publish-date">Last updated: </label>
                            <span>{{$passrate->updated_at}}</span>
                        </div>
                        <div class="form-group">
                            <label for="tags">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" {{ $passrate->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $passrate->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
