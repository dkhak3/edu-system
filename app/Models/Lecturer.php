<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Lecturer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table="lecturers";

    protected $fillable = [
        'lecturer_name',
        'lecturer_address',
        'lecturer_phone',
        'lecturer_birthday',
    ];
}
