<!-- resources/views/logout.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ログアウト</h2>

    <p>ログアウトしてもよろしいですか？</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">ログアウト</button>
    </form>
</div>
@endsection




