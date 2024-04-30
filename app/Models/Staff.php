<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address','phone','picture','role','farm_id'];
   
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

  
}
