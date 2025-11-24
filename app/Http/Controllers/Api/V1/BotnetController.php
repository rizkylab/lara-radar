<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Botnet;
use Illuminate\Http\Request;

class BotnetController extends Controller
{
    /**
     * Display a listing of botnets
     */
    public function index(Request $request)
    {
        $query = Botnet::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('botnet_name')) {
            $query->where('botnet_name', 'like', '%' . $request->botnet_name . '%');
        }

        if ($request->has('country')) {
            $query->where('country', $request->country);
        }

        $botnets = $query->orderBy('last_seen_at', 'desc')->paginate(20);

        return response()->json($botnets);
    }

    /**
     * Display the specified botnet
     */
    public function show(string $id)
    {
        $botnet = Botnet::findOrFail($id);
        
        return response()->json($botnet);
    }
}
