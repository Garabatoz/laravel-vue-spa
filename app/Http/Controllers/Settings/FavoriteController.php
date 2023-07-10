<?php
namespace App\Http\Controllers\Settings;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorito($characterId)
    {
        $user = Auth::user();        
        $favorito = Favorite::where('ref_id', $characterId)
            ->where('user_id', $user->id)
            ->first();
            
        if ($favorito) {
            $favorito->delete();
            return response()->json(['success' => 'Favorito eliminado']);
        } else {
            Favorite::create([
                'ref_id' => $characterId,
                'user_id' => $user->id,
            ]);
            return response()->json(['success' => 'Favorito agregado']);
        }
    }
    public function getFavoritos()
        {
            $user = Auth::user();
            $favoriteIds = $user->favorites()->pluck('ref_id');
            /* $favoritos = Favorite::where('user_id', $user->id)->get(); */
            return response()->json(['favoritos' => $favoriteIds]);
        }
}
