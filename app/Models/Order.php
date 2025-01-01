<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'service_id',
        'status',
        'order_date',
        'description',
        'budget'
    ];

    // Status default jika tidak ada nilai
    protected $attributes = [
        'status' => 'pending',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke model Service
    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id');
    }
}
