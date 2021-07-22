<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contest;
use App\Http\Resources\ContestResource;
use App\Http\Resources\MediaResource;

class ContestController extends Controller
{
    public function index(Request $request)
    {
        $contests = $this->loadContests($request);

        // search
        if ($request->filled('q')) {
            $contests->whereIn('id', Contest::search("*{$request->query('q')}*")->keys());;
        }

        // sort
        $contests->orderBy(
            $request->input('sortby', 'created_at'),
            $request->input('direction', 'desc')
        );

        $per_page = (int)min($request->get('per_page', 8), 100);
        return ContestResource::collection($contests->paginate($per_page));
    }

    public function filters(Request $request)
    {
        $contests = $this->loadContests($request)->get();
        $filters = collect();
        $filters['states'] = [
            trans('contests.ongoing') => $contests->where('state', 'ongoing')->count(),
            trans('contests.upcoming') => $contests->where('state', 'upcoming')->count(),
            trans('contests.finished') => $contests->where('state', 'finished')->count(),
        ];
        foreach (Contest::$filterable as $filter) {
            $filters[$filter] = $contests->pluck($filter)->flatten()->countBy('name');
        }
        return $filters;
    }

    private function loadContests(Request $request)
    {
        $contests = Contest::query();

        // apply filters
        if ($request->has('typologies')) {
            $contests->withAnyTags($request->input('typologies', []));
        }

        $state = implode($request->input('states', []));
        switch ($state) {
            case trans('contests.ongoing'):
                $contests->ongoing();
                break;
            case trans('contests.upcoming'):
                $contests->upcoming();
                break;
            case trans('contests.finished'):
                $contests->finished();
                break;
        }

        return $contests;
    }

}
