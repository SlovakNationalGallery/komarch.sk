<?php

namespace App\Http\Controllers;

use App\Models\Architect;
use Illuminate\Http\Request;

class ArchitectsController extends Controller
{
    public function index(Request $request)
    {
        return view('architects.index');
    }

    public function show($id, $slug, Request $request)
    {
        $architect = Architect::findOrFail($id);

        if ($slug != $architect->slug) {
            return redirect($architect->url);
        }

        return $architect;
    }
}
