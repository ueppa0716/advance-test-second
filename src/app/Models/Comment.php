<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'item_id',
        'comment',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
