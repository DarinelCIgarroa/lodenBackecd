<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone_number',
        'mail',
        'message',
        'event_id'
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
