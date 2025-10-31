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
                        primary: '#7132d1ff',
                        dark: {
                            100: '#2d3561',
                            200: '#1a1f3a',
                            300: '#151829',
                        },
                        purple: {
                            700: '#4a1d96',
                            800: '#3d1778',
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
<body class="bg-gradient-to-br from-[#1a1f3a] to-[#2d3561] min-h-screen text-white font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#151829] shadow-2xl">
            <!-- Header del Sidebar -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <img src="public/images/coupon-icon.png" alt="Logo" class="w-10 h-10">
                    <h1 class="text-xl font-semibold text-[#7132d1ff]">Cuponera SV</h1>
                </div>
            </div>

            <!-- Menu de Navegación -->
            <nav class="py-6">
                <!-- Dashboard -->
                <a href="#" class="flex items-center space-x-4 px-6 py-4 bg-gradient-to-r from-[#3d1778] to-transparent border-l-4 border-[#7132d1ff] text-red-400 hover:bg-[#2d3561] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <!-- Espacio para icono Dashboard -->
                        <img src="public/images/dashboard-icon.png" alt="Dashboard" class="w-6 h-6">
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Solicitudes Empresas -->
                <a href="#" class="flex items-center space-x-4 px-6 py-4 text-gray-300 hover:bg-[#2d3561] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <!-- Espacio para icono Solicitudes -->
                        <img src="public/images/enterprise-icon.png" alt="Solicitudes" class="w-6 h-6">
                    </div>
                    <div>
                        <div class="font-medium">Solicitudes</div>
                        <div class="text-xs text-gray-400">Empresas</div>
                    </div>
                </a>

                <!-- Reporte Empresas -->
                <a href="#" class="flex items-center space-x-4 px-6 py-4 text-gray-300 hover:bg-[#2d3561] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <!-- Espacio para icono Reporte -->
                        <img src="public/images/revenue-icon.png" alt="Reporte" class="w-6 h-6">
                    </div>
                    <div>
                        <div class="font-medium">Reporte</div>
                        <div class="text-xs text-gray-400">Empresas</div>
                    </div>
                </a>

                <!-- Salir -->
                <a href="#" class="flex items-center space-x-4 px-6 py-4 text-gray-300 hover:bg-[#2d3561] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <!-- Espacio para icono Salir -->
                        <img src="public/images/exit-icon.png" alt="Salir" class="w-6 h-6">
                    </div>
                    <span class="font-medium">Salir</span>
                </a>
            </nav>
        </aside>

        <!-- Contenido Principal -->
        <main class="flex-1 p-8">
            <!-- Grid de Estadísticas -->
            <div class="grid grid-cols-2 gap-8 max-w-4xl mx-auto mt-12">
                <!-- Card: Empresas Registradas -->
                <div class="bg-gradient-to-br from-[#4a1d96] to-[#3d1778] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                    <h3 class="text-lg font-light mb-4 text-gray-200">Empresas Registradas</h3>
                    <p class="text-6xl font-bold">5</p>
                </div>

                <!-- Card: Ventas Totales -->
                <div class="bg-gradient-to-br from-[#4a1d96] to-[#3d1778] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                    <h3 class="text-lg font-light mb-4 text-gray-200">Ventas Totales</h3>
                    <p class="text-6xl font-bold">$20,000</p>
                </div>

                <!-- Card: Usuarios Registrado -->
                <div class="bg-gradient-to-br from-[#4a1d96] to-[#3d1778] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                    <h3 class="text-lg font-light mb-4 text-gray-200">Usuarios Registrado</h3>
                    <p class="text-6xl font-bold">25</p>
                </div>

                <!-- Card: Cupones Vendido -->
                <div class="bg-gradient-to-br from-[#4a1d96] to-[#3d1778] rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                    <h3 class="text-lg font-light mb-4 text-gray-200">Cupones Vendido</h3>
                    <p class="text-6xl font-bold">125</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
