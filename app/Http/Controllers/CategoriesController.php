<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Category::whereParentId($request->get('parent_id'));
        $query = $query->orderBy('name', 'asc');
        $categories = $query->get();
        
        return view('categories.index', compact('categories'));
    }
}
