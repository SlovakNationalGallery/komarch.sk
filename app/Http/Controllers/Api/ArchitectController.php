<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArchitectResource;
use App\Models\Architect;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ArchitectController extends Controller
{
    public function index(Request $request)
    {
        $architects = Architect::query();

        if ($request->filled('q')) {
            $architects->where('last_name', 'like', "%{$request->query('q')}%");
        }

        if ($request->filled('startsWith')) {
            $architects->where('last_name', 'like', "{$request->query('startsWith')}%");
        }

        if ($request->filled('authorizationsIn')) {
            $architects->whereHas('numbers', function (Builder $query) use ($request) {
                // Search by a regexp like: (AA|BB)$
                $regexp = '(' . join('|', $request->query('authorizationsIn')) . ')$';
                $query->where('architect_number', 'REGEXP', $regexp);
            });
        }

        $perPage = min($request->get('perPage', 10), 15);
        return ArchitectResource::collection($architects->paginate($perPage));
    }
}
