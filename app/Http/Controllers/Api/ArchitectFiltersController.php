<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Architect;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ArchitectFiltersController extends Controller
{
    public function index(Request $request)
    {
        $architects = Architect::query()
            ->with('numbers')
            ->filtered($request)
            ->get();

        return [
            'startsWith' => $this->getStartsWith($architects),
            'authorizationsIn' => $this->getAuthorizationsIn($architects),
        ];
    }

    private function getStartsWith(Collection $architects) {
        $architectsByFirstLetters = $architects
            ->groupBy(function ($architect, $key) {
                return (string) Str::of($architect->last_name)
                    ->substr(0, 1)
                    ->upper()
                    ->ascii();
            });

        $startsWith = [];
        foreach (range('A', 'Z') as $letter) {
            $startsWith[$letter] = $architectsByFirstLetters->has($letter);
        }

        return $startsWith;
    }

    private function getAuthorizationsIn(Collection $architects) {
        $counts = $architects
            ->pluck('authorizations')
            ->flatten()
            ->countBy()
            ->toArray();

        return array_merge(
            [
                'AA' => 0,
                'KA' => 0,
                'HA' => 0,
                'HKA' => 0,
                'DC' => 0,
            ],
            $counts,
        );
    }
}
