<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Services extends Model
{
    use  HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'image'
    ];

    public function serviceCategories()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_id');
    }
}
