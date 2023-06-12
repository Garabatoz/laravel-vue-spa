<?php

namespace App\Models;
use App\Model\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'ref_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
