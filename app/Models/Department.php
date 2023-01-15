<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
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

    public function passrates()
    {
        return $this->hasMany(Passrate::class);
    }

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function department_categories()
    {
        return $this->hasMany(DepartmentCategory::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}