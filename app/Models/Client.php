<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
