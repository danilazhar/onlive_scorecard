<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="{{ asset('assets/css/adminlte.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
        <title>User Login</title>
    </head>
    <body class="login-page" cz-shortcut-listen="true" style="min-height: 466px;">
        <div class="login-box" style="width: 500px;">
          @yield('content')
        </div>
        <!-- /.login-box -->        
    </body>
</html>