<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Sort extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которые можно массово заполнять.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'planted',
        'collected',
        'ordered',
        'user_id',
    ];

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
