@if (Session::has('success'))
    <div>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i>{{ Session::get('success') }}</h5>
        </div>
    </div>
@endif
@if (Session::has('error'))
    <div>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation"></i>{{ Session::get('error') }}</h5>   
        </div>
    </div>
@endif