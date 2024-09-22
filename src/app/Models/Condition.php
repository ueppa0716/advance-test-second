<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'condition',
    ];

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
