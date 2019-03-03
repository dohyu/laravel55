<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Category::whereParentId($request->get('parent_id'));
        $query = $query->orderBy('title', 'asc');
        $categories = $query->get();
        
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'key_name' => 'required'
        ]);

        $category = \App\Category::create($request->all());

        return redirect(route('categories.index', 'parent_id=' . $request->get('parent_id')));
    }
}
