<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRequest extends Model
{
    use HasFactory;

    public $table = "chat_requests";

    protected $fillable = [
        'client_id',
        'freelancer_id'
    ];

    public function freelancer(){
        return $this->belongsTo(User::class, 'freelancer_id', 'id');
    }

    public function client(){
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

}
