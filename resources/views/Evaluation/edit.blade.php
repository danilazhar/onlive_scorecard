@extends('includes.layout')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('evaluation') }}">Evaluation</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('title')
Edi Employee Evaluation
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
    <form action="{{ route('evaluation.postUpdate', ['id' => $evaluation->id]) }}" method="POST">
    <input type="hidden" id="passrate" name="passrate"
               value="{{$passrate}}"/>
    <input type="hidden" id="evaluation_id" name="evaluation_id" value="{{$evaluation->id}}"/>
    <input type="hidden" id="total_score" name="total_score" value="{{$evaluation->total_score}}">
    <input type="hidden" id="department_id" name="department_id" value="{{$evaluation->department_id}}"/>
    <input type="hidden" id="result" name="result" value="{{$evaluation->result}}"/>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                            @csrf
                                <div class="d-flex">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="evaluator">Department</label>
                                            <input type="text"
                                                id="department"
                                                name="department"
                                                class="form-control"
                                                readonly
                                                value="{{ $evaluation->department->name; }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="employee">Employee</label>
                                            <select class="form-control {{ $errors->has('user') ? 'is-invalid' : null }}" id="user_id" name="user_id">
                                                <option value="" selected="selected">--Please Select--</option>      
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ $user->id == $evaluation->user_id ? 'selected' : false }}>{{ $user->name }}</option>
                                                @endforeach                                    
                                            </select>
                                            <span class="error invalid-feedback">{{ $errors->first('user') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-primary card-outline">
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
                                        <tr>
                                            <th scope="row">
                                                OVERALL STATUS
                                            </th>
                                            <td>
                                                <div id="passlabel" class="alert alert-success" role="alert">
                                                    <b>Passed</b>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($department_critical_category_content['categories'] as $categories_critical)
                        <div class="col-lg-12">
                            <div class="card card-danger card-outline">
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
                                                            value=""/>
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
                            <div class="card card-success card-outline">
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
                                        {{-- @foreach($department_subcategories->department_criterias as $department_criteria) --}}
                                        @foreach($evaluation_points as $evaluations)
                                        @if($evaluations->department_criteria->department_subcategory->id == $department_subcategories->id)
                                        <tr>
                                            <input type="hidden"
                                                    categoryId="{{ $evaluations->department_criteria->department_subcategory->department_category->id }}"
                                                    id="category_{{ $evaluations->department_criteria_id }}"
                                                    name="category_{{ $evaluations->department_criteria_id }}"
                                                    value="{{ $evaluations->department_criteria->department_subcategory->department_category->id }}"/>
                                            <input type="hidden"
                                                    categoryId="{{ $evaluations->department_criteria->department_subcategory->department_category->id }}"
                                                    id="subcategory_{{ $evaluations->department_criteria_id }}"
                                                    name="subcategory_{{ $evaluations->department_criteria_id }}"
                                                    value="{{ $evaluations->department_criteria->department_subcategory->department_category->id }}"/>
                                            <input type="hidden"
                                                    categoryId="{{ $evaluations->department_criteria->department_subcategory->department_category->id }}"
                                                    id="is_critical_{{ $evaluations->department_criteria_id }}"
                                                    name="is_critical_{{ $evaluations->department_criteria_id }}"
                                                    value="{{ $evaluations->department_criteria->department_subcategory->critical }}"/>
                                            <td class="sm">
                                                {{ $evaluations->department_criteria->criteria->name }}
                                            </td>
                                            <td class="sm">
                                                <input type="text"
                                                        categoryId="{{ $evaluations->department_criteria->department_subcategory->department_category->id }}"
                                                        id="points_criterias_{{ $evaluations->department_criteria_id }}"
                                                        name="points_criterias_{{ $evaluations->department_criteria_id }}"
                                                        class="form-control form-control-sm points_criterias  @if ($evaluations->department_criteria->department_subcategory->critical == 'yes') hide @endif"
                                                        data-critical="{{ $evaluations->department_criteria->department_subcategory->critical }}"
                                                        readonly
                                                        value="{{ $evaluations->department_criteria->points }}"/>
                                            </td>
                                            <td class="sm">
                                                <input type="text"
                                                        categoryId="{{ $evaluations->department_criteria->department_subcategory->department_category->id }}"
                                                        id="points_achieved_criterias_{{ $evaluations->department_criteria_id }}"
                                                        name="points_achieved_criterias_{{ $evaluations->department_criteria_id }}"
                                                        class="form-control form-control-sm points_achieved_criterias @if ($evaluations->department_criteria->department_subcategory->critical == 'yes') hide @endif"
                                                        data-original="{{ $evaluations->department_criteria->points }}"
                                                        data-critical="{{ $evaluations->department_criteria->department_subcategory->critical }}"
                                                        readonly
                                                        value="{{ $evaluations->points }}"/>
                                            </td>
                                            <td class="sm">
                                                <select class="form-control-sm is-perform"
                                                        data-critical="{{ $evaluations->department_criteria->department_subcategory->critical }}"
                                                        action="perform"
                                                        ref="{{ $evaluations->department_criteria_id }}"
                                                        categoryId="{{ $evaluations->department_criteria->department_subcategory->department_category->id }}"
                                                        id="perform_{{ $evaluations->department_criteria_id }}"
                                                        name="perform_{{ $evaluations->department_criteria_id }}">
                                                    <option value="yes" @if($evaluations->perform == "yes") selected @endif>YES</option>
                                                    <option value="no" @if($evaluations->perform == "no") selected @endif>NO</option>
                                                    <option value="na" @if($evaluations->perform == "na") selected @endif>NA</option>
                                                </select>
                                            </td>
                                            <td>
                                                <textarea
                                                    class="form-control comment form-control-sm"
                                                    categoryId="{{ $evaluations->department_criteria->department_subcategory->department_category->id }}"
                                                    id="comments_criterias_{{ $evaluations->department_criteria_id }}"
                                                    name="comments_criterias_{{ $evaluations->department_criteria_id }}"></textarea>
                                            </td>
                                        </tr>
                                        @endif
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
                        <div class="card card-primary card-outline">
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