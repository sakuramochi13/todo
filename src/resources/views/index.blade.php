@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection


@section('content')
        <div class="todo-message">
          @if (session('message'))
            <div class="todo-message__normal">
                {{ session('message') }}
            </div>
          @endif
          @error('content')
            <div class="todo-message__error">
                {{ $message }}
            </div>
          @enderror

        </div>

        <div class="todo-outside">
            <div class="form-title">
                <h2>新規作成</h2>
            </div>
            <form class="form-entry" action="/todos" method="post">
            @csrf
                <div class="form-entry__writing">
                    <input class="form-entry__writing-txt" type="text" name="content" value="{{ old('content') }}">
                </div>

                <div class="form-entry__select">
                    <select class="form-entry__select-category" name="category_id">
                        @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-entry__button">
                    <button class="form-entry__button-make" type="submit">作成</button>
                </div>
            </form>
            <div class="form-title">
                <h2>Todo検索</h2>
            </div>

            <form class="form-search" action="/todos/search" method="get">
            @csrf
                <div class="form-search__writing">
                    <input class="form-search__writing-txt" type="text" name="keyword" value="{{ old('keyword') }}">
                </div>
                <div class="form-search__select">
                    <select class="form-search__select-category"  name="category_id">
                        <option value="カテゴリー">カテゴリー</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-search__button">
                    <button class="form-search__button-search" type="submit">検索</button>
                </div>
            </form>

            <div class="todo-inside">
                <table class="todo-field">

                    <tr class="todo-field__menu">
                        <th class="todo-field__menu-title">
                            <span class="todo-field__menu-title--a">Todo</span>
                            <span class="todo-field__menu-title--a">カテゴリ</span>
                        </th>
                    </tr>

                    @foreach ($todos as $todo)
                    <tr class="todo-field__unit">
                        <td class="todo-field__unit-1">

                            <form class="form-update" action="/todos/update" method="POST">
                                @method('PATCH')
                                @csrf

                                <div class="form-update__input1">

                                    <input class="form-update__input-txt" type="text" name="content" value="{{ $todo['content'] }}">
                                    <input type="hidden" name="id" value="{{ $todo['id'] }}">

                                </div>
                                <div class="form-update__input2">

                                    <p class="form-update__input-category">{{ $todo['category']['name'] }}</p>

                                </div>
                                <div class="form-update__item">
                                    <button class="form-update__item-button" type="submit">更新</button>
                                </div>
                            </form>
                        </td>
                        <td class="todo-field__unit-2">

                            <form class="form-delete" action="/todos/delete" method="POST">
                                @method('DELETE')
                                @csrf

                                <div class="form-delete__item">
                                    <input type="hidden" name="id" value="{{ $todo['id'] }}">
                                    <button class="form-delete__item-button" type="submit">削除</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
@endsection