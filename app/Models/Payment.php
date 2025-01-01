<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'order_id',
        'payment_method',
        'amount',
        'status',
        'payment_date',
        'snap_token'
    ];

    // Status default jika tidak ada nilai
    protected $attributes = [
        'status' => 'pending',
    ];

    // Relasi ke model Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
