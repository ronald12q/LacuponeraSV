<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(string: $cupon['titulo']); ?> - Cuponera SV</title>
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
    <style>
        .precio-tachado {
            text-decoration: line-through;
            opacity: 0.7;
        }
    </style>
</head>
<body class="bg-[#1D212D] min-h-screen text-white font-sans">
    
   
    <header class="bg-[#1D212D] border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                
                <div class="flex items-center space-x-2">
                    <img src="public/images/coupon-icon.png" alt="Logo" class="w-10 h-10">
                    <span class="text-[#7132d1] text-xl font-semibold">Cuponera SV</span>
                </div>

               
                <a href="?url=home" class="flex flex-col items-center text-yellow-500 hover:text-yellow-400 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                    <span class="text-xs mt-1">Inicio</span>
                </a>

               
                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="flex items-center space-x-4">
                        <a href="?url=dashboard/cliente" class="flex flex-col items-center text-gray-300 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-xs mt-1"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        </a>
                        <a href="?url=login/logout" class="text-gray-400 hover:text-red-400 text-sm">Salir</a>
                    </div>
                <?php else: ?>
                    <a href="?url=login/cliente" class="flex flex-col items-center text-gray-300 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-xs mt-1">Usuario</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>


    <main class="max-w-4xl mx-auto px-4 py-8">
       
        <a href="<?php echo isset($esCliente) && $esCliente ? '?url=cliente' : '?url=home/cupones'; ?>" class="inline-flex items-center text-gray-400 hover:text-white mb-6 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Volver a cupones
        </a>

    
        <?php if(isset($_SESSION['error'])): ?>
            <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-lg mb-6">
                <?php echo htmlspecialchars(string: $_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php 
            $colores = [
                'bg-gradient-to-br from-[#8b4c4c] to-[#6b3a3a]',
                'bg-gradient-to-br from-[#4a7c59] to-[#3a6247]',
                'bg-gradient-to-br from-[#7c5c4a] to-[#5c4438]',
                'bg-gradient-to-br from-[#5c4a7c] to-[#483860]',
                'bg-gradient-to-br from-[#4a6a7c] to-[#385260]',
                'bg-gradient-to-br from-[#3a6186] to-[#2c4a62]',
            ];
            $colorIndex = crc32(string: $cupon['Categoria'] ?? 'default') % count(value: $colores);
            $colorClase = $colores[$colorIndex];
        ?>

       
        <div class="bg-[#252b42] rounded-2xl overflow-hidden shadow-2xl border border-gray-700 max-w-3xl mx-auto">
           
            <div class="<?php echo $colorClase; ?> px-8 py-24 text-center">
                <h2 class="text-5xl font-bold"><?php echo htmlspecialchars(string: $cupon['Categoria'] ?? 'General'); ?></h2>
            </div>

       
            <div class="p-8">
                <div class="grid grid-cols-2 gap-8">
               
                    <div class="space-y-6">
                    
                        <h1 class="text-2xl font-bold text-[#a78bfa]">
                            <?php echo htmlspecialchars(string: $cupon['titulo']); ?>
                        </h1>

                  
                        <div>
                            <p class="text-gray-300 text-base"><?php echo htmlspecialchars(string: $cupon['nombre_empresa']); ?></p>
                        </div>

                      
                        <?php if(!empty($cupon['direccion'])): ?>
                        <div>
                            <p class="text-gray-400 text-sm"><?php echo htmlspecialchars(string: $cupon['direccion']); ?></p>
                        </div>
                        <?php endif; ?>

                    
                        <div>
                            <p class="text-3xl font-bold text-white">
                                $<?php echo number_format(num: $cupon['precio_oferta'], decimals: 2); ?>
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Cantidad</label>
                            <input type="number" id="cantidadCupon" value="1" min="1" max="<?php echo $cupon['cantidad_cupones']; ?>" 
                                   class="w-full bg-white text-gray-900 rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-[#6366f1]">
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-[#a78bfa]">Descripcion</h3>
                        <div class="text-gray-300 text-sm leading-relaxed">
                            <p><?php echo nl2br(string: htmlspecialchars(string: $cupon['descripcion'] ?? 'Sin descripción disponible')); ?></p>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <?php if(isset($_SESSION['user_id']) && $_SESSION['id_rol'] == 3): ?>
                        <a href="#" id="btnProcederPagar" onclick="procederAPagar(event, <?php echo $cupon['id_oferta']; ?>)" 
                           class="block w-full bg-[#6366f1] hover:bg-[#5558e3] text-white text-lg font-semibold py-4 rounded-xl text-center shadow-lg transform transition-all duration-300 hover:scale-[1.02]">
                            Proceder a pagar
                        </a>
                    <?php else: ?>
                
                        <div class="space-y-4">
                            <a href="?url=login/cliente" 
                               class="block w-full bg-[#6366f1] hover:bg-[#5558e3] text-white text-lg font-semibold py-4 rounded-xl text-center shadow-lg transform transition-all duration-300 hover:scale-[1.02]">
                                Proceder a pagar
                            </a>
                            <p class="text-sm text-gray-500 text-center">
                                ¿No tienes cuenta? 
                                <a href="?url=register/cliente" class="text-[#a78bfa] hover:underline">Regístrate aquí</a>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <script>
        function procederAPagar(event, idOferta) {
            event.preventDefault();
            const cantidad = document.getElementById('cantidadCupon').value;
            window.location.href = `?url=cliente/comprar&id=${idOferta}&cantidad=${cantidad}`;
        }
    </script>

</body>
</html>
