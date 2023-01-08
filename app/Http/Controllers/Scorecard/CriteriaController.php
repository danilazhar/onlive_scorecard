<?php

namespace App\Http\Controllers\Scorecard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Criteria;
use Exception;
use Carbon\Carbon;
use Validator;

class CriteriaController extends Controller
{
    public function index(Request $request)
    {   

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $criterias = Criteria::orderBy('id', 'desc')->get();     
        return view('Criteria.index')
            ->with('criterias', $criterias);

    }

    public function create()
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $categories = Category::where('status', true)->get(); 
        $sub_categories = SubCategory::where('status', true)->get(); 
        return view('Criteria.create')
            ->with('categories', $categories)
            ->with('sub_categories', $sub_categories);

    }

    public function postCreate(Request $request)
    {

        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'sub_category' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('criteria.create')
                    ->withErrors($validator)
                    ->withInput();
        }

        try {

            Criteria::insert([
                'subcategory_id' =>  $request->get('sub_category'),
                'name' =>  $request->get('name'),
                'description' =>  $request->get('description'),
                'created_by' => request()->session()->get('user_id'),
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('criteria')->with('success', 'Criteria created.');
            
        } 
        catch (Exception $e) {

            return redirect()->route('criteria')->with('error', $e->getMessage());

        }

    }

    public function update(int $id) 
    {

        if(!Auth::check()){
            return redirect("/login")->with('error', 'You are not allowed to access');
        }

        $criteria = Criteria::firstWhere('id', $id);
        $categories = Category::where('status', true)->get();
        $sub_categories = SubCategory::where('status', true)->get();

        if($criteria == null) {

            return redirect()->route('criteria')->with('error', 'Criteria not found');

        }

        return view('Criteria.edit')
            ->with('criteria', $criteria)
            ->with('categories', $categories)
            ->with('sub_categories', $sub_categories);

    }

    public function postUpdate(Request $request, int $id)
    {

        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'sub_category' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('criteria.update', ['id' => $id])
                    ->withErrors($validator)
                    ->withInput();
        }
        
        try {
            
            $criteria = Criteria::find($id);
            $criteria->update([
                    'subcategory_id' =>  $request->get('sub_category'),
                    'name' =>  $request->get('name'),
                    'description' =>  $request->get('description'),
                    'updated_by' => request()->session()->get('user_id'),
                ]);

            return redirect()->route('criteria')->with('success', 'Criteria updated.');

        }
        catch (Exception $e) {

            return redirect()->route('criteria')->with('error', $e->getMessage());

        }

    }

    public function getCriteriaBySubCategory($id){
        
        $criterias = Criteria::getCriteriaBySubCategory($id);
        return response()->json(['criterias' => $criterias]);
        
    }

}