@extends('layouts.app')

@section('content')
{{-- 強制リフレッシュ付きのCSS読み込み --}}
<link rel="stylesheet" href="{{ asset('css/contact-form.css') }}?v={{ time() }}">

<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>

    <form class="form" action="{{ route('contact.submit') }}" method="post">
        @csrf
        <table class="confirm-table">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__text">
                    {{ $validatedData['last_name'] }}&nbsp;&nbsp;{{ $validatedData['first_name'] }}
                    <input type="hidden" name="last_name" value="{{ $validatedData['last_name'] }}">
                    <input type="hidden" name="first_name" value="{{ $validatedData['first_name'] }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">性別</th>
                <td class="confirm-table__text">
                    @php
                        $genderText = [1 => '男性', 2 => '女性', 3 => 'その他'][$validatedData['gender']] ?? '未選択';
                    @endphp
                    {{ $genderText }}
                    <input type="hidden" name="gender" value="{{ $validatedData['gender'] }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__text">
                    {{ $validatedData['email'] }}
                    <input type="hidden" name="email" value="{{ $validatedData['email'] }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__text">
                    {{ $validatedData['phone1'] }}{{ $validatedData['phone2'] }}{{ $validatedData['phone3'] }}
                    <input type="hidden" name="phone1" value="{{ $validatedData['phone1'] }}">
                    <input type="hidden" name="phone2" value="{{ $validatedData['phone2'] }}">
                    <input type="hidden" name="phone3" value="{{ $validatedData['phone3'] }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">住所</th>
                <td class="confirm-table__text">
                    {{ $validatedData['address'] }}
                    <input type="hidden" name="address" value="{{ $validatedData['address'] }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__text">
                    {{ $validatedData['building'] ?? '' }}
                    <input type="hidden" name="building" value="{{ $validatedData['building'] ?? '' }}">
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせの種類</th>
                <td class="confirm-table__text">
                    {{-- 修正：$categoriesを使って名前を表示 --}}
                    @foreach($categories as $category)
                        @if($category->id == $validatedData['inquiry_type'])
                            {{ $category->name }}
                            <input type="hidden" name="inquiry_type" value="{{ $category->id }}">
                        @endif
                    @endforeach
                </td>
            </tr>

            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせ内容</th>
                <td class="confirm-table__text">
                    {{ $validatedData['message'] }}
                    <input type="hidden" name="message" value="{{ $validatedData['message'] }}">
                </td>
            </tr>
        </table>

        <div class="form__button">
            {{-- 送信ボタン：見本通りのクラス名 --}}
            <button class="form__button-submit" type="submit">送信</button>
            {{-- 修正ボタン：aタグではなくhistory.backで入力内容を保持 --}}
            <a class="form__button-back" href="#" onclick="history.back(); return false;">修正</a>
        </div>
    </form>
</div>
@endsection


