<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\DarkwebCredential;
use App\Models\PiiExposure;
use Illuminate\Http\Request;

class DarkWebController extends Controller
{
    /**
     * Get dark web credentials
     */
    public function credentials(Request $request)
    {
        $query = DarkwebCredential::query();

        if ($request->user()->company_id) {
            $query->where('company_id', $request->user()->company_id);
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $credentials = $query->orderBy('leaked_at', 'desc')->paginate(20);

        return response()->json($credentials);
    }

    /**
     * Get PII exposures
     */
    public function exposures(Request $request)
    {
        $query = PiiExposure::query();

        if ($request->user()->company_id) {
            $query->where('company_id', $request->user()->company_id);
        }

        if ($request->has('data_type')) {
            $query->where('data_type', $request->data_type);
        }

        $exposures = $query->orderBy('leaked_at', 'desc')->paginate(20);

        return response()->json($exposures);
    }
}
