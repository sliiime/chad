<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['posted_to', 'content'];
    protected $dates = ['created_at', 'updated_at'];

    public function user(){
        $this->belongsTo(User::class, 'created_by');
    }

    public function reactions(){
        return $this->morphToMany(Reaction::class, 'reactionable');
    }

}
