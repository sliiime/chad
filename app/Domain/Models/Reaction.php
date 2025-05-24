<?php

namespace App\Domain\Models;

use App\Domain\Enums\ReactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    public function casts(): array{
        return [
            'reaction_type' => ReactionTypeEnum::class,
        ];
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reactionable(){
        return $this->morphTo();
    }

    public function reaction_type(){
        return $this->belongsTo(ReactionType::class);
    }
}
