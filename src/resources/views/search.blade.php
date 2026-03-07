<!-- resources/views/search.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>お問い合わせ内容検索</h2>

    <!-- 検索フォーム -->
    <form action="{{ route('contact.search') }}" method="GET">
        @csrf
        <div class="row">
            <!-- 姓・名・フルネームで検索 -->
            <div class="col-md-3">
                <input type="text" name="name" class="form-control" placeholder="姓・名・フルネーム" value="{{ request('name') }}">
            </div>

            <!-- メールアドレス -->
            <div class="col-md-3">
                <input type="email" name="email" class="form-control" placeholder="メールアドレス" value="{{ request('email') }}">
            </div>

            <!-- 性別 -->
            <div class="col-md-2">
                <select name="gender" class="form-control">
                    <option value="">性別</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    <option value="">全て</option>
                </select>
            </div>

            <!-- お問い合わせの種類 -->
            <div class="col-md-2">
                <select name="inquiry_type" class="form-control">
                    <option value="">お問い合わせの種類</option>
                    <option value="1" {{ request('inquiry_type') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                    <option value="2" {{ request('inquiry_type') == '2' ? 'selected' : '' }}>商品の交換について</option>
                    <option value="3" {{ request('inquiry_type') == '3' ? 'selected' : '' }}>商品トラブル</option>
                    <option value="4" {{ request('inquiry_type') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                    <option value="5" {{ request('inquiry_type') == '5' ? 'selected' : '' }}>その他</option>
                </select>
            </div>

            <!-- 日付 -->
            <div class="col-md-2">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>

            <!-- 検索ボタンとリセットボタン -->
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">検索</button>
                <a href="{{ route('contact.search') }}" class="btn btn-secondary">リセット</a>
            </div>
        </div>
    </form>

    <!-- 結果表示 -->
    <div class="mt-4">
        <h3>検索結果</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせ内容</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                        <td>
                            @if ($contact->gender == 1) 男性
                            @elseif ($contact->gender == 2) 女性
                            @elseif ($contact->gender == 3) その他
                            @endif
                        </td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ Str::limit($contact->message, 50) }}</td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#contactModal{{ $contact->id }}">詳細</button>
                        </td>
                    </tr>

                    <!-- モーダル表示 -->
                    <div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel{{ $contact->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contactModalLabel{{ $contact->id }}">お問い合わせ詳細</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>お名前:</strong> {{ $contact->last_name }} {{ $contact->first_name }}</p>
                                    <p><strong>性別:</strong> 
                                        @if ($contact->gender == 1) 男性
                                        @elseif ($contact->gender == 2) 女性
                                        @elseif ($contact->gender == 3) その他
                                        @endif
                                    </p>
                                    <p><strong>メールアドレス:</strong> {{ $contact->email }}</p>
                                    <p><strong>電話番号:</strong> {{ $contact->phone1 }}{{ $contact->phone2 }}{{ $contact->phone3 }}</p>
                                    <p><strong>住所:</strong> {{ $contact->address }}</p>
                                    <p><strong>建物名:</strong> {{ $contact->building }}</p>
                                    <p><strong>お問い合わせの種類:</strong> 
                                        @foreach($categories as $category)
                                            @if($category->id == $contact->inquiry_type)
                                                {{ $category->name }}
                                            @endif
                                        @endforeach
                                    </p>
                                    <p><strong>お問い合わせ内容:</strong> {{ $contact->message }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">該当するデータはありません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- ページネーション -->
        <div class="pagination justify-content-center">
            {{ $contacts->links() }}
        </div>
    </div>
</div>
@endsection