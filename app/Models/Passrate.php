<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passrate extends Model
{
    protected $table = 'passrates';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'department_id',
        'rate',
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

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}