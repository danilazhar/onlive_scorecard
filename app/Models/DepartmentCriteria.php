<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentCriteria extends Model
{
    protected $table = 'department_criterias';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'department_subcategory_id',
        'criteria_id',
        'points',
        'guidelines',
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

    public function department_subcategory()
    {
        return $this->belongsTo(DepartmentSubCategory::class, 'department_subcategory_id');
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

}