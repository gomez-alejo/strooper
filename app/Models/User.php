<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    
    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar',
        'games_played',
        'average_accuracy',
        'best_time',
        'high_score',
        'favorite_level'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Resto de tus métodos personalizados...
    public function getLevelTitleAttribute()
    {
        $levels = [
            'Normal' => 'Principiante',
            'Veterano' => 'Jugador Experto',
            'Dios' => 'Maestro del Stroop'
        ];

        return $levels[$this->favorite_level] ?? 'Jugador Nuevo';
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function recentGames($limit = 3)
    {
        return $this->games()
                   ->latest()
                   ->limit($limit)
                   ->get()
                   ->map(function($game) {
                       $game->level_color = $this->getLevelColor($game->level);
                       return $game;
                   });
    }

    protected function getLevelColor($level)
    {
        $colors = [
            'Normal' => 'bg-green-500',
            'Veterano' => 'bg-blue-500',
            'Dios' => 'bg-purple-500'
        ];

        return $colors[$level] ?? 'bg-gray-500';
    }
}