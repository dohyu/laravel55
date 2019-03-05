@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header"><h3>게시판</h3></div>

        <div class="row">
            <div class="col-md-3">
            <p class="lead">게시판</p>
                <ul>
                    @foreach ($articleCategories as $category)
                    <li>
                        <a href="/articles/{{ $category->key_name }}">{{ $category->title }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-9">
                <div class="lead">{{ $article->title }}</div>
                <p>{{ $article->content }}</p>
                <div>by {{ $article->user->name }}, {{ $article->created_at }}, {{ number_format($article->view_count) }}</div>
            </div>
        </div>
    </div>

@endsection