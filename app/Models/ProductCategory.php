<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductCategory extends Pivot
{
    protected $table = 'product_category';

    protected $fillable = [
        'category_id',
        'product_id',
        
    ];




    public function products()
    {
        return $this->belongsToMany(Product::class) ->using(ProductCategory::class);
        
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('category_id')->withTimestamps();
    }
}
