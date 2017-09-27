<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    //
    public function viewPage($name) {
        $page = Page::where('name', $name)->first();

        return view('single', [
            'page' => $page
        ]);
    }
}
