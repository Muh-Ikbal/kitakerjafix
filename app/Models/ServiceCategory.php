<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceCategory extends Model
{
use HasFactory;

// Tentukan nama tabel jika tidak sesuai konvensi Laravel
protected $table = 'service_categories';

// Kolom yang dapat diisi (mass assignable)
protected $fillable = [
'service_id',
'category_id',
];

// Jika kolom timestamps (created_at, updated_at) tidak ada
public $timestamps = false;

// Relasi ke model Service
public function service()
{
return $this->belongsTo(Services::class, 'service_id');
}

// Relasi ke model Category
public function category()
{
return $this->belongsTo(categories::class, 'category_id');
}
}
