@extends('includes.layout')

@section('title')
Verify User
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
    <form action="{{ route('user.verify') }}" method="POST">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><i class="nav-icon fas fa-exclamation-circle"></i>&nbsp; Verify yourself. You need to change your password to be verified.</div>
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">New Password</label>
                                    <input type="password" placeholder="New password" id="new_password" class="form-control" name="new_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Re-enter Password</label>
                                    <input type="password" placeholder="Re-enter password" id="repeat_password" class="form-control" name="repeat_password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                        <button type="submit" class="btn btn-default">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection