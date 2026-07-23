<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f2efe9] text-[#5b4a42] min-h-screen">
    <header class="py-6 border-b border-[#e5ded6] bg-white flex justify-between items-center px-12">
        <h1 class="text-3xl font-serif tracking-wide text-[#7d6b5d] mx-auto pl-20">FashionablyLate</h1>
        <a href="/register" class="border border-[#d0c8be] bg-[#fdfbf9] text-[#a39385] hover:bg-[#f4efe9] px-6 py-2 rounded text-sm transition">register</a>
    </header>

    <main class="py-12">
        <div class="max-w-md mx-auto bg-white p-10 rounded shadow-sm">
            <h2 class="text-2xl font-serif text-center mb-8 text-[#7d6b5d]">Login</h2>

            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <!-- メールアドレス -->
                <div class="mb-6">
                    <label class="block text-sm font-bold mb-2">メールアドレス</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com" class="w-full p-3 bg-[#f4f4f4] border border-gray-200 rounded focus:outline-none">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- パスワード -->
                <div class="mb-8">
                    <label class="block text-sm font-bold mb-2">パスワード</label>
                    <input type="password" name="password" placeholder="例: coachtech1106" class="w-full p-3 bg-[#f4f4f4] border border-gray-200 rounded focus:outline-none">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ログインボタン -->
                <div class="text-center">
                    <button type="submit" class="bg-[#8b7969] hover:bg-[#7a6858] text-white font-bold py-3 px-10 rounded transition duration-200">
                        ログイン
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>