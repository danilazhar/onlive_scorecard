<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'department_id',
        'user_id',
        'supervisor_id',
        'date_of_audit',
        'total_score',
        'remarks',
        'status',
        'created_by',
        'created_at',
        'updated_at'
    ];
}