<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name', 'subtitle', 'description', 'thumbnails', 'is_figma', 'is_sketch', 'features', 'users_id', 'categories_id' 
    ];    

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'products_id', 'id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
}
