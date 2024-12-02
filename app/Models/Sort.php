<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }
}
