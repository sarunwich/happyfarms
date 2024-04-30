<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name','picture', 'type_id', 'packaging_id','unit','size_id','recommen','information','details', 'farm_id','status'];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }
    public function size()
    {
        return $this->belongsTo(size::class,'size_id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }
    public function packaging()
    {
        return $this->belongsTo(Packaging::class,'packaging_id');
    }
}
