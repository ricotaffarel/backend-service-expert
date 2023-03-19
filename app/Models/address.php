<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $guarded = [];

    protected $fillable = [
        'province_code',
        'user_id',
        'city_code',
        'district_code',
        'villages_code',
        'title',
        'detail_address',
    ];
}
