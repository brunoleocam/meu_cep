<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar CEP</title>
    <link rel="stylesheet" href="../public/assets/css/output.css"> <!-- Tailwind CSS -->
    <script src="../public/assets/js/script.js" defer></script>
    <script src="../public/assets/js/cep.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="flex flex-col min-h-screen font-sans">

    <header class="text-center p-5 bg-blue-500 drop-shadow-xl">
        <h1 class="text-4xl font-bold text-white">Busca CEP</h1>
    </header>

    <!-- Container principal com o formulário fixado no topo -->
    <main class="flex-1 pt-10 flex flex-col items-center">
        <form class="flex flex-col items-center" action="index.php?url=busca" id="cepForm" method="POST">
            <!-- <input type="text" name="query" id="cep" class="border p-2 w-96 text-center rounded-full" placeholder="Digite o CEP" required maxlength="9">
            <button type="submit" class="bg-blue-500 text-white p-2 mt-4 w-96 shadow-md rounded-full hover:shadow-lg hover:shadow-blue-500/50">Buscar</button> -->
            <div class="w-full max-w-xl min-w-md">
                <div class="relative">
                    <input type="text" name="query" id="cep" required maxlength="9"
                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-md text-center border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                    placeholder="Digite o CEP" 
                    />
                    <button
                    class="absolute top-1 right-1 flex items-center rounded bg-blue-500 py-1 px-2.5 border border-transparent text-center text-md text-white transition-all shadow-sm hover:shadow focus:bg-blue-600 focus:shadow-none active:bg-blue-600 hover:bg-blue-600 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="submit"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2">
                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                    </svg>
                
                    Buscar
                    </button> 
                </div>
            </div>
        </form>


        <!-- Spinner: Oculto inicialmente -->
        <div id="spinner" class="mt-5 hidden">
            <i class="fas fa-spinner fa-spin text-3xl text-blue-500"></i>
        </div>

        <!-- Container para exibir o resultado, logo abaixo do formulário -->
        <div id="resultado" class="mt-5 w-full max-w-lg hidden">
            <ul id="infoList" class="list-none p-0"></ul>
        </div>
    </main>

    <!-- Footer fixo na parte de baixo -->
    <footer class="bg-gray-200 text-center p-4 w-full drop-shadow-xl">
        <p>&copy; <?php echo date("Y"); ?> Demóbile</p>
    </footer>
</body>
</html>
