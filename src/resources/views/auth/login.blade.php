@extends('layouts.app')

@section('content')
{{-- キャッシュ対策 --}}
<link rel="stylesheet" href="{{ asset('css/login.css') }}?{{ time() }}">

<div class="login__content">
    <div class="login__header">
        <h1>Login</h1>
    </div>

    <div class="login-form">
        <form action="/login" method="post" novalidate>
            @csrf
            
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                </div>
                <div class="form__group-content">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    @error('email')
                        <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">パスワード</span>
                </div>
                <div class="form__group-content">
                    <input type="password" name="password" placeholder="例: coachtech1106">
                    @error('password')
                        <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection