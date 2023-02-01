@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('department_criteria') }}">Department Criteria</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('title')
Edit Department Evaluation Criteria
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
    <form action="{{ route('department_criteria.postUpdate', ['id' => $criteria->id]) }}" method="POST">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control {{ $errors->has('department') ? 'is-invalid' : null }}" id="department" name="department" data-url="{{ url('/scorecard/department_subcategory/') }}">
                                        <option value="" selected="selected">--Please Select--</option>      
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ $criteria->department_subcategory->department_category->department_id == $department->id ? 'selected' : false }}>{{ $department->name }}</option>
                                        @endforeach                                    
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('department') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subcategory">Sub Category</label>
                                    <select class="form-control {{ $errors->has('subcategory') ? 'is-invalid' : null }}" id="subcategory" name="subcategory"  data-url="{{ url('/scorecard/selected_subcategory/') }}">
                                        <option value="" selected="selected">--Please Select--</option>
                                        @foreach ($department_subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" data-value="{{ $subcategory->sub_category_id }}" {{ $criteria->department_subcategory_id == $subcategory->id ? 'selected' : false }}>{{ $subcategory->subcategory->name }}</option>
                                        @endforeach 
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('subcategory') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="criteria">Criteria</label>
                                    <select class="form-control {{ $errors->has('criteria') ? 'is-invalid' : null }}" id="criteria" name="criteria" {{ (request()->session()->get('role_id') == '2') ? 'disabled' : false }} data-url="{{ url('/scorecard/selected_subcategory/') }}">
                                        <option value="" selected="selected">--Please Select--</option>
                                        @foreach ($criterias as $criteria_list)
                                            <option value="{{ $criteria_list->id }}" {{ $criteria->criteria_id == $criteria_list->id ? 'selected' : false }}>{{ $criteria_list->name }}</option>
                                        @endforeach 
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('criteria') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Points</label>
                                    <input type="number" name="points" class="form-control {{ $errors->has('points') ? 'is-invalid' : null }}"
                                        id="points" placeholder="Points"  value="{{ $criteria->points }}" min="0">
                                    <span class="error invalid-feedback">{{ $errors->first('points') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Guidelines</label>
                                    <textarea id="guidelines" class="form-control {{ $errors->has('guidelines') ? 'is-invalid' : null }}" name="guidelines" rows="4" cols="50">{{ $criteria->guidelines }}</textarea>
                                    <span class="error invalid-feedback">{{ $errors->first('guidelines') }}</span>
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
        $("#department").change(function() {
            var department_id = $(this).val();
            let subcategory = $('#subcategory');
            subcategory.empty();
            subcategory.append('<option value="" selected hidden>--Please Select--</option>');
            let url = $(this).attr('data-url');
            $.get(url + '/' + department_id, function (response) {
                subcategory.removeAttr('disabled');
                $.each(response.subcategories, function(i,obj){
                    subcategory.append(
                        $('<option></option>')
                            .attr("data-value", obj['sub_category_id'])
                            .val(obj['id'])
                            .html(obj['sub_category']['name'])
                    );
                });
            });
        });

        $("#subcategory").change(function() {
            var sub_category_id = $('option:selected', this).attr('data-value');
            let criteria = $('#criteria');
            criteria.empty();
            criteria.append('<option value="" selected hidden>--Please Select--</option>');
            let url = $(this).attr('data-url');
            $.get(url + '/' + sub_category_id, function (response) {
                console.log(response);
                criteria.removeAttr('disabled');
                $.each(response.criterias, function(i,obj){
                    criteria.append(
                        $('<option></option>')
                            .val(obj['id'])
                            .html(obj['name'])
                    );
                });
            });
        });
    </script>
@endsection