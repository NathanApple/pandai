<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'user_id', 'product_point_id', 'quantity', 'total', 'payment_url', 'status'
    ];

    public function pointProduct(): BelongsTo
    {
        return $this->belongsTo(PointProduct::class, 'product_point_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
