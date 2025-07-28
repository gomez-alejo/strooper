<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'level',
        'mode',
        'words_shown',
        'correct_words',
        'incorrect_words',
        'accuracy',
        'reaction_time',
        'duration',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
