<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    Protected $fillable =[
        'title',
        'description',
        'published',
        'image',
        'price',
        'Luggage',
        'Doors',
        'Passenger',
        'category_id'
    ];
}
