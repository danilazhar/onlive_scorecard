@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('criteria') }}">Criteria</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('title')
Edit Criteria
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
    <form action="{{ route('criteria.postUpdate', ['id' => $criteria->id]) }}" method="POST">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Category</label>
                                    <select class="form-control" id="category" name="category" data-url="{{ url('/scorecard/selected_category/') }}">
                                        <option value="" selected="selected">--Please Select--</option>      
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $criteria->subcategory->category_id == $category->id ? 'selected' : false }}>{{ $category->name }}</option>
                                        @endforeach                                    
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('category') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_category">Sub Category</label>
                                    <select class="form-control {{ $errors->has('sub_category') ? 'is-invalid' : null }}" id="sub_category" name="sub_category">
                                        <option value="" selected="selected">--Please Select--</option>      
                                        @foreach ($sub_categories as $sub_category)
                                            <option value="{{ $sub_category->id }}" {{ $criteria->subcategory_id == $sub_category->id ? 'selected' : false }}>{{ $sub_category->name }}</option>
                                        @endforeach                                    
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('sub_category') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}"
                                        id="name" placeholder="Criteria name" value="{{$criteria->name}}">
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <input type="text" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : null }}"
                                        id="description" placeholder="Criteria description"  value="{{$criteria->description}}">
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
                            <span>{{$criteria->created_at}}</span>
                        </div>
                        <div class="form-group">
                            <label for="publish-date">Last updated: </label>
                            <span>{{$criteria->updated_at}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('footer-script')
    <script>
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
