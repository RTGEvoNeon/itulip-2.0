<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
    'total_count',
    'price',
    'total_price',
    'prepayment',
    'date',
    'total_count_box',
    'box_price',
    'client_id'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }
}
