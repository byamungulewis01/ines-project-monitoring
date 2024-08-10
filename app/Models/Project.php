<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'department_id',
        'title',
        'description',
        'proposal_file',
        'prototype_file',
        'visible',
        'price',
        'status',
        'comment',
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
