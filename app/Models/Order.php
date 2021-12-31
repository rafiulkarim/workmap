<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'gig_id',
        'user_id',
        'payment_status',
        'review_status',
        'qty',
        'subtotal'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }

    public function gig()
    {
        return $this->hasOne(Gig::class, 'id', 'gig_id');
    }

}
