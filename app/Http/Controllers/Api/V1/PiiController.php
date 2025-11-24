<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PiiExposure;
use Illuminate\Http\Request;

class PiiController extends Controller
{
    /**
     * Display a listing of PII exposures
     */
    public function index(Request $request)
    {
        $query = PiiExposure::query();

        if ($request->user()->company_id) {
            $query->where('company_id', $request->user()->company_id);
        }

        if ($request->has('data_type')) {
            $query->where('data_type', $request->data_type);
        }

        if ($request->has('source')) {
            $query->where('source', 'like', '%' . $request->source . '%');
        }

        $exposures = $query->orderBy('leaked_at', 'desc')->paginate(20);

        return response()->json($exposures);
    }

    /**
     * Display the specified PII exposure
     */
    public function show(string $id)
    {
        $exposure = PiiExposure::findOrFail($id);
        
        // Check if user has access to this company's data
        if ($exposure->company_id !== auth()->user()->company_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        return response()->json($exposure);
    }
}
