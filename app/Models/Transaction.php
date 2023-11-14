<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'user_id', 'product_point_id', 'quantity', 'total', 'payment_url', 'status'
    ];

    public function pointProduct(){
        return $this->belongsTo(PointProduct::class);
    }
}
