<?php

namespace App\Models;

use Database\Factories\ReviewFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_title',
        'rating',
        'comment',
        'service_rendered',
        'avatar_url',
        'is_approved',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_approved' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
