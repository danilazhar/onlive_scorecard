<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationPoint extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'evaluation_id',
        'department_criteria_id',
        'points',
        'comments',
        'critical',
        'perform',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function department_criteria()
    {
        return $this->belongsTo(DepartmentCriteria::class, 'department_criteria_id');
    }
}