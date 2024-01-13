<?php

namespace App\Models;

use App\Enum\PaymentCategoryEnum;
use Illuminate\Database\Eloquent\Model;
use Cknow\Money\Casts\MoneyDecimalCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User $user
 */
class Payment extends Model
{
    use HasUuids;

    protected $fillable = ['amount_paid', 'amount_left', 'amount_back'];

    protected $casts = [
        'category' => PaymentCategoryEnum::class,
        'amount_paid' => MoneyDecimalCast::class . ':EUR,true',
        'amount_left' => MoneyDecimalCast::class . ':EUR,true',
        'amount_back' => MoneyDecimalCast::class . ':EUR,true',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
