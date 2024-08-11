<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['sponser_id', 'project_id'];
    public function sponser()
    {
        return $this->belongsTo(Student::class);
    }
}
