<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cuponera SV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6c8aff',
                        dark: {
                            100: '#2d3561',
                            200: '#1a1f3a',
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
<body class="bg-gradient-to-br from-[#1a1f3a] to-[#2d3561] min-h-screen flex justify-center items-center text-white font-sans py-12">
    <div class="w-full max-w-md px-8">
        <header class="text-center mb-8">
            <h1 class="text-5xl text-[#6c8aff] mb-6 font-light tracking-wide">Cuponera SV</h1>
            <h2 class="text-xl text-white font-light mb-2">Iniciar sesión</h2>
            <?php if(isset($role) && $role): ?>
                <div class="flex items-center justify-center gap-3 mt-4">
                    <?php 
                        $roleData = [
                            'empresas' => ['icon' => 'empresas-icon.png', 'text' => 'Portal de Empresas'],
                            'admin' => ['icon' => 'admin-icon.png', 'text' => 'Panel de Administración'],
                            'cliente' => ['icon' => 'clientes-icon.png', 'text' => 'Acceso Clientes'],
                            'anonimo' => ['icon' => 'anonimo-icon.png', 'text' => 'Modo Invitado']
                        ];
                        $currentRole = $roleData[$role] ?? ['icon' => '', 'text' => 'Portal de Acceso'];
                    ?>
                    <?php if($currentRole['icon']): ?>
                        <img src="public/images/<?php echo $currentRole['icon']; ?>" alt="<?php echo $currentRole['text']; ?>" class="w-8 h-8 object-contain">
                    <?php endif; ?>
                    <p class="text-sm text-gray-400 font-light">
                        <?php echo $currentRole['text']; ?>
                    </p>
                </div>
            <?php endif; ?>
            <!-- aqui mostramos el titulo y icono dinamico -->

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

            <div class="bg-[#2c3e5f]/30 backdrop-blur-sm border border-[#3d4d6f] rounded-2xl p-8 shadow-2xl">
                <form action="?url=login/authenticate" method="POST" class="space-y-6">
        
                    <?php if(isset($role)): ?>
                        <input type="hidden" name="role" value="<?php echo htmlspecialchars(string: $role); ?>">
                    <?php endif; ?>

                    <!-- Correo Electrónico -->
                    <div>
                        <label for="email" class="block text-sm font-light text-gray-300 mb-2">Correo Electrónico</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="Rick@gmail.com"
                            required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                        >
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-light text-gray-300 mb-2">Contraseña</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="••••••••"
                            required
                            class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6c8aff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                        >
                        <div class="text-right mt-2">
                            <a href="?url=forgotPassword" class="text-xs text-[#8b9cff] hover:text-[#6c8aff] transition-colors">Olvidé mi contraseña</a>
                        </div>
                    </div>

                    <!-- Botón de Iniciar Sesión -->
                    <button 
                        type="submit"
                        class="w-full bg-[#5c7cff] hover:bg-[#4d6eef] text-white font-normal py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-[#6c8aff]/50 mt-6"
                    >
                        Iniciar Sesión
                    </button>

                    <!-- Registrarse -->
                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-400">
                            No tienes cuenta, 
                            <a href="?url=register/<?php echo isset($role) ? $role : 'admin'; ?>" class="text-[#8b9cff] hover:text-[#6c8aff] transition-colors font-normal">Regístrate</a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Botón volver -->
            <div class="text-center mt-6">
                <a href="?url=home" class="text-sm text-gray-400 hover:text-white transition-colors">
                    ← Volver al inicio
                </a>
            </div>
        </main>
    </div>
</body>
</html>
