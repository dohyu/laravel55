@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3>Category</h3>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul>
                    @forelse ($categories as $category)
                    <li><a href="{{ route('categories.index') }}?parent_id={{ $category->id }}">{{ $category->name }}</a></li>
                    @empty
                    <li>등록된 카테고리가 없습니다.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection