<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Cuponera SV</title>
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
<body class="bg-[#1D212D] min-h-screen flex justify-center items-center text-white font-sans py-12">
    <div class="w-full max-w-md px-8">
        <header class="text-center mb-8">
            <h1 class="text-5xl text-[#6c8aff] mb-6 font-light tracking-wide">Cuponera SV</h1>
            <h2 class="text-xl text-white font-light mb-2">Recuperar Contraseña</h2>
            <p class="text-sm text-gray-400 mt-2">Ingresa tu correo y nueva contraseña</p>
        </header>

        <main>
            <?php if(isset($_SESSION['error'])): ?>
                <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-lg mb-4">
                    <?php echo htmlspecialchars(string: $_SESSION['error']); unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['success'])): ?>
                <div class="bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded-lg mb-4">
                    <?php echo htmlspecialchars(string: $_SESSION['success']); unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <div class="bg-[#1E233A]/30 backdrop-blur-sm border border-[#3d4d6f] rounded-2xl p-8 shadow-2xl">
                <form action="?url=forgotPassword/reset" method="POST" class="space-y-6">
        
                    <div>
                        <label for="email" class="block text-sm font-light text-gray-300 mb-2">Correo Electrónico</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="tucorreo@gmail.com"
                            required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                        >
                    </div>

         
                    <div>
                        <label for="new_password" class="block text-sm font-light text-gray-300 mb-2">Nueva Contraseña</label>
                        <input 
                            type="password" 
                            id="new_password" 
                            name="new_password" 
                            placeholder="••••••••"
                            required
                            minlength="6"
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                        >
                        <p class="text-xs text-gray-400 mt-1">Mínimo 6 caracteres</p>
                    </div>

               
                    <button 
                        type="submit"
                        class="w-full bg-[#362DD2] hover:bg-[#4d6eef] text-white font-normal py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-[#6c8aff]/50 mt-6"
                    >
                        Recuperar Contraseña
                    </button>

                
                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-400">
                            ¿Recordaste tu contraseña? 
                            <a href="?url=login" class="text-[#8b9cff] hover:text-[#6c8aff] transition-colors font-normal">Iniciar sesión</a>
                        </p>
                    </div>
                </form>
            </div>

       
            <div class="text-center mt-6">
                <a href="?url=home" class="text-sm text-gray-400 hover:text-white transition-colors">
                    ← Volver al inicio
                </a>
            </div>
        </main>
    </div>
</body>
</html>
