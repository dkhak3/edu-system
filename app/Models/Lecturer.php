<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;

class Lecturer extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;
    protected $table="lecturers";

    protected $fillable = [
        'name',
        'address',
        'phone',
        'birthday',
    ];
    public $sortable = ['id', 'name', 'address', 'phone', 'birthday', 'created_at', 'updated_at'];
}
