<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $table = "cars_tags";
    
    protected $fillable = [
        'tag'
    ];
    
    public function cars()
    {
        return $this->belongsTo(App\Models\Cars::class);
    }
}
