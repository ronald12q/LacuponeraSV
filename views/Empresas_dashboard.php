
<!-- este dashboard es casi igual que el dashboard de administradores mismos colores e iconos-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empresa - Cuponera SV</title>
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


<body class="bg-[#1D212D] min-h-screen text-white font-sans">
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
                    <div>
                        <div class="font-medium">Dashboard</div>
                        <div class="text-xs text-gray-400">Empresa</div>
                    </div>
                </a>

                <a href="?url=login/logout" class="flex items-center space-x-4 px-6 py-4 text-gray-300 hover:bg-[#1e2139] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
                        
                        <img src="public/images/exit-icon.png" alt="Salir" class="w-6 h-6">
                    </div>
                    <span class="font-medium">Salir</span>
                </a>
            </nav>
        </aside>

       
        <main class="flex-1 p-8">
            <div class="max-w-5xl mx-auto">
               
                <div class="grid grid-cols-2 gap-8 mb-8">
                    
                    <div class="bg-[#26165B] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                        <h3 class="text-lg font-light mb-4 text-gray-100">Cupones Ofertados</h3>
                        <p class="text-6xl font-bold"><?php echo $estadisticas['cupones_ofertados']; ?></p>
                    </div>

                  
                    <div class="bg-[#26165B] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                        <h3 class="text-lg font-light mb-4 text-gray-100">Cupones Vendidos</h3>
                        <p class="text-6xl font-bold"><?php echo $estadisticas['cupones_vendidos']; ?></p>
                    </div>

              
                    <div class="bg-[#26165B] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                        <h3 class="text-lg font-light mb-4 text-gray-100">Total Ventas</h3>
                        <p class="text-6xl font-bold">$<?php echo number_format($estadisticas['total_ventas'], 2); ?></p>
                    </div>

              
                    <div class="bg-[#26165B] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                        <h3 class="text-lg font-light mb-4 text-gray-100">Solicitudes Pendientes</h3>
                        <p class="text-6xl font-bold"><?php echo $estadisticas['solicitudes_pendientes']; ?></p>
                    </div>
                </div>

     
                <div class="flex justify-center mt-12">
                    <a href="?url=dashboard/ofertarCupon" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-2xl font-semibold py-6 px-32 rounded-2xl shadow-2xl transform transition-all duration-300 hover:scale-105 hover:shadow-green-500/50 inline-block text-center">
                        Ofertar Cupon
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
