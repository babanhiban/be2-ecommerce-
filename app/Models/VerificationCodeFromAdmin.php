<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCodeFromAdmin extends Model
{
    use HasFactory;

    protected $table = 'verification_codes_from_admin';

    protected $fillable = [
        'email',
        'code',
        'type',
        'role_id',
        'created_by_admin_id',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Relationship với Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relationship với Admin (User) tạo mã
     */
    public function createdByAdmin()
    {
        return $this->belongsTo(User::class, 'created_by_admin_id');
    }

    /**
     * Kiểm tra mã có hết hạn không
     */
    public function isExpired()
    {
        return $this->expires_at < now();
    }

    /**
     * Scope để lấy mã chưa hết hạn
     */
    public function scopeValid($query)
    {
        return $query->where('expires_at', '>', now());
    }
}
