@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('department_subcategory') }}">Department Sub Category</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('title')
Create Department Evaluation Sub Category
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
    <form action="{{ route('department_subcategory.postCreate') }}" method="POST">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><i class="nav-icon fas fa-exclamation-circle"></i>&nbsp; Fill up all the informations required</div>
                    <div class="card-body">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control {{ $errors->has('department') ? 'is-invalid' : null }}" id="department" name="department" {{ (request()->session()->get('role_id') == '2') ? 'disabled' : false }} data-url="{{ url('/scorecard/department_category/') }}">
                                        <option value="" selected="selected">--Please Select--</option>      
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ (request()->session()->get('role_id') == '2' && $department->id == request()->session()->get('department_id')) ? 'selected' : false }}>{{ $department->name }}</option>
                                        @endforeach                                    
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('department') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control {{ $errors->has('category') ? 'is-invalid' : null }}" id="category" name="category" {{ (request()->session()->get('role_id') == '2') ? 'disabled' : false }} data-url="{{ url('/scorecard/selected_category/') }}">
                                        <option value="" selected="selected">--Please Select--</option>
                                        @foreach ($department_categories as $category)
                                            <option value="{{ $category->id }}" data-value="{{ $category->category_id }}">{{ $category->category->name }}</option>
                                        @endforeach 
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('category') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Sub Category</label>
                                    <select class="form-control {{ $errors->has('sub_category') ? 'is-invalid' : null }}" id="sub_category" name="sub_category" disabled>
                                        <option value="" selected="selected">--Please Select--</option>                                  
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('sub_category') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Critical</label>
                                    <select class="form-control {{ $errors->has('critical') ? 'is-invalid' : null }}" id="critical" name="critical">
                                        <option value="" selected="selected">--Please Select--</option>                                  
                                        <option value="yes">Yes</option>                                  
                                        <option value="no">No</option>                                  
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('critical') }}</span>
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
        </div>
    </form>
@endsection
@section('footer-script')
    <script>
        $("#department").change(function() {
            var department_id = $(this).val();
            let category = $('#category');
            category.empty();
            category.append('<option value="" selected hidden>--Please Select--</option>');
            let url = $(this).attr('data-url');
            $.get(url + '/' + department_id, function (response) {
                category.removeAttr('disabled');
                console.log(response.categories);
                $.each(response.categories, function(i,obj){
                    category.append(
                        $('<option></option>')
                            .attr("data-value", obj['category_id'])
                            .val(obj['category']['id'])
                            .html(obj['category']['name'])
                    );
                });
            });
        });

        $("#category").change(function() {
            var category_id = $(this).val();
            let subcategory = $('#sub_category');
            subcategory.empty();
            subcategory.append('<option value="" selected hidden>--Please Select--</option>');
            let url = $(this).attr('data-url');
            $.get(url + '/' + category_id, function (response) {
                subcategory.removeAttr('disabled');
                $.each(response.subcategories, function(i,obj){
                    subcategory.append(
                        $('<option></option>')
                            .val(obj['id'])
                            .html(obj['name'])
                    );
                });
            });
        });
    </script>
@endsection