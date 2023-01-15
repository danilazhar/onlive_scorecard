<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentCategory extends Model
{
    protected $table = 'department_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'department_id',
        'category_id',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public static function getCategoryByDepartment($id)
    {
        return DepartmentCategory::where('department_id', $id)
                ->with('category:id,name')->orderBy('id', 'DESC')
                ->get();
    }

    public static function getAllCriterias($department_id)
    {
        $criterias = DepartmentCriteria::with('department_subcategory')
            ->whereHas('department_subcategory', function ($querySubCategory) use ($department_id) {
                $querySubCategory->with('department_category')
                    ->whereHas('department_category', function ($queryCategory) use ($department_id) {
                        $queryCategory->where('department_id', '=', $department_id);
                    });
                $querySubCategory->where('critical', 'no');
            })
            ->where('status', true)
            ->orderBy('id', 'ASC')
            ->get();

        $categories = [];
        $subcategories = [];
        foreach ($criterias as $criteria) {
            $subcategory = $criteria->department_subcategory;
            $category = $subcategory->department_category;
            if (!key_exists($category->id, $categories)) {
                $categories[$category->id] = $category;
            }
            if (!key_exists($subcategory->id, $subcategories)) {
                $subcategories[$subcategory->id] = $subcategory;
            }
        }

        return [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'criterias' => $criterias
        ];
    }

    public static function getCategoryForAllCriteria($department_id){
        $criterias = DepartmentCriteria::with('department_subcategory')
            ->whereHas('department_subcategory', function ($querySubCategory) use ($department_id) {
                $querySubCategory->with('department_category')
                    ->whereHas('department_category', function ($queryCategory) use ($department_id) {
                        $queryCategory->where('department_id', '=', $department_id);
                    });
            })
            ->where('status', true)
            ->orderBy('id', 'ASC')
            ->get();

        $categories = [];
        foreach ($criterias as $criteria) {
            $subcategory = $criteria->department_subcategory;
            $category = $subcategory->department_category;
            if (!key_exists($category->id, $categories)) {
                $categories[$category->id] = $category;
            }

        }

        return [
            'categories' => $categories
        ];
    }

    public static function getAllCriticalCriterias($department_id)
    {
        $criterias = DepartmentCriteria::with('department_subcategory')
            ->whereHas('department_subcategory', function ($querySubCategory) use ($department_id) {
                $querySubCategory->with('department_category')
                    ->whereHas('department_category', function ($queryCategory) use ($department_id) {
                        $queryCategory->where('department_id', '=', $department_id);
                    });
                $querySubCategory->where('critical', 'yes');
            })
            ->orderBy('id', 'ASC')
            ->get();

        $categories = [];
        $subcategories = [];
        foreach ($criterias as $criteria) {
            $subcategory = $criteria->department_subcategory;
            $category = $subcategory->department_category;
            if (!key_exists($category->id, $categories)) {
                $categories[$category->id] = $category;
            }
            if (!key_exists($subcategory->id, $subcategories)) {
                $subcategories[$subcategory->id] = $subcategory;
            }
        }

        return [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'criterias' => $criterias
        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function department_subcategories()
    {
        return $this->hasMany(DepartmentSubCategory::class);
    }
    
}