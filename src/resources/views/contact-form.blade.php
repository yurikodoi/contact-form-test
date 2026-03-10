@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact-form.css') }}">
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h1>Contact</h1>
    </div>
    <form class="form" action="{{ route('contact.confirm') }}" method="post" novalidate>
        @csrf


        <div class="form__group">
    <div class="form__group-title">
        <span class="form__label--item">お名前</span>
        <span class="form__label--required">※</span>
    </div>
    <div class="form__group-content">
        <div class="form__input--flex">
            {{-- 姓のユニット --}}
            <div class="input-unit">
                <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                <div class="form__error">
                    @error('last_name') <span style="color: red;">{{ $message }}</span> @enderror
                </div>
            </div>
            {{-- 名のユニット --}}
            <div class="input-unit">
                <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                <div class="form__error">
                    @error('first_name') <span style="color: red;">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <label><input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}> 男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
                </div>
                <div class="form__error">
                    @error('gender') {{ $message }} @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                <div class="form__error">
                    @error('email') {{ $message }} @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
            <div class="form__input--flex-phone">
                <input type="text" name="phone1" placeholder="080" value="{{ old('phone1') }}"> - 
                <input type="text" name="phone2" placeholder="1234" value="{{ old('phone2') }}"> - 
                <input type="text" name="phone3" placeholder="5678" value="{{ old('phone3') }}">
            </div>
    
            <div class="form__error">
            {{-- phone1, phone2, phone3 のいずれかにエラーがあれば、最初のエラーを表示 --}}
                @if ($errors->has('phone1'))
                <span>{{ $errors->first('phone1') }}</span>
                @elseif ($errors->has('phone2'))
                <span>{{ $errors->first('phone2') }}</span>
                @elseif ($errors->has('phone3'))
                <span>{{ $errors->first('phone3') }}</span>
                @endif
                </div>
        </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                </div>
                <div class="form__error">
                    @error('address') {{ $message }} @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--select">
                    <select name="inquiry_type">
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('inquiry_type') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('inquiry_type') {{ $message }} @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="message" placeholder="お問い合わせ内容をご記載ください">{{ old('message') }}</textarea>
                </div>
                <div class="form__error">
                    @error('message') {{ $message }} @enderror
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面へ</button>
        </div>
    </form>
</div>
@endsection