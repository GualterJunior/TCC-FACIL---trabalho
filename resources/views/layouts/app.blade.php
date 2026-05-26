<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCC Fácil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex h-screen">

    <aside class="w-64 bg-blue-900 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-blue-800">
            TCC Fácil
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="/aluno/dashboard" class="block px-4 py-2 rounded hover:bg-blue-800">Início</a>
            <a href="/grupos" class="block px-4 py-2 rounded hover:bg-blue-800">Meu Grupo</a>
            <a href="/temas" class="block px-4 py-2 rounded hover:bg-blue-800">Meu Tema</a>
            <a href="/entregas" class="block px-4 py-2 rounded hover:bg-blue-800">Entregas</a>
        </nav>
        <div class="p-4 border-t border-blue-800 text-sm text-center">
            Logado como Aluno
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto p-8">
        @yield('content')
    </main>

</body>
</html>
