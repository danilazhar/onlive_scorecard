@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('role') }}">Role</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('title')
Create User Role
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
    <form action="{{ route('role.postCreate') }}" method="POST">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><i class="nav-icon fas fa-exclamation-circle"></i>&nbsp; Fill up all the informations required</div>
                    <div class="card-body">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}"
                                        id="code" placeholder="Role name"  value="{{old('old_name')}}">
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : null }}"
                                        id="description" placeholder="Role description"  value="{{old('old_description')}}">
                                    <span class="error invalid-feedback">{{ $errors->first('description') }}</span>
                                </div>
                            </div>
                        </div>
                        <hr>
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
        </div>
    </form>
@endsection