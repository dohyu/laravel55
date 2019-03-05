@extends('layouts.app')

@section('content')
    @php
        $articleNum = $articles->total() - (($articles->currentPage() - 1) * $articles->perPage());
    @endphp
    <div class="container">
        <div class="page-header">
            <h3>게시판</h3>
        </div>

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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>제목</th>
                            <th>글쓴이</th>
                            <th>날짜</th>
                            <th>조회수</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                        <tr>
                            <td class="text-right">{{ $articleNum-- }}</td>
                            <td><a href="/articles/{{ $article->category->key_name }}/{{ $article->id }}">{{ $article->title }}</a></td>
                            <td>{{ $article->user->name }}</td>
                            <td>{{ $article->created_at }}</td>
                            <td class="text-right">{{ number_format($article->view_count) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">등록된 게시물이 없습니다.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($articles->count())
                <div class="text-center">
                    {{ $articles->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection