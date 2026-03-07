<!-- resources/views/export.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>お問い合わせデータエクスポート</h2>

    <p>表示中のデータをCSV形式でエクスポートできます。</p>

    <!-- エクスポートボタン -->
    <a href="{{ route('contact.export') }}" class="btn btn-success">CSVエクスポート</a>

    <!-- 検索フォーム -->
    <form action="{{ route('admin.contacts') }}" method="GET" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="名前で検索" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </div>
    </form>

    <!-- お問い合わせ内容一覧 -->
    <table class="table table-striped">
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
            @foreach($contacts as $contact)
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
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    <div class="pagination justify-content-center">
        {{ $contacts->links() }}
    </div>
</div>
@endsection