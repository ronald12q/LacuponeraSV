<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Cuponera SV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8b7fb8',
                        dark: {
                            100: '#1e2139',
                            200: '#151829',
                            300: '#0f111f',
                        },
                        purple: {
                            600: '#5630a3ff',
                            700: '#2f2447',
                            800: '#251a3a',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-[#151829] to-[#1e2139] min-h-screen text-white font-sans">
    <div class="flex min-h-screen">

        <aside class="w-64 bg-[#0f111f] shadow-2xl">
       
            <div class="p-6 border-b border-gray-800">
                <div class="flex items-center space-x-3">
                    <img src="public/images/coupon-icon.png" alt="Logo" class="w-10 h-10">
                    <h1 class="text-xl font-semibold text-[#8b7fb8]">Cuponera SV</h1>
                </div>
            </div>

          
            <nav class="py-6">
     
                <a href="#" class="flex items-center space-x-4 px-6 py-4 bg-gradient-to-r from-[#251a3a] to-transparent border-l-4 border-[#8b7fb8] text-red-400 hover:bg-[#1e2139] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
                   
                        <img src="public/images/dashboard-icon.png" alt="Dashboard" class="w-6 h-6">
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>


                <a href="#" class="flex items-center space-x-4 px-6 py-4 text-gray-300 hover:bg-[#1e2139] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
               
                        <img src="public/images/enterprise-icon.png" alt="Solicitudes" class="w-6 h-6">
                    </div>
                    <div>
                        <div class="font-medium">Solicitudes</div>
                        <div class="text-xs text-gray-400">Empresas</div>
                    </div>
                </a>

              
                <a href="#" class="flex items-center space-x-4 px-6 py-4 text-gray-300 hover:bg-[#1e2139] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
                      
                        <img src="public/images/revenue-icon.png" alt="Reporte" class="w-6 h-6">
                    </div>
                    <div>
                        <div class="font-medium">Reporte</div>
                        <div class="text-xs text-gray-400">Empresas</div>
                    </div>
                </a>

              
                <a href="#" class="flex items-center space-x-4 px-6 py-4 text-gray-300 hover:bg-[#1e2139] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
               
                        <img src="public/images/exit-icon.png" alt="Salir" class="w-6 h-6">
                    </div>
                    <span class="font-medium">Salir</span>
                </a>
            </nav>
        </aside>

  
        <main class="flex-1 p-8">
           
            <div class="grid grid-cols-2 gap-8 max-w-4xl mx-auto mt-12">
               
                <div class="bg-gradient-to-br from-[#5b4a9f] to-[#3d2f6b] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                    <h3 class="text-lg font-light mb-4 text-gray-100">Empresas Registradas</h3>
                    <p class="text-6xl font-bold">5</p>
                </div>

               
                <div class="bg-gradient-to-br from-[#5b4a9f] to-[#3d2f6b] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                    <h3 class="text-lg font-light mb-4 text-gray-100">Ventas Totales</h3>
                    <p class="text-6xl font-bold">$20,000</p>
                </div>

          
                <div class="bg-gradient-to-br from-[#5b4a9f] to-[#3d2f6b] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                    <h3 class="text-lg font-light mb-4 text-gray-100">Usuarios Registrado</h3>
                    <p class="text-6xl font-bold">25</p>
                </div>

             
                <div class="bg-gradient-to-br from-[#5b4a9f] to-[#3d2f6b] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                    <h3 class="text-lg font-light mb-4 text-gray-100">Cupones Vendido</h3>
                    <p class="text-6xl font-bold">125</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
