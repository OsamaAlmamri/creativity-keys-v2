<?php

namespace App\Models;

use Database\Factories\ContactMessageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    /** @use HasFactory<ContactMessageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'service_needed',
        'city_district',
        'is_emergency',
        'message',
        'is_read',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'is_emergency' => 'boolean',
            'is_read' => 'boolean',
        ];
    }
}
