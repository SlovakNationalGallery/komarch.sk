<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArchitectResource;
use App\Models\Architect;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ArchitectController extends Controller
{
    public function index(Request $request)
    {
        $architects = Architect::query()
            ->with('address')
            ->withCount(['works', 'awards'])
            ->leftJoin('addresses', 'addresses.architect_id', '=', 'architects.id');

        // Filtering
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

        if ($request->filled('locationDistrictsIn')) {
            $architects->whereHas('address', function (Builder $query) use ($request) {
                $query->whereIn('location_district', $request->query('locationDistrictsIn'));
            });
        }

        // Ordering
        $architects->orderBy(
            $this->getOrderBy($request),
            $request->query('direction', 'asc')
        );

        $perPage = min($request->get('perPage', 10), 15);
        return ArchitectResource::collection($architects->paginate($perPage));
    }

    private function getOrderBy(Request $request)
    {
        if ($request->query === 'location_city') return 'addresses.location_city';
        return $request->query('sortby', 'last_name');
    }
}
