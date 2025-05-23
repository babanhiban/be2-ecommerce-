<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Products extends Model
{
     protected $fillable = [
        'name',
        'image',
        'price',
        'quantity',
        'description',
        'category_id',
    ];
    public function category()
{
    return $this->belongsTo(Category::class);
}
     /**
     * Kiểm tra còn hàng hay không
     */
    public function isInStock()
    {
        return $this->quantity > 0;
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}


}
