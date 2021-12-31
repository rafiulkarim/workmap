<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    use HasFactory;

    protected $table = 'gigs';

    protected $fillable = [
        'title',
        'image',
        'description',
        'price',
        'delivery_time',
        'cat_id',
        'sub_cat_id',
        'user_id',
    ];

    public function giguser()
    {
        return $this->belongsTo(User::class,
            'user_id', // gig table foreign key
            'id' // user table local key
        );
    }

    public function giguserdetails()
    {
        return $this->hasOne(Detail::class, 'user_id', 'user_id');
    }


}
