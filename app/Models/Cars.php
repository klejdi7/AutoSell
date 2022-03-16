<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;
    protected $table = "cars";

    protected $fillable = [
        'id', 'description','brand_id', 'model', 'price', 'image', 'status', 'engine'
    ];

    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class);
    }

    public function tags()
    {
        return $this->hasMany(\App\Models\Tags::class);
    }
}
