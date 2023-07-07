@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('department_subcategory') }}">Department Sub Category</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('title')
Edit Department Evaluation Sub Category
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
    <form action="{{ route('department_subcategory.postUpdate', ['id' => $subcategory->id]) }}" method="POST">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control {{ $errors->has('department') ? 'is-invalid' : null }}" id="department" name="department">
                                        <option value="" selected="selected">--Please Select--</option>      
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ $subcategory->department_category->department_id == $department->id ? 'selected' : false }}>{{ $department->name }}</option>
                                        @endforeach                                    
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('department') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Category</label>
                                    <select class="form-control {{ $errors->has('category') ? 'is-invalid' : null }}" id="category" name="category">
                                        <option value="" selected="selected">--Please Select--</option>      
                                        @foreach ($department_categories as $categorylist)
                                            <option value="{{ $categorylist->id }}" {{ $subcategory->department_category_id == $categorylist->id ? 'selected' : false }}>{{ $categorylist->category->name }}</option>
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
                                    <select class="form-control {{ $errors->has('sub_category') ? 'is-invalid' : null }}" id="sub_category" name="sub_category">
                                        <option value="" selected="selected">--Please Select--</option>   
                                        @foreach ($sub_categories as $sub_category)
                                            <option value="{{ $sub_category->id }}" {{ $subcategory->subcategory_id == $sub_category->id ? 'selected' : false }}>{{ $sub_category->name }}</option>
                                        @endforeach                               
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('sub_category') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Critical</label>
                                    <select class="form-control {{ $errors->has('critical') ? 'is-invalid' : null }}" id="critical" name="critical">
                                        <option value="" selected="selected">--Please Select--</option>                                  
                                        <option value="1" {{ $subcategory->critical == 'yes' ? 'selected' : false }}>Yes</option>                                  
                                        <option value="0" {{ $subcategory->critical == 'no' ? 'selected' : false }}>No</option>                                  
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
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header"><i class="nav-icon fas fa-cog"></i>&nbsp; Settings</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="publish-date">Created at: </label>
                            <span>{{$subcategory->created_at}}</span>
                        </div>
                        <div class="form-group">
                            <label for="publish-date">Last updated: </label>
                            <span>{{$subcategory->updated_at}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection