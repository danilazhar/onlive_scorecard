@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('role') }}">Roles</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('title')
Edit Roles
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
    <form action="{{ route('role.postUpdate', ['id' => $role->id]) }}" method="POST">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}"
                                        id="name" placeholder="Role name" value="{{$role->name}}">
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <input type="text" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : null }}"
                                        id="description" placeholder="Role description"  value="{{$role->description}}">
                                    <span class="error invalid-feedback">{{ $errors->first('description') }}</span>
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
                            <span>{{$role->created_at}}</span>
                        </div>
                        <div class="form-group">
                            <label for="publish-date">Last updated: </label>
                            <span>{{$role->updated_at}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
