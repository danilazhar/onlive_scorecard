<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentSubCategory extends Model
{
    protected $table = 'department_subcategories';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'department_category_id',
        'subcategory_id',
        'critical',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

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

    public function department_category()
    {
        return $this->belongsTo(DepartmentCategory::class);
    }

    public function department_criterias()
    {
        return $this->hasMany(DepartmentCriteria::class, 'department_subcategory_id');
    }


}