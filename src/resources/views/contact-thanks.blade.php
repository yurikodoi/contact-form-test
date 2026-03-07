<!-- resources/views/contact-thanks.blade.php -->
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact-form.css') }}">
<style>
    header { display: none !important; }
</style>
<div class="thanks__content">
    {{-- 背景の巨大文字（全大文字をご希望なら THANK YOU に） --}}
    <div class="thanks__back-text" translate="no">Thank you</div>

    <div class="thanks__inner">
        <p class="thanks__message">お問い合わせありがとうございました</p>
        <div class="thanks__button-area">
            <a href="/" class="thanks__button">HOME</a>
        </div>
    </div>
</div>
@endsection


