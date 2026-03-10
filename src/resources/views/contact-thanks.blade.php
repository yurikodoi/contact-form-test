<!-- resources/views/contact-thanks.blade.php -->
@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact-thanks.css') }}">
<style>
    header { display: none !important; }
</style>
<div class="thanks__content">
    <div class="thanks__back-text" translate="no">Thank you</div>

    <div class="thanks__inner">
        <p class="thanks__message">お問い合わせありがとうございました</p>
        <div class="thanks__button-area">
            <a href="/" class="thanks__button">HOME</a>
        </div>
    </div>
</div>
@endsection


