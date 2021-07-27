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
        $architects = Architect::query()
            ->with('address')
            ->withCount(['works', 'awards', 'contests'])
            ->leftJoin('addresses', 'addresses.architect_id', '=', 'architects.id')

            ->filtered($request)

            ->orderBy(
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
