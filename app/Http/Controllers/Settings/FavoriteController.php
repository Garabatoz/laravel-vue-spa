<?php
namespace App\Http\Controllers\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function toggleFavorito($characterId)
    {
        if (Auth::check()) {
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
      /*
        $favorito = Favorite::where('character_id', $characterId)
            ->where('user_id', $user->id)
            ->first();
        if ($favorito) {
            $favorito->delete();
        } else {
            Favorite::create([
                'character_id' => $characterId,
                'user_id' => $user->id,
            ]);
        }
        return response()->json(['success' => true]);*/
        dd($characterId);
    }
}
