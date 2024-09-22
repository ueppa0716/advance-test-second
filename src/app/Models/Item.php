<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'condition_id',
        'name',
        'detail',
        'price',
        'photo',
    ];

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
