<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'sort_id',
        'count',
        'user_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            if (Auth::check()) { // Проверяем, что пользователь авторизован
                $builder->where('user_id', Auth::id());
            }
        });
    }

    public function order() {
        return $this->belongsTo(Order::class);
    } 

    public function sort() {
        return $this->belongsTo(Sort::class);
    }
}
