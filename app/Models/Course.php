<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','startdate','enddate'];
    public function getAllUserIds()
    {
        return $this->pluck('id')->toArray();
    }
}
