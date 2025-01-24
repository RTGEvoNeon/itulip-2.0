<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
    'total_count',
    'price',
    'prepayment',
    'date',
    'total_count_box',
    'box_price',
    'client_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            if (Auth::check()) { // Проверяем, что пользователь авторизован
                $builder->where('user_id', Auth::id());
            }
        });
    }
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }
}
