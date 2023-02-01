@extends('includes.login_layout')

@section('content')
@include('includes.alert')
<!-- /.login-logo -->
<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h3">Online Scoresheet</a>
      
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('login.post') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : NULL }}" placeholder="Email" value="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
        </div>
        
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control {{$errors->has('email') ? 'is-invalid' : NULL }}" placeholder="Password" value="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
        </div>
        <div class="row">                  
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-dark btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection
