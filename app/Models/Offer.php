<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table= 'offers';
    protected $fillable = [
        'photo',
        'name_en',
        'name_ar',
        'price',
        'details_en',
        'details_ar',

    ];
    protected $hidden=[
   'created_at',
   'updated_at',
    ];
}
