<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use Illuminate\Http\Request;
use App\Http\Requests\TrajetRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class TrajetController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            $query = Trajet::where('user_id', $user->id);

            if ($request->has('date_trajet')) {
                $query->where('date_trajet', $request->input('date_trajet'));
            }

            $trajets = $query->paginate(10);

            if ($trajets->isEmpty()) {
                return response()->json(['message' => 'Aucun trajet trouvé pour cet utilisateur'], 404);
            }

            return response()->json([
                'message'=>'trajet(s) du user récupéré(s)',
                'trajets'=>$trajets
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Non authentifié'], 401);
        }
    }

    public function store(TrajetRequest $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            $trajet = Trajet::create([
                'user_id' => $user->id,
                'lieu_depart' => $request->lieu_depart,
                'lieu_arrivee' => $request->lieu_arrivee,
                'date_trajet' => $request->date_trajet,
            ]);

            return response()->json([
                'message' => 'Trajet créé avec succès',
                'trajet'=>$trajet
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la création'], 400);
        }
    }

    public function update(TrajetRequest $request, $id)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            $trajet = Trajet::where('id', $id)->where('user_id', $user->id)->first();

            if (!$trajet) {
                return response()->json(['error' => 'Trajet non trouvé'], 404);
            }

            $trajet->update($request->only(['lieu_depart', 'lieu_arrivee', 'date_trajet']));

            return response()->json([
                'message'=>'trajet mis à jour',
                'trajet'=>$trajet
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la mise à jour'], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            $trajet = Trajet::where('id', $id)->where('user_id', $user->id)->first();

            if (!$trajet) {
                return response()->json(['error' => 'Trajet non trouvé'], 404);
            }

            $trajet->delete();

            return response()->json(['message' => 'Trajet supprimé'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression'], 400);
        }
    }
}
