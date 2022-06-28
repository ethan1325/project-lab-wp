<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameDetailController extends Controller
{
    public function index($id){
        $game = Game::find($id);
        $relatedGames = Game::where('category_id', $game->category_id)->get();
        $slides = explode(",", $game->slides);
        $user = Auth::check();
        if ($user){
            $role_id = Auth::user()->role_id;
            $name = Auth::user()->name;
        }else{
            $role_id = '3';
            $name = 'Guest';
        }
        return view('gameDetail', [
            'role_id' => $role_id,
            'name' => $name,
            'user' => $user,
            'game' => $game,
            'slides' => $slides,
            'relatedGames' => $relatedGames
        ]);
    }
}
