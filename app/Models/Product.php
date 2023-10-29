<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
	
	protected $fillable = [
        'name', 'detail', 'unit_id', 'price', 'discount_percentage', 'discount_amount', 'discount_range_date', 'tax_percentage', 'tax_amount' 
    ];
	
	public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
