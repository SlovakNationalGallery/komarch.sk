<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PagesController extends Controller
{
    public function show($slug)
    {
        $page = \App\Models\Page::where('slug', '=', $slug)->firstOrFail();
        return view('pages.show', compact('page'));
    }
}
