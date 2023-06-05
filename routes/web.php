<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\DepartmentController;
use App\Http\Controllers\Scorecard\PassrateController;
use App\Http\Controllers\Scorecard\CategoryController;
use App\Http\Controllers\Scorecard\SubCategoryController;
use App\Http\Controllers\Scorecard\CriteriaController;
use App\Http\Controllers\Scorecard\DepartmentCategoryController;
use App\Http\Controllers\Scorecard\DepartmentSubCategoryController;
use App\Http\Controllers\Scorecard\DepartmentCriteriaController;
use App\Http\Controllers\Scorecard\EvaluationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('auth.login');
Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login', [LoginController::class,'postLogin'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/create', [UserController::class, 'postCreate'])->name('user.postCreate');
Route::get('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::post('/user/{id}', [UserController::class, 'postUpdate'])->name('user.postUpdate');
Route::get('/user/delete/{id}', [UserController::class, 'edit'])->name('user.delete');
Route::post('/user/verify', [UserController::class, 'verify'])->name('user.verify');

Route::get('/role', [RoleController::class, 'index'])->name('role');
Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('/role/create', [RoleController::class, 'postCreate'])->name('role.postCreate');
Route::get('/role/{id}', [RoleController::class, 'update'])->name('role.update');
Route::post('/role/{id}', [RoleController::class, 'postUpdate'])->name('role.postUpdate');
Route::get('/role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');

Route::get('/department', [DepartmentController::class, 'index'])->name('department');
Route::get('/department/create', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/department/create', [DepartmentController::class, 'postCreate'])->name('department.postCreate');
Route::get('/department/{id}', [DepartmentController::class, 'update'])->name('department.update');
Route::post('/department/{id}', [DepartmentController::class, 'postUpdate'])->name('department.postUpdate');
Route::get('/department/delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');

Route::get('/scorecard/passrate', [PassrateController::class, 'index'])->name('passrate');
Route::get('/scorecard/passrate/create', [PassrateController::class, 'create'])->name('passrate.create');
Route::post('/scorecard/passrate/create', [PassrateController::class, 'postCreate'])->name('passrate.postCreate');
Route::get('/scorecard/passrate/{id}', [PassrateController::class, 'update'])->name('passrate.update');
Route::post('/scorecard/passrate/{id}', [PassrateController::class, 'postUpdate'])->name('passrate.postUpdate');
Route::get('/scorecard/passrate/delete/{id}', [PassrateController::class, 'delete'])->name('passrate.delete');

Route::get('/scorecard/category', [CategoryController::class, 'index'])->name('category');
Route::get('/scorecard/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/scorecard/category/create', [CategoryController::class, 'postCreate'])->name('category.postCreate');
Route::get('/scorecard/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::post('/scorecard/category/{id}', [CategoryController::class, 'postUpdate'])->name('category.postUpdate');
Route::get('/scorecard/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

Route::get('/scorecard/sub_category', [SubCategoryController::class, 'index'])->name('sub_category');
Route::get('/scorecard/sub_category/create', [SubCategoryController::class, 'create'])->name('sub_category.create');
Route::post('/scorecard/sub_category/create', [SubCategoryController::class, 'postCreate'])->name('sub_category.postCreate');
Route::get('/scorecard/sub_category/{id}', [SubCategoryController::class, 'update'])->name('sub_category.update');
Route::post('/scorecard/sub_category/{id}', [SubCategoryController::class, 'postUpdate'])->name('sub_category.postUpdate');
Route::get('/scorecard/sub_category/delete/{id}', [SubCategoryController::class, 'delete'])->name('sub_category.delete');
Route::get('/scorecard/selected_category/{id}', [SubCategoryController::class, 'getSubCategoryByCategory']);


Route::get('/scorecard/criteria', [CriteriaController::class, 'index'])->name('criteria');
Route::get('/scorecard/criteria/create', [CriteriaController::class, 'create'])->name('criteria.create');
Route::post('/scorecard/criteria/create', [CriteriaController::class, 'postCreate'])->name('criteria.postCreate');
Route::get('/scorecard/criteria/{id}', [CriteriaController::class, 'update'])->name('criteria.update');
Route::post('/scorecard/criteria/{id}', [CriteriaController::class, 'postUpdate'])->name('criteria.postUpdate');
Route::get('/scorecard/criteria/delete/{id}', [CriteriaController::class, 'delete'])->name('criteria.delete');
Route::get('/scorecard/selected_subcategory/{id}', [CriteriaController::class, 'getCriteriaBySubCategory']);


Route::get('/scorecard/department/category', [DepartmentCategoryController::class, 'index'])->name('department_category');
Route::get('/scorecard/department/category/create', [DepartmentCategoryController::class, 'create'])->name('department_category.create');
Route::post('/scorecard/department/category/create', [DepartmentCategoryController::class, 'postCreate'])->name('department_category.postCreate');
Route::get('/scorecard/department/category/{id}', [DepartmentCategoryController::class, 'update'])->name('department_category.update');
Route::post('/scorecard/department/category/{id}', [DepartmentCategoryController::class, 'postUpdate'])->name('department_category.postUpdate');
Route::get('/scorecard/department/category/delete/{id}', [DepartmentCategoryController::class, 'delete'])->name('department_category.delete');
Route::get('/scorecard/department_category/{id}', [DepartmentCategoryController::class, 'getCategoryByDepartment']);

Route::get('/scorecard/department/sub_category', [DepartmentSubCategoryController::class, 'index'])->name('department_subcategory');
Route::get('/scorecard/department/sub_category/create', [DepartmentSubCategoryController::class, 'create'])->name('department_subcategory.create');
Route::post('/scorecard/department/sub_category/create', [DepartmentSubCategoryController::class, 'postCreate'])->name('department_subcategory.postCreate');
Route::get('/scorecard/department/sub_category/{id}', [DepartmentSubCategoryController::class, 'update'])->name('department_subcategory.update');
Route::post('/scorecard/department/sub_category/{id}', [DepartmentSubCategoryController::class, 'postUpdate'])->name('department_subcategory.postUpdate');
Route::get('/scorecard/department/sub_category/delete/{id}', [DepartmentSubCategoryController::class, 'delete'])->name('department_subcategory.delete');
Route::get('/scorecard/department_subcategory/{id}', [DepartmentSubCategoryController::class, 'getSubCategoryByDepartment']);

Route::get('/scorecard/department/criteria', [DepartmentCriteriaController::class, 'index'])->name('department_criteria');
Route::get('/scorecard/department/criteria/create', [DepartmentCriteriaController::class, 'create'])->name('department_criteria.create');
Route::post('/scorecard/department/criteria/create', [DepartmentCriteriaController::class, 'postCreate'])->name('department_criteria.postCreate');
Route::get('/scorecard/department/criteria/{id}', [DepartmentCriteriaController::class, 'update'])->name('department_criteria.update');
Route::post('/scorecard/department/criteria/{id}', [DepartmentCriteriaController::class, 'postUpdate'])->name('department_criteria.postUpdate');
Route::get('/scorecard/department/criteria/delete/{id}', [DepartmentCriteriaController::class, 'delete'])->name('department_criteria.delete');

Route::get('/scorecard/evaluation', [EvaluationController::class, 'index'])->name('evaluation');
Route::post('/scorecard/evaluation/create', [EvaluationController::class, 'create'])->name('evaluation.create');
Route::post('/scorecard/evaluation/postCreate', [EvaluationController::class, 'postCreate'])->name('evaluation.postCreate');
Route::get('/scorecard/evaluation/{id}', [EvaluationController::class, 'update'])->name('evaluation.update');
Route::get('/scorecard/evaluation/delete/{id}', [EvaluationController::class, 'delete'])->name('evaluation.delete');
Route::post('/scorecard/evaluation/{id}', [EvaluationController::class, 'postUpdate'])->name('evaluation.postUpdate');



