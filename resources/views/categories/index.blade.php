@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3>Category</h3>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li>Category</li>
                    <li>제품</li>
                    <li>출시년도</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-right">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#md-create">등록</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>카테고리</th>
                            <th>키</th>
                            <th>값</th>
                            <th>편집</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><a href="{{ route('categories.index') }}?parent_id={{ $category->id }}">{{ $category->title }}</a></td>
                            <td>{{ $category->key_name }}</td>
                            <td>{{ $category->key_value }}</td>
                            <td>
                                <button class="btn btn-info btn-xs">수정</button>
                                <button class="btn btn-danger btn-xs">삭제</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">등록된 카테고리가 없습니다.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="md-create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('categories.store') }}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="parent_id" value="{{ Request::get('parent_id') }}" />

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">카테고리 등록</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="title">카테고리</label>
                            <input type="text" name="title" id="title" class="form-control" onFocus="this.select()" />
                        </div>
                        <div class="form-group">
                            <label for="key_name">키</label>
                            <input type="text" name="key_name" id="key_name" class="form-control" onFocus="this.select()" />
                        </div>
                        <div class="form-group">
                            <label for="key_value">값</label>
                            <textarea name="key_value" id="key_value" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btn-modal-save">확인</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection