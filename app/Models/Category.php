<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
   protected $table = 'category'; // tên bảng thủ công

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
