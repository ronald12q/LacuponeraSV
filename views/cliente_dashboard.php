<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuponera SV - Los mejores descuentos</title>
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

                
                <a href="?url=home" class="flex flex-col items-center text-gray-300 hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                    <span class="text-xs mt-1">Inicio</span>
                </a>

               
                <div class="flex items-center space-x-4">
                    <span class="flex flex-col items-center text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-xs mt-1"><?php echo htmlspecialchars(string: $_SESSION['username']); ?></span>
                    </span>
                    <a href="?url=login/logout" class="bg-red-500/20 hover:bg-red-500 text-red-400 hover:text-white px-3 py-1 rounded text-sm transition-colors">Salir</a>
                </div>
            </div>
        </div>
    </header>

    
    <section class="py-12 px-4 text-center border-b border-gray-800">
        <h1 class="text-2xl md:text-3xl font-light text-gray-200 mb-3">
            Los mejores descuentos en el salvador, que estas esperando ve por tu cupon
        </h1>
        <p class="text-sm text-gray-500">
            Descubre ofertas increibles en restaurantes, servicios, entretenimiento y más
        </p>
    </section>

   
    <main class="max-w-7xl mx-auto px-4 py-8">
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded-lg mb-6 max-w-2xl mx-auto">
                <?php echo htmlspecialchars(string: $_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-lg mb-6 max-w-2xl mx-auto">
                <?php echo htmlspecialchars(string: $_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <h2 class="text-2xl font-semibold text-center mb-8">Cupones Disponibles</h2>

      
        <div class="max-w-2xl mx-auto mb-10">
            <form action="?url=cliente/buscar" method="GET" class="relative">
                <input type="hidden" name="url" value="cliente/buscar">
                <div class="flex items-center bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="pl-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="q" 
                        placeholder="¿Que estas Buscando?"
                        value="<?php echo isset($busqueda) ? htmlspecialchars(string: $busqueda) : ''; ?>"
                        class="w-full px-4 py-4 text-gray-800 focus:outline-none"
                    >
                    <button type="submit" class="bg-[#7132d1] text-white px-6 py-4 hover:bg-[#5a28a8] transition-colors">
                        Buscar
                    </button>
                </div>
            </form>
        </div>

        
        <?php if(!empty($categorias)): ?>
        <div class="flex flex-wrap justify-center gap-3 mb-8">
            <a href="?url=cliente" class="px-4 py-2 rounded-full text-sm <?php echo !isset($categoriaActual) ? 'bg-[#7132d1] text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600'; ?> transition-colors">
                Todos
            </a>
            <?php foreach($categorias as $cat): ?>
                <a href="?url=cliente/categoria&cat=<?php echo urlencode(string: $cat); ?>" 
                   class="px-4 py-2 rounded-full text-sm <?php echo (isset($categoriaActual) && $categoriaActual === $cat) ? 'bg-[#7132d1] text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600'; ?> transition-colors">
                    <?php echo htmlspecialchars(string: $cat); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        
        <?php if(empty($cupones)): ?>
            <div class="text-center py-16">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-xl text-gray-400">No hay cupones disponibles en este momento</p>
                <p class="text-sm text-gray-500 mt-2">Vuelve pronto para encontrar ofertas increíbles</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($cupones as $cupon): ?>
                    <?php 
                        $colores = [
                            'bg-gradient-to-b from-[#3a6186] to-[#2c4a62]',
                            'bg-gradient-to-b from-[#8b4c4c] to-[#6b3a3a]',
                            'bg-gradient-to-b from-[#4a7c59] to-[#3a6247]',
                            'bg-gradient-to-b from-[#7c5c4a] to-[#5c4438]',
                            'bg-gradient-to-b from-[#5c4a7c] to-[#483860]',
                            'bg-gradient-to-b from-[#4a6a7c] to-[#385260]',
                        ];
                        $colorIndex = crc32(string: $cupon['Categoria'] ?? 'default') % count(value: $colores);
                        $colorClase = $colores[$colorIndex];
                        
                        $descuento = 0;
                        if($cupon['precio_regular'] > 0) {
                            $descuento = round(num: (($cupon['precio_regular'] - $cupon['precio_oferta']) / $cupon['precio_regular']) * 100);
                        }
                    ?>
                    <div class="bg-[#1E233A] rounded-2xl overflow-hidden shadow-xl transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        
                        <div class="<?php echo $colorClase; ?> px-6 py-8 text-center">
                            <span class="text-xl font-semibold"><?php echo htmlspecialchars($cupon['Categoria'] ?? 'General'); ?></span>
                        </div>
                        
                        
                        <div class="p-6">
                            <h3 class="text-[#7c7cff] text-lg font-medium mb-3">
                                <?php echo htmlspecialchars(string: $cupon['titulo']); ?>
                            </h3>
                            
                            <div class="flex justify-between items-center text-sm text-gray-400 mb-4">
                                <span><?php echo htmlspecialchars(string: $cupon['nombre_empresa']); ?></span>
                                <span>Dis:<?php echo $cupon['cantidad_cupones']; ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-400 precio-tachado text-lg">$<?php echo number_format($cupon['precio_regular'], 2); ?></span>
                                    <p class="text-white text-2xl font-bold">$<?php echo number_format($cupon['precio_oferta'], 2); ?></p>
                                </div>
                                
                                <a href="?url=cliente/verCupon&id=<?php echo $cupon['id_oferta']; ?>" 
                                   class="bg-[#7132d1] hover:bg-[#5a28a8] text-white px-6 py-2 rounded-lg transition-colors text-sm">
                                    Ver Cupon
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    


</body>
</html>
