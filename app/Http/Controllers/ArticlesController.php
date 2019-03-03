<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index($category = 'notice')
    {
        // 게시판 리스트
        $articlesCategoryId = \App\Category::whereKeyName('articles')->pluck('id');
        $articleCategories = \App\Category::whereParentId($articlesCategoryId)->get();

        // 게시판 자료
        $categoryId = \App\Category::whereKeyName($category)->pluck('id');
        $articles = \App\Article::whereCategoryId($categoryId)->paginate(10);

        return view('articles.index', compact('articles', 'articleCategories'));
    }
}
