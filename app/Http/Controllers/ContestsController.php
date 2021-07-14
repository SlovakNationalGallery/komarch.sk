<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;

class ContestsController extends Controller
{
    public function index(Request $request)
    {
        return view('contests.index');
    }

    public function show($id, $slug, Request $request)
    {
        $contest = Contest::findOrFail($id);

        if ($slug != $contest->slug) {
            return redirect($contest->url);
        }

        return view('contests.show', compact('contest'));
    }
}
