<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'title',
        'description',
        'date',
        'recipients',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'recipients' => 'array',
        ];
    }
}
