<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Architect;
use App\Models\Number;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArchitectFiltersController extends Controller
{
    public function index(Request $request)
    {
        return [
            'startsWith' => $this->getStartsWith($request),
            'authorizationsIn' => $this->getAuthorizationsIn($request),
        ];
    }

    private function getStartsWith(Request $request) {
        $architectsFirstLetters = Architect::query()
            ->filtered($request)
            ->selectRaw('LEFT(last_name, 1) AS first_letter')
            ->groupBy('first_letter')
            ->pluck('first_letter')
            ->flatMap(fn ($letter) => [
              (string) Str::of($letter)->ascii() => true
            ]);

        $startsWith = [];
        foreach (range('A', 'Z') as $letter) {
            $startsWith[$letter] = $architectsFirstLetters->has($letter);
        }

        return $startsWith;
    }

    private function getAuthorizationsIn(Request $request) {
        $counts = Number::query()
            ->whereHas('architect', function (Builder $query) use ($request) {
                $query->filtered($request);
            })
            ->selectRaw("SUBSTRING_INDEX(TRIM(architect_number), ' ', -1) as authorization_type")
            ->selectRaw('count(*) as count')
            ->groupBy('authorization_type')
            ->get()
            ->flatMap(fn ($row) => [$row->authorization_type => $row->count])
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
