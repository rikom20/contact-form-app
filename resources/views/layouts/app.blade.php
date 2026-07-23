<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f2efe9] text-[#5b4a42] font-sans">
    <header class="py-6 border-b border-[#e5ded6] bg-white text-center">
        <h1 class="text-3xl font-serif tracking-wide text-[#7d6b5d]">FashionablyLate</h1>
    </header>

    <main class="py-12">
        @yield('content')
    </main>
</body>
</html>