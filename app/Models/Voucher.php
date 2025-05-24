<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'discount',
        'start_date',
        'end_date',
    ];
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }
    public function isExpired()
    {
        return $this->end_date && now()->gt(\Carbon\Carbon::parse($this->end_date));
    }

    public function getTypeLabelAttribute()
    {
        return match ($this->type) {
            'percent' => 'Giảm %',
            'fixed' => 'Giảm cố định',
            default => 'Không rõ',
        };
    }
}
