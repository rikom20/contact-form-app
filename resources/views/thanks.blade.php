<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - サンクス</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- 背景の大文字背景文字 -->
    <div class="absolute inset-0 flex items-center justify-center select-none pointer-events-none">
        <span class="text-[12vw] font-serif text-[#f2efe9] font-bold opacity-60 leading-none">Thank you</span>
    </div>

    <!-- 中央メッセージ -->
    <div class="relative z-10 text-center">
        <h2 class="text-xl font-bold text-[#7d6b5d] mb-8">お問い合わせありがとうございました</h2>
        <a href="{{ route('contact.index') }}" class="inline-block bg-[#8b7969] hover:bg-[#7a6858] text-white font-bold py-3 px-10 rounded transition duration-200">
            HOME
        </a>
    </div>
</body>
</html>