@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection


@section('content')
    <div class="todo-message">
        @if (session('message'))
            <div class="todo-message__normal">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="todo-message__error">
                
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                
            </div>
        @endif
    </div>


 <div class="todo-outside">

            <form class="form-entry" action="/categories" method="post">
            @csrf
                <div class="form-entry__writing">
                    <input class="form-entry__writing-txt" type="text" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-entry__button">
                    <button class="form-entry__button-make" type="submit">作成</button>
                </div>
            </form>

            <div class="todo-inside">
                <table class="todo-field">

                    <tr class="todo-field__menu">
                        <th class="todo-field__menu-title">
                            <span class="todo-field__menu-title--a">category</span>
                        </th>
                    </tr>

    @foreach ($categories as $category)
      <tr class="todo-field__unit">
        <td class="todo-field__unit-1">
            <form class="form-update" action="/categories/update" method="post">
            @method('PATCH')
            @csrf
            <div class="form-update__input">

              <input class="form-update__input-txt" type="text" name="name" value="{{ $category->name }}">
              <input type="hidden" name="id" value="{{ $category->id }}">
            </div>
            <div class="form-update__item">
              <button class="form-update__item-button" type="submit">更新</button>
            </div>
          </form>
        </td>
        <td class="todo-field__unit-2">
            <form class="form-delete" action="/categories/delete" method="post">
                @method('DELETE')
                @csrf
            <div class="form-delete__item">
                <input type="hidden" name="id" value="{{ $category['id'] }}">
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

