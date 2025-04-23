<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'amount',
        'status'
    ];
    
    // Define relationships, if necessary
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
