<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'sort_id',
        'count',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    } 

    public function sort() {
        return $this->belongsTo(Sort::class);
    }
}
