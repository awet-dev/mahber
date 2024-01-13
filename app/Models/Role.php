<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static where(string $column, $operator = null, $value = null, $boolean = 'and')
 */
class Role extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * The users that belong to the role.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
