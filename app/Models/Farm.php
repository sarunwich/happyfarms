<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address','phone','lat','long','description','business_hours','image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }
    // public function lot()
    // {
    //     return $this->hasMany(Lot::class);
    // }
}
