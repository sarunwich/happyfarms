<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    use HasFactory;
    protected $fillable = ['size_name'];
    // public function products()
    // {
    //     return $this->belongsTo(Product::class,'size_id','id');
    // }
}
