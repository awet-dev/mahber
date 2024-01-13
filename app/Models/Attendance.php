<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $attributes)
 * @property int $id
 */
class Attendance extends Model
{
    use HasUuids;

    protected $fillable = ['attended', 'description', 'attended_at'];

    protected $casts = [
        'attended' => 'boolean',
        'attended_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
