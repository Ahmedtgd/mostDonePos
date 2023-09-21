<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('order_id','name')->withTimestamps();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('category_id','category_name')->withTimestamps();
    }

  
}

