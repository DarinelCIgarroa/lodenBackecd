<?php

namespace App\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'place',
        'address',
        'city',
        'image',
        'status',
        'type',
    ];

    public function Messages() {
        return $this->hasMany(Message::class);
    }
}
