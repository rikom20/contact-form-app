<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- モーダルポップアップ制御用の軽量ライブラリ Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#f2efe9] text-[#5b4a42] min-h-screen" x-data="{ openModal: false, selectedContact: null }">
    <header class="py-6 border-b border-[#e5ded6] bg-white flex justify-between items-center px-12">
        <h1 class="text-3xl font-serif tracking-wide text-[#7d6b5d] mx-auto pl-20">FashionablyLate</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="border border-[#d0c8be] bg-[#fdfbf9] text-[#a39385] hover:bg-[#f4efe9] px-6 py-2 rounded text-sm transition">logout</button>
        </form>
    </header>

    <main class="py-10 px-8 max-w-7xl mx-auto">
        <h2 class="text-2xl font-serif text-center mb-8 text-[#7d6b5d]">Admin</h2>

        <!-- 検索フォーム -->
        <form action="{{ route('admin.index') }}" method="GET" class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください" class="p-3 bg-white border border-gray-200 rounded w-64 focus:outline-none">

            <select name="gender" class="p-3 bg-white border border-gray-200 rounded focus:outline-none">
                <option value="">性別</option>
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_id" class="p-3 bg-white border border-gray-200 rounded focus:outline-none">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date" value="{{ request('date') }}" class="p-3 bg-white border border-gray-200 rounded focus:outline-none">

            <button type="submit" class="bg-[#8b7969] text-white px-8 py-3 rounded hover:bg-[#7a6858] transition">検索</button>
            <a href="{{ route('admin.reset') }}" class="bg-[#d0c8be] text-white px-8 py-3 rounded hover:bg-[#a89b8d] text-center transition">リセット</a>
        </form>

        <!-- アクションエリア（エクスポート & ページネーション） -->
        <div class="flex justify-between items-center mb-4">
            <form action="{{ route('admin.export') }}" method="GET">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <button type="submit" class="bg-[#e2dad2] text-[#7d6b5d] px-6 py-2 rounded hover:bg-[#d5cbc0] transition">エクスポート</button>
            </form>

            <div>
                {{ $contacts->links() }}
            </div>
        </div>

        <!-- 一覧テーブル -->
        <div class="bg-white rounded shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#8b7969] text-white">
                        <th class="p-4 font-normal">お名前</th>
                        <th class="p-4 font-normal">性別</th>
                        <th class="p-4 font-normal">メールアドレス</th>
                        <th class="p-4 font-normal">お問い合わせの種類</th>
                        <th class="p-4 font-normal"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($contacts as $contact)
                        <tr class="hover:bg-[#fbf9f7] transition">
                            <td class="p-4">{{ $contact->first_name }} {{ $contact->last_name }}</td>
                            <td class="p-4">
                                @if($contact->gender == 1) 男性
                                @elseif($contact->gender == 2) 女性
                                @else その他
                                @endif
                            </td>
                            <td class="p-4">{{ $contact->email }}</td>
                            <td class="p-4">{{ $contact->category ? $contact->category->content : '' }}</td>
                            <td class="p-4 text-right">
                                <button @click="openModal = true; selectedContact = {{ json_encode($contact) }}" class="border border-[#d0c8be] bg-[#fdfbf9] text-[#a39385] px-4 py-1 rounded text-sm hover:bg-[#f4efe9]">
                                    詳細
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <!-- 詳細表示モーダル -->
    <div x-show="openModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center p-4 z-50" style="display: none;">
        <div class="bg-white rounded-lg shadow-xl max-w-xl w-full p-8 relative" @click.away="openModal = false">
            <button @click="openModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 border border-gray-300 rounded-full w-8 h-8 flex items-center justify-center">×</button>

            <template x-if="selectedContact">
                <div>
                    <table class="w-full mb-8 text-left">
                        <tr class="border-b"><th class="py-3 w-1/3 text-gray-500 font-bold">お名前</th><td class="py-3" x-text="selectedContact.first_name + ' ' + selectedContact.last_name"></td></tr>
                        <tr class="border-b"><th class="py-3 text-gray-500 font-bold">性別</th><td class="py-3" x-text="selectedContact.gender == 1 ? '男性' : (selectedContact.gender == 2 ? '女性' : 'その他')"></td></tr>
                        <tr class="border-b"><th class="py-3 text-gray-500 font-bold">メールアドレス</th><td class="py-3" x-text="selectedContact.email"></td></tr>
                        <tr class="border-b"><th class="py-3 text-gray-500 font-bold">電話番号</th><td class="py-3" x-text="selectedContact.tel"></td></tr>
                        <tr class="border-b"><th class="py-3 text-gray-500 font-bold">住所</th><td class="py-3" x-text="selectedContact.address"></td></tr>
                        <tr class="border-b"><th class="py-3 text-gray-500 font-bold">建物名</th><td class="py-3" x-text="selectedContact.building ?? ''"></td></tr>
                        <tr class="border-b"><th class="py-3 text-gray-500 font-bold">お問い合わせの種類</th><td class="py-3" x-text="selectedContact.category ? selectedContact.category.content : ''"></td></tr>
                        <tr class="border-b"><th class="py-3 text-gray-500 font-bold">お問い合わせ内容</th><td class="py-3 whitespace-pre-wrap" x-text="selectedContact.detail"></td></tr>
                    </table>

                    <div class="text-center">
                        <form :action="'/delete/' + selectedContact.id" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-[#d9534f] hover:bg-[#c9302c] text-white font-bold py-2 px-8 rounded transition">
                                削除
                            </button>
                        </form>
                    </div>
                </div>
            </template>
        </div>
    </div>
</body>
</html>