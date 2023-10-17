<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirm extends Model
{
    use HasFactory;
    protected $fillable = ['jaspeng', 'noresi','is_delivered'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
