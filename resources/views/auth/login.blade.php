<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - TCC Fácil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-700 mb-2">TCC Fácil</h1>
            <p class="text-gray-500">Aceda para gerir os seus temas e entregas</p>
        </div>

        <form action="/dashboard" method="GET">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">E-mail Académico</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" id="email" type="email" placeholder="nome@instituicao.edu">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Palavra-passe</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" id="password" type="password" placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-indigo-600">
                    <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                </label>
                <a class="inline-block align-baseline font-bold text-sm text-indigo-600 hover:text-indigo-800" href="#">Recuperar senha?</a>
            </div>

            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200" type="submit">
                Entrar no Sistema
            </button>
        </form>
    </div>

</body>
</html>