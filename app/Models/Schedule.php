<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $attributes)
 * @property User $user
 */
class Schedule extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'description', 'time', 'user_id', 'group'];

    protected $casts = [
        'time' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
