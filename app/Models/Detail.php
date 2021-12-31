<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    public $table = "details";

    protected $fillable = [
        'image',
        'address',
        'description',
        'user_id',
    ];

    public function user_detail()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
