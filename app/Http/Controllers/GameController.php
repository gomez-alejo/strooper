<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;

class GameController extends Controller
{
        public function store(Request $request)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'level' => 'required|in:Normal,Veterano,Dios',
            'mode' => 'required|in:Clásico,Competitivo',
            'words_shown' => 'required|integer|min:0',
            'correct_words' => 'required|integer|min:0',
            'incorrect_words' => 'required|integer|min:0',
            'accuracy' => 'required|numeric|between:0,100',
            'reaction_time' => 'required|integer|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        // Crear y guardar el juego
        $game = Game::create([
            'user_id' => Auth::id(),
            'level' => $validated['level'],
            'mode' => $validated['mode'],
            'words_shown' => $validated['words_shown'],
            'correct_words' => $validated['correct_words'],
            'incorrect_words' => $validated['incorrect_words'],
            'accuracy' => $validated['accuracy'],
            'reaction_time' => $validated['reaction_time'],
            'duration' => $validated['duration'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Resultados guardados correctamente',
            'game' => $game
        ]);
    }
    public function index()
{
    $games = Game::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

    return response()->json($games);
}

public function global()
{
    $games = Game::with('user')
                ->orderBy('correct_words', 'desc')
                ->limit(10)
                ->get();

    return response()->json($games);
}

    public function play()
    {
        return view('play');
    }

    public function demo()
    {
        return view('demo');
    }
}
