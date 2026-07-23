@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-10 rounded shadow-sm">
    <h2 class="text-2xl font-serif text-center mb-8 text-[#7d6b5d]">Confirm</h2>

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <table class="w-full border-collapse mb-8">
            <tr class="border-b">
                <th class="py-4 text-left w-1/3 text-gray-600 bg-[#fbf9f7] px-4">お名前</th>
                <td class="py-4 px-4">{{ $contact['first_name'] }} {{ $contact['last_name'] }}</td>
            </tr>
            <tr class="border-b">
                <th class="py-4 text-left text-gray-600 bg-[#fbf9f7] px-4">性別</th>
                <td class="py-4 px-4">
                    @if($contact['gender'] == 1) 男性
                    @elseif($contact['gender'] == 2) 女性
                    @else その他
                    @endif
                </td>
            </tr>
            <tr class="border-b">
                <th class="py-4 text-left text-gray-600 bg-[#fbf9f7] px-4">メールアドレス</th>
                <td class="py-4 px-4">{{ $contact['email'] }}</td>
            </tr>
            <tr class="border-b">
                <th class="py-4 text-left text-gray-600 bg-[#fbf9f7] px-4">電話番号</th>
                <td class="py-4 px-4">{{ $contact['tel'] }}</td>
            </tr>
            <tr class="border-b">
                <th class="py-4 text-left text-gray-600 bg-[#fbf9f7] px-4">住所</th>
                <td class="py-4 px-4">{{ $contact['address'] }}</td>
            </tr>
            <tr class="border-b">
                <th class="py-4 text-left text-gray-600 bg-[#fbf9f7] px-4">建物名</th>
                <td class="py-4 px-4">{{ $contact['building'] ?? '' }}</td>
            </tr>
            <tr class="border-b">
                <th class="py-4 text-left text-gray-600 bg-[#fbf9f7] px-4">お問い合わせの種類</th>
                <td class="py-4 px-4">{{ $category->content }}</td>
            </tr>
            <tr class="border-b">
                <th class="py-4 text-left text-gray-600 bg-[#fbf9f7] px-4">お問い合わせ内容</th>
                <td class="py-4 px-4 whitespace-pre-wrap">{{ $contact['detail'] }}</td>
            </tr>
        </table>

        <!-- hidden領域（DB送信用の値を保持） -->
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
        <input type="hidden" name="email" value="{{ $contact['email'] }}">
        <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
        <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
        <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
        <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
        <input type="hidden" name="address" value="{{ $contact['address'] }}">
        <input type="hidden" name="building" value="{{ $contact['building'] }}">
        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
        <input type="hidden" name="detail" value="{{ $contact['detail'] }}">

        <!-- ボタン領域 -->
        <div class="flex justify-center items-center gap-6">
            <button type="submit" class="bg-[#8b7969] hover:bg-[#7a6858] text-white font-bold py-3 px-12 rounded transition duration-200">
                送信
            </button>
            <button type="submit" name="back" value="1" class="text-[#8b7969] underline hover:text-[#7a6858]">
                修正
            </button>
        </div>
    </form>
</div>
@endsection