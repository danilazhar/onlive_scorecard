@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('evaluation') }}">Evaluation</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('title')
Create Employee Evaluation
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
    <form action="{{ route('department_criteria.postCreate') }}" method="POST">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="employee">Employee</label>
                                            <select class="form-control {{ $errors->has('user') ? 'is-invalid' : null }}" id="user" name="user">
                                                <option value="" selected="selected">--Please Select--</option>      
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach                                    
                                            </select>
                                            <span class="error invalid-feedback">{{ $errors->first('user') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="evaluation_date">Date of Evaluation</label>
                                            <input type="date" name="evaluation_date" class="form-control {{ $errors->has('evaluation_date') ? 'is-invalid' : null }}"
                                                id="evaluation_date" placeholder="Evaluation date"  value="{{old('old_evaluation_date')}}">
                                            <span class="error invalid-feedback">{{ $errors->first('evaluation_date') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.d-flex -->
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                <div class="col-md-12">
                                    <table class="table mb-0" ref="total">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Achieved</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(key_exists('categories', $category_listing))
                                        @foreach($department_critical_category['categories'] as $critical_category)
                                            <tr>
                                                <th scope="row">
                                                    {{ $critical_category->category->name }}
                                                </th>
                                                <td>
                                                    <span class="total-critical" ref="category-{{ $critical_category->id }}">100%</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach($department_data['categories'] as $data)
                                            <tr>
                                                <th scope="row">
                                                    {{ $data->category->name }}
                                                </th>
                                                <td>
                                                    <span class="total" ref="category-{{ $data->id }}">100%</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                        <tr>
                                            <th scope="row">
                                                Final Score
                                            </th>
                                            <td>
                                                <span class="final" ref="final">100%</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.d-flex -->
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($department_critical_category_content['categories'] as $categories_critical)
                        <div class="col-lg-12">
                            <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                <h3 class="card-title"><strong>{{ $categories_critical->category->name }}</strong></h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    @foreach($department_critical_category_content['subcategories'] as $subcategories_critical)
                                        <div class="col-md-12">
                                            <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="title">{{ $subcategories_critical->subcategory->name }}</th>
                                                    <th style="width: 200px;">Points</th>
                                                    <th style="width: 200px;">Points Achieved</th>
                                                    <th class="sm">Perform?</th>
                                                    <th style="width: 400px;">Comments</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($subcategories_critical->department_criterias as $critical_criteria)
                                            <tr>
                                                <td class="sm">
                                                    {{ $critical_criteria->criteria->name }}
                                                </td>
                                                <td class="sm">
                                                    <input type="text"
                                                            categoryId="{{ $subcategories_critical->department_category_id }}"
                                                            id="points_criterias_{{ $critical_criteria->id }}"
                                                            name="points_criterias_{{ $critical_criteria->id }}"
                                                            class="form-control form-control-sm points_criterias hide"
                                                            data-critical="{{ $subcategories_critical->critical }}"
                                                            readonly
                                                            value="{{ $critical_criteria->points }}"/>
                                                </td>
                                                <td class="sm">
                                                    <input type="text"
                                                            categoryId="{{ $subcategories_critical->department_category_id }}"
                                                            id="points_achieved_criterias_{{ $critical_criteria->id }}"
                                                            name="points_achieved_criterias_{{ $critical_criteria->id }}"
                                                            class="form-control form-control-sm points_achieved_criterias hide"
                                                            data-original="{{ $subcategories_critical->points }}"
                                                            data-critical="{{ $subcategories_critical->critical }}"
                                                            readonly
                                                            value="{{ $critical_criteria->points }}"/>
                                                </td>
                                                <td class="sm">
                                                    <select class="form-control-sm is-perform"
                                                            data-critical="{{ $subcategories_critical->critical }}"
                                                            action="perform"
                                                            ref="{{ $critical_criteria->id }}"
                                                            categoryId="{{ $subcategories_critical->department_category_id }}"
                                                            id="perform_{{ $critical_criteria->id }}"
                                                            name="perform_{{ $critical_criteria->id }}">
                                                        <option value="yes">YES</option>
                                                        <option value="no">NO</option>
                                                        <option value="na">NA</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea
                                                        class="form-control comment form-control-sm"
                                                        categoryId="{{ $subcategories_critical->department_category_id }}"
                                                        id="comments_criterias_{{ $critical_criteria->id }}"
                                                        name="comments_criterias_{{ $critical_criteria->id }}"></textarea>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    @foreach($department_data['categories'] as $department_categories)
                        <div id="category-{{ $department_categories->id }}" class="col-lg-12">
                            <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                <h3 class="card-title"><strong>{{ $department_categories->category->name }}</strong></h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    @foreach($department_categories->department_subcategories as $department_subcategories)
                                    <div class="col-md-12">
                                        <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="title">{{ $department_subcategories->subcategory->name }}</th>
                                                <th style="width: 200px;">Points</th>
                                                <th style="width: 200px;">Points Achieved</th>
                                                <th class="sm">Perform?</th>
                                                <th style="width: 400px;">Comments</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($department_subcategories->department_criterias as $department_criteria)
                                        <tr>
                                            <input type="hidden"
                                                    categoryId="{{ $department_subcategories->department_category_id }}"
                                                    id="category_{{ $department_criteria->id }}"
                                                    name="category_{{ $department_criteria->id }}"
                                                    value="{{ $department_subcategories->department_category_id }}"/>
                                            <input type="hidden"
                                                    categoryId="{{ $department_subcategories->department_category_id }}"
                                                    id="subcategory_{{ $department_criteria->id }}"
                                                    name="subcategory_{{ $department_criteria->id }}"
                                                    value="{{ $department_criteria->campaign_subcategory_id }}"/>
                                            <input type="hidden"
                                                    categoryId="{{ $department_subcategories->department_category_id }}"
                                                    id="is_critical_{{ $department_criteria->id }}"
                                                    name="is_critical_{{ $department_criteria->id }}"
                                                    value="{{ $department_subcategories->critical }}"/>
                                            <td class="sm">
                                                {{ $department_criteria->criteria->name }}
                                            </td>
                                            <td class="sm">
                                                <input type="text"
                                                        categoryId="{{ $department_subcategories->department_category_id }}"
                                                        id="points_criterias_{{ $department_criteria->id }}"
                                                        name="points_criterias_{{ $department_criteria->id }}"
                                                        class="form-control form-control-sm points_criterias hide"
                                                        data-critical="{{ $department_subcategories->critical }}"
                                                        readonly
                                                        value="{{ $department_criteria->points }}"/>
                                            </td>
                                            <td class="sm">
                                                <input type="text"
                                                        categoryId="{{ $department_subcategories->department_category_id }}"
                                                        id="points_achieved_criterias_{{ $department_criteria->id }}"
                                                        name="points_achieved_criterias_{{ $department_criteria->id }}"
                                                        class="form-control form-control-sm points_achieved_criterias hide"
                                                        data-original="{{ $department_criteria->points }}"
                                                        data-critical="{{ $department_subcategories->critical }}"
                                                        readonly
                                                        value="{{ $department_criteria->points }}"/>
                                            </td>
                                            <td class="sm">
                                                <select class="form-control-sm is-perform"
                                                        data-critical="{{ $department_subcategories->critical }}"
                                                        action="perform"
                                                        ref="{{ $department_criteria->id }}"
                                                        categoryId="{{ $department_subcategories->department_category_id }}"
                                                        id="perform_{{ $department_criteria->id }}"
                                                        name="perform_{{ $department_criteria->id }}">
                                                    <option value="yes">YES</option>
                                                    <option value="no">NO</option>
                                                    <option value="na">NA</option>
                                                </select>
                                            </td>
                                            <td>
                                                <textarea
                                                    class="form-control comment form-control-sm"
                                                    categoryId="{{ $department_subcategories->department_category_id }}"
                                                    id="comments_criterias_{{ $department_criteria->id }}"
                                                    name="comments_criterias_{{ $department_criteria->id }}"></textarea>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="evaluator">Evaluator</label>
                                            <input type="text"
                                                id="evaluator"
                                                name="evaluator"
                                                class="form-control"
                                                readonly
                                                value="{{ $evaluator->name; }}"/>
                                            <span class="error invalid-feedback">{{ $errors->first('evaluator') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="remarks">Evaluator Remarks</label>
                                            <textarea
                                                class="form-control remarks form-control-sm"
                                                id="remarks"
                                                name="remarks"></textarea>
                                            <span class="error invalid-feedback">{{ $errors->first('remarks') }}</span>
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
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </form>
@endsection
@section('footer-script')
    <script src="{{ asset('assets/js/Evaluation.js') }}"></script>
@endsection