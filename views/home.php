
<!-- tailwind usado desde la cdn no se como integrarlo directo 
 fuentes de google  -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuponera SV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
           
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
       
    </script>
</head>
<body class="bg-[#1D212D] min-h-screen flex justify-center items-center text-white font-sans">
    <div class="w-full max-w-5xl px-8 py-12">
        <header class="text-center mb-20">
            <h1 class="text-7xl text-[#7132d1ff]  text-strong mb-2 font-light tracking-wide">Cuponera SV</h1>
            <p class="text-sm text-gray-400 font-light">Seleccione su Rol para continuar</p>
        </header>

        <main class="max-w-3xl mx-auto">
         
            <div class="grid grid-cols-3 gap-x-20 mb-16">
                <a href="?url=login/empresas" class="flex flex-col items-center cursor-pointer transition-transform duration-300 hover:-translate-y-2">
                    <div class="w-32 h-32 bg-[#1E233A] rounded-xl flex justify-center items-center mb-4 shadow-xl transition-all duration-300 hover:shadow-[#6c8aff]/30 hover:bg-[#2a3150]">
                        <img src="public/images/empresas-icon.png" alt="Empresas" class="w-16 h-16 object-contain">
                    </div>
                    <h2 class="text-lg font-light text-white">Empresas</h2>
                </a>

                <a href="?url=login/admin" class="flex flex-col items-center cursor-pointer transition-transform duration-300 hover:-translate-y-2">
                    <div class="w-32 h-32 bg-[#1E233A] rounded-xl flex justify-center items-center mb-4 shadow-xl transition-all duration-300 hover:shadow-[#6c8aff]/30 hover:bg-[#2a3150]">
                        <img src="public/images/admin-icon.png" alt="Administradores" class="w-16 h-16 object-contain">
                    </div>
                    <h2 class="text-lg font-light text-white">Administradores</h2>
                </a>

                <a href="?url=login/cliente" class="flex flex-col items-center cursor-pointer transition-transform duration-300 hover:-translate-y-2">
                    <div class="w-32 h-32 bg-[#1E233A] rounded-xl flex justify-center items-center mb-4 shadow-xl transition-all duration-300 hover:shadow-[#6c8aff]/30 hover:bg-[#2a3150]">
                        <img src="public/images/clientes-icon.png" alt="Clientes" class="w-16 h-16 object-contain">
                    </div>
                    <h2 class="text-lg font-light text-white">Clientes</h2>
                </a>
            </div>

            
            <div class="flex justify-center">
                <a href="?url=anonimo" class="flex flex-col items-center cursor-pointer transition-transform duration-300 hover:-translate-y-2">
                    <div class="w-32 h-32 bg-[#1E233A] rounded-xl flex justify-center items-center mb-4 shadow-xl transition-all duration-300 hover:shadow-[#6c8aff]/30 hover:bg-[#2a3150]">
                        <img src="public/images/anonimo-icon.png" alt="Anónimo" class="w-16 h-16 object-contain">
                    </div>
                    <h2 class="text-lg font-light text-white">Anonimo</h2>
                </a>
            </div>
        </main>
    </div>
</body>
</html>