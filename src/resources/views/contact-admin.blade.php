@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}?{{ time() }}">

<div class="container">
    <h2 class="page-title">Admin</h2>

{{-- 検索フォームセクション --}}
    <form action="{{ route('contact.search') }}" method="GET" class="search-form">
        <div class="search-form__inner">
            
            {{-- キーワード入力：幅を適切に保ちつつ縮みすぎないように設定 --}}
            <div class="search-form__item search-form__item--keyword">
                <input type="text" name="keyword" class="form-input"
                    placeholder="名前やメールアドレスを入力してください"
                    value="{{ request('keyword') }}">
            </div>

            {{-- 性別選択：被りを防ぐために最小幅を固定 --}}
            <div class="search-form__item search-form__item--gender">
                <select name="gender" class="form-select">
                    <option value="">性別</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>
            </div>

            <div class="search-form__item search-form__item--type">
                <select name="inquiry_type" class="form-select">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('inquiry_type') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="search-form__item search-form__item--date">
                <input type="date" name="date" class="form-input"
                    value="{{ request('date') }}">
            </div>

            <div class="search-form__actions">
                <button type="submit" class="btn btn--search">検索</button>
                <a href="{{ route('contact.index') }}" class="btn btn--reset">リセット</a>
            </div>

        </div>
    </form>

    {{-- エクスポート & ページネーションエリア --}}
<div class="table-utility">
    {{-- 左側に配置 --}}
    <a href="{{ route('contact.export') }}" class="btn-export">エクスポート</a>

    {{-- 右側に配置 --}}
    <div class="table-pagination">
        {{ $contacts->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
</div>

    {{-- お問い合わせ一覧テーブル --}}
{{-- お問い合わせ一覧テーブル --}}
<table class="admin-table">
    <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th>詳細</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
            <tr class="admin-table__row">
                {{-- フルネームを表示 --}}
                <td>{{ $contact->last_name }}&nbsp;{{ $contact->first_name }}</td>
                
                {{-- 性別判定（規約に基づきシンプルに記述） --}}
                <td>
                    @php
                        $genderLabels = [1 => '男性', 2 => '女性', 3 => 'その他'];
                    @endphp
                    {{ $genderLabels[$contact->gender] ?? '不明' }}
                </td>

                <td>{{ $contact->email }}</td>
                
                {{-- 【修正箇所】お問い合わせの種類を表示 --}}
                <td>
                    {{ $contact->category->name ?? '不明' }}
                </td>
                
                <td>
                    <button type="button" class="btn-detail"
                        data-toggle="modal"
                        data-target="#contactModal{{ $contact->id }}">
                        詳細
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>

@foreach($contacts as $contact)
    {{-- モーダル本体 --}}
    <div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog admin-modal" role="document">
            <div class="modal-content">
                

                {{-- 閉じるボタン --}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {{-- 詳細リスト --}}
                    <div class="detail-container">
                        <div class="detail-row">
                            <span class="detail-label">お名前</span>
                            <span class="detail-data">{{ $contact->last_name }}&nbsp;{{ $contact->first_name }}</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">性別</span>
                            <span class="detail-data">{{ $genderLabels[$contact->gender] ?? '不明' }}</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">メールアドレス</span>
                            <span class="detail-data">{{ $contact->email }}</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">電話番号</span>
                            <span class="detail-data">{{ $contact->phone1 }}{{ $contact->phone2 }}{{ $contact->phone3 }}</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">住所</span>
                            <span class="detail-data">{{ $contact->address }}</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">建物名</span>
                            <span class="detail-data">{{ $contact->building ?? '' }}</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">お問い合わせの種類</span>
                            <span class="detail-data">{{ $contact->category->name ?? '不明' }}</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">お問い合わせ内容</span>
                            <span class="detail-data detail-data--textarea">{{ $contact->detail }}</span>
                        </div>
                    </div>

                    {{-- 削除アクション --}}
                    <form action="{{ route('contact.delete', $contact->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">削除</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach

@endsection