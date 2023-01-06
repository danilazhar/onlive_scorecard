<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'subcategories';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public static function getSubCategoryByCategory($id)
    {
        return SubCategory::where("category_id", $id)->get();
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

    public function criterias()
    {
        return $this->hasMany(Criteria::class);
    }

    public function department_subcategories()
    {
        return $this->hasMany(DepartmentSubCategory::class);
    }
    
}