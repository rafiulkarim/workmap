<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'client_id',
        'freelancer_id',
        'gig_id',
        'message'
    ];

    public function reported_freelancer(){
        return $this->hasOne(User::class, 'id', 'freelancer_id');
    }

    public function reported_client(){
        return $this->hasOne(User::class, 'id', 'client_id');
    }

    public function reported_gig(){
        return $this->hasOne(Gig::class, 'id', 'gig_id');
    }
}
