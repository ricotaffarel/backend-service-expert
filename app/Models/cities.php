<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cities extends Model
{
    use HasFactory;

    protected $table = 'indonesia_cities';

    protected $guarded = [];

    protected $fillable = [
        'province_code',
        'name',
    ];

}