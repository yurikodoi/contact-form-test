@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="register__content">
    <div class="register__header">
        <h2>Register</h2>
    </div>

    <div class="register-form">
        <form action="/register" method="post">
            @csrf
            
            {{-- お名前 --}}
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                </div>
                <div class="form__group-content">
                    <input type="text" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}">
                    @error('name')
                        <div class="form__error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- メールアドレス --}}
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                </div>
                <div class="form__group-content">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    @error('email')
                        <div class="form__error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- パスワード --}}
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">パスワード</span>
                </div>
                <div class="form__group-content">
                    <input type="password" name="password" placeholder="例: coachtech1106">
                    @error('password')
                        <div class="form__error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection