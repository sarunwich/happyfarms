<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address','phone','lat','long','description','image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
