<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'phone',
        'address',
        'total_price',
        'user_id', // nếu bạn dùng liên kết tới bảng users
        'status',
    ];

    /**
     * Mối quan hệ với người dùng (nếu có).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
