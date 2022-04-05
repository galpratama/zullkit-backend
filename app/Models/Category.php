<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name', 'thumbnails'
    ];    

    public function products()
    {
        return $this->hasMany(Product::class, 'categories_id', 'id');
    }

    public function getThumbnailsAttribute($thumbnails)
    {
        return config('app.url') . Storage::url($thumbnails);
    }
}
