<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm_Staff extends Model
{
    use HasFactory;
    protected $fillable = ['packaging_name','farm_id'];
}
