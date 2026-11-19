<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    protected $table = 'equipment';

    // Allowed values, reused by validation, forms and report filters
    public const CATEGORIES = ['paddles', 'balls', 'nets', 'accessories'];
    public const STATUSES = ['available', 'unavailable'];

    protected $fillable = [
        'user_id',
        'equipment_name',
        'category',
        'unit_price',
        'description',
        'availability_status',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
    ];

    // An Equipment record belongs to a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}