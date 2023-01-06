<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'criterias';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'subcategory_id',
        'name',
        'description',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public static function getCriteriaBySubCategory($id)
    {
        return Criteria::where("sub_category_id", $id)->get();
    }


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function department_criterias()
    {
        return $this->hasMany(DepartmentCriteria::class);
    }
    
}