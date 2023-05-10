<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'second_last_name',
        'email',
        'phone_number',
        'instagram_link',
        'facebook_link',
        'intro',
        'occupation',
        'image',
    ];
}
