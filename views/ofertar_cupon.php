<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertar Cupón - Cuponera SV</title>
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
<body class="bg-[#1D212D] min-h-screen text-white font-sans flex items-center justify-center py-12">
    <div class="w-full max-w-2xl px-8">
        
        <div class="text-center mb-8">
            <h1 class="text-5xl text-[#6c8aff] mb-6 font-light tracking-wide">Cuponera SV</h1>
            <h2 class="text-xl text-white font-light">Registra y oferta un cupon</h2>
        </div>

        
        <div class="bg-[#1E233A]/30 backdrop-blur-sm border border-[#3d4d6f] rounded-2xl p-8 shadow-2xl">
            <form action="?url=dashboard/guardarCupon" method="POST">
                <div class="grid grid-cols-2 gap-6">
             
                    <div>
                        <label class="block text-sm font-light text-gray-300 mb-2">Título oferta</label>
                        <input type="text" name="titulo" required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            placeholder="5 entradas x 5 dólares">
                    </div>

               
                    <div>
                        <label class="block text-sm font-light text-gray-300 mb-2">Precio regular</label>
                        <input type="number" name="precio_regular" step="0.01" required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            placeholder="$25.00">
                    </div>

                    <div>
                        <label class="block text-sm font-light text-gray-300 mb-2">Descripcion</label>
                        <input type="text" name="descripcion" required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            placeholder="Apulo Turicentro...">
                    </div>

               
                    <div>
                        <label class="block text-sm font-light text-gray-300 mb-2">Categoria</label>
                        <input type="text" name="categoria" required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            placeholder="Turicentro">
                    </div>

          
                    <div>
                        <label class="block text-sm font-light text-gray-300 mb-2">Fecha de inicio</label>
                        <input type="date" name="fecha_inicio" required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200">
                    </div>

                    <div>
                        <label class="block text-sm font-light text-gray-300 mb-2">Fecha de finalizacion</label>
                        <input type="date" name="fecha_fin" required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200">
                    </div>

                   
                    <div>
                        <label class="block text-sm font-light text-gray-300 mb-2">Cantidad</label>
                        <input type="number" name="cantidad" required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            placeholder="100">
                    </div>

                    <div>
                        <label class="block text-sm font-light text-gray-300 mb-2">Fecha limite para canjear cupon</label>
                        <input type="date" name="fecha_limite_canje" required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200">
                    </div>

                 
                    <div>
                        <label class="block text-sm font-light text-gray-300 mb-2">Estado de la oferta</label>
                        <input type="text" name="estado_oferta" required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            placeholder="Disponible">
                    </div>

                    <div>
                        <label class="block text-sm font-light text-gray-300 mb-2">Precio oferta</label>
                        <input type="number" name="precio_oferta" step="0.01" required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            placeholder="$5.00">
                    </div>
                </div>


                <div class="mt-8">
                    <button type="submit"
                        class="w-full bg-[#362DD2] hover:bg-[#4d6eef] text-white font-normal py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-[#6c8aff]/50 mt-6">
                        Publicar
                    </button>
                </div>
            </form>
        </div>

     
        <div class="text-center mt-6">
            <a href="?url=dashboard/empresas" class="text-sm text-gray-400 hover:text-white transition-colors">
                ← Volver al dashboard
            </a>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="mt-4 bg-green-500 text-white px-6 py-3 rounded-lg">
                <?php 
                    echo $_SESSION['success']; 
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mt-4 bg-red-500 text-white px-6 py-3 rounded-lg">
                <?php 
                    echo $_SESSION['error']; 
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
