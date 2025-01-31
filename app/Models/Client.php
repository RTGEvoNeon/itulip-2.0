<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Client extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'phone',
        'other_phone',
        'comment',
        'messenger',
        'other_messenger',
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

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
