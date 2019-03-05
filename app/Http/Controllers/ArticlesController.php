<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index($category = 'notice')
    {
        // 게시판 리스트
        $articleCategories = $this->categories();

        // 게시판 자료
        $articles = \App\Category::
            whereKeyName($category)->firstOrFail()
            ->articles()->paginate(10);

        return view('articles.index', compact('articles', 'articleCategories'));
    }

    public function show($category, $id)
    {
        $articleCategories = $this->categories();
        $article = \App\Article::findOrFail($id);

        return view('articles.show', compact('article', 'articleCategories'));
    }

    private function categories()
    {
        return \App\Category::whereKeyName('articles')->firstOrFail()->children()->get();
    }
}
