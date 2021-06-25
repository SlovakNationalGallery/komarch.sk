<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArchitectResource;
use App\Models\Architect;
use Illuminate\Http\Request;

class ArchitectController extends Controller
{
    public function index(Request $request)
    {
        $architects = Architect::query();

        // search
        if ($request->filled('q')) {
            $architects->where('last_name', 'like', "%{$request->query('q')}%");
        }

        $perPage = min($request->get('perPage', 10), 15);
        return ArchitectResource::collection($architects->paginate($perPage));
    }
}
