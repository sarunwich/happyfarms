<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    protected $fillable = ['farm_id','title', 'image_path' ];
    public function farm()
{
    return $this->belongsTo(Farm::class);
}

}

