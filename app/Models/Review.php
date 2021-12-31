<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $table = "reviews";

    protected $fillable = [
        'freelancer_id',
        'client_id',
        'gig_id',
        'rating',
        'review'
    ];

    public function client_details(){
        return $this->hasOne(Detail::class, 'user_id', 'client_id');
    }
    public function client(){
        return $this->hasOne(User::class, 'id', 'client_id');
    }
}
