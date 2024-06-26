<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm_Staff extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','farm_id'];

    public function farm()
    {
        return $this->belongsToMany(Farm::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

