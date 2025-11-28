<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes Empresas - Cuponera SV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
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
          
                <a href="?url=dashboard/admin" class="flex items-center space-x-4 px-6 py-4 text-gray-300 hover:bg-[#1e2139] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <img src="public/images/dashboard-icon.png" alt="Dashboard" class="w-6 h-6">
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="?url=dashboard/solicitudesEmpresas" class="flex items-center space-x-4 px-6 py-4 bg-gradient-to-r from-[#251a3a] to-transparent border-l-4 border-[#8b7fb8] text-red-400 hover:bg-[#1e2139] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <img src="public/images/enterprise-icon.png" alt="Solicitudes" class="w-6 h-6">
                    </div>
                    <div>
                        <div class="font-medium">Solicitudes</div>
                        <div class="text-xs text-gray-400">Empresas</div>
                    </div>

                <a href="?url=dashboard/reporteEmpresas" class="flex items-center space-x-4 px-6 py-4 text-gray-300 hover:bg-[#1e2139] transition-all duration-200">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <img src="public/images/revenue-icon.png" alt="Reporte" class="w-6 h-6">
                    </div>
                    <div>
                        <div class="font-medium">Reporte</div>
                        <div class="text-xs text-gray-400">Empresas</div>
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
            <div class="max-w-6xl mx-auto">
           
                <div class="mb-8 text-center">
                    <p class="text-gray-400 text-sm">Component 16</p>
                </div>


                <div class="grid grid-cols-3 gap-8 mb-6 px-8">
                    <h2 class="text-xl font-semibold text-gray-300">Empresa</h2>
                    <h2 class="text-xl font-semibold text-gray-300 text-center">Fecha de solicitud</h2>
                    <h2 class="text-xl font-semibold text-gray-300 text-center">Acciones</h2>
                </div>


                <div class="space-y-4">
                    <?php if (empty($solicitudes)): ?>
                        <div class="bg-[#26165B] rounded-2xl shadow-xl p-8 text-center">
                            <p class="text-xl text-gray-300">No hay solicitudes pendientes</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($solicitudes as $index => $solicitud): ?>
                            <div class="bg-[#26165B] rounded-2xl shadow-xl p-6 <?php echo ($index === count($solicitudes) - 1) ? 'border-2 border-[#8b7fb8]' : ''; ?>">
                                <div class="grid grid-cols-3 gap-8 items-center">
                                    <div>
                                        <h3 class="text-2xl font-semibold"><?php echo htmlspecialchars($solicitud['nombre_empresa']); ?></h3>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-lg"><?php echo date('d \d\e F \d\e Y', strtotime($solicitud['fecha_registro'])); ?></p>
                                    </div>
                                    <div class="flex gap-4 justify-center">
                                        <form method="POST" action="?url=dashboard/aprobarEmpresa" style="display: inline;">
                                            <input type="hidden" name="id_empresa" value="<?php echo $solicitud['id_empresa']; ?>">
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-3 rounded-lg transition-all duration-200 transform hover:scale-105">
                                                Aprobar
                                            </button>
                                        </form>
                                        <form method="POST" action="?url=dashboard/rechazarEmpresa" style="display: inline;">
                                            <input type="hidden" name="id_empresa" value="<?php echo $solicitud['id_empresa']; ?>">
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-8 py-3 rounded-lg transition-all duration-200 transform hover:scale-105" onclick="return confirm('¿Estás seguro de rechazar esta solicitud?');">
                                                Rechazar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
