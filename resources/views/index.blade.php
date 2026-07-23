@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-10 rounded shadow-sm">
    <h2 class="text-2xl font-serif text-center mb-8 text-[#7d6b5d]">Contact</h2>

    <form action="{{ route('contact.confirm') }}" method="POST" novalidate>
        @csrf

        <!-- お名前 -->
        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">お名前 <span class="text-red-500">※</span></label>
            <div class="flex gap-4">
                <div class="w-1/2">
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 山田" class="w-full p-3 bg-[#f4f4f4] border border-gray-200 rounded focus:outline-none">
                    @error('first_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-1/2">
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 太郎" class="w-full p-3 bg-[#f4f4f4] border border-gray-200 rounded focus:outline-none">
                    @error('last_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- 性別 -->
        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">性別 <span class="text-red-500">※</span></label>
            <div class="flex gap-6 items-center pt-2">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }} class="form-radio text-[#8b7969]">
                    <span class="ml-2">男性</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }} class="form-radio text-[#8b7969]">
                    <span class="ml-2">女性</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }} class="form-radio text-[#8b7969]">
                    <span class="ml-2">その他</span>
                </label>
            </div>
            @error('gender')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- メールアドレス -->
        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">メールアドレス <span class="text-red-500">※</span></label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com" class="w-full p-3 bg-[#f4f4f4] border border-gray-200 rounded focus:outline-none">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 電話番号 -->
        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">電話番号 <span class="text-red-500">※</span></label>
            <div class="flex items-center gap-2">
                <input type="text" name="tel1" value="{{ old('tel1') }}" placeholder="080" class="w-1/3 p-3 bg-[#f4f4f4] border border-gray-200 rounded text-center focus:outline-none">
                <span>-</span>
                <input type="text" name="tel2" value="{{ old('tel2') }}" placeholder="1234" class="w-1/3 p-3 bg-[#f4f4f4] border border-gray-200 rounded text-center focus:outline-none">
                <span>-</span>
                <input type="text" name="tel3" value="{{ old('tel3') }}" placeholder="5678" class="w-1/3 p-3 bg-[#f4f4f4] border border-gray-200 rounded text-center focus:outline-none">
            </div>
            @error('tel1') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            @error('tel2') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            @error('tel3') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- 住所 -->
        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">住所 <span class="text-red-500">※</span></label>
            <input type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" class="w-full p-3 bg-[#f4f4f4] border border-gray-200 rounded focus:outline-none">
            @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 建物名 -->
        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">建物名</label>
            <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101" class="w-full p-3 bg-[#f4f4f4] border border-gray-200 rounded focus:outline-none">
        </div>

        <!-- お問い合わせの種類 -->
        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">お問い合わせの種類 <span class="text-red-500">※</span></label>
            <select name="category_id" class="w-full p-3 bg-[#f4f4f4] border border-gray-200 rounded focus:outline-none">
                <option value="">選択してください</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- お問い合わせ内容 -->
        <div class="mb-8">
            <label class="block text-sm font-bold mb-2">お問い合わせ内容 <span class="text-red-500">※</span></label>
            <textarea name="detail" rows="4" placeholder="お問い合わせ内容をご記載ください" class="w-full p-3 bg-[#f4f4f4] border border-gray-200 rounded focus:outline-none">{{ old('detail') }}</textarea>
            @error('detail')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- 確認画面ボタン -->
        <div class="text-center">
            <button type="submit" class="bg-[#8b7969] hover:bg-[#7a6858] text-white font-bold py-3 px-12 rounded transition duration-200">
                確認画面
            </button>
        </div>
    </form>
</div>
@endsection