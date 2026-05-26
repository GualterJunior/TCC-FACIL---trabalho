<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TCC Fácil - Sistema de Sorteio</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">

    <nav class="bg-indigo-700 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-white text-xl font-bold tracking-wider">🎓 TCC Fácil</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/dashboard" class="text-indigo-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    <a href="/temas" class="text-indigo-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Temas</a>
                    <a href="/entregas" class="text-indigo-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Entregas</a>
                    <a href="/" class="bg-indigo-800 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-900">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <footer class="text-center py-6 text-gray-500 text-sm">
        &copy; {{ date('Y') }} TCC Fácil. Todos os direitos reservados.
    </footer>

</body>
</html>