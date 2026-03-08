<!-- resources/views/logout.blade.php -->
@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
<div class="container">
    <h2>ログアウト</h2>

    <p>ログアウトしてもよろしいですか？</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">ログアウト</button>
    </form>
</div>
@endsection




