<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'phone',
        'address',
        'user_id',
        'status',
        'total_price',
        'voucher_code',
         'voucher_id',
    ];

    /**
     * Mối quan hệ với người dùng (nếu có).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function voucher()
    {
        return $this->belongsTo(\App\Models\Voucher::class);
    }
        
}
