<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Cuponera SV</title>
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
    <div class="w-full max-w-2xl px-8">
        <header class="text-center mb-8">
            <h1 class="text-6xl text-[#7132d1ff] mb-4 font-light tracking-wide">Cuponera SV</h1>
            <h2 class="text-lg text-white font-light">Únete a la comunidad cuponera sv</h2>
        </header>

        <main>
            <?php if(isset($_SESSION['error'])): ?>
                <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-lg mb-4">
                    <?php echo htmlspecialchars(string: $_SESSION['error']); unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            
            <div class="bg-[#1E233A]/30 backdrop-blur-sm border border-[#3d4d6f] rounded-2xl p-8 shadow-2xl">
                <form action="?url=register/store" method="POST" class="space-y-5">
                   
                    <?php if(isset($role)): ?>
                        <input type="hidden" name="role" value="<?php echo htmlspecialchars(string: $role); ?>">
                    <?php endif; ?>

                    <?php if(!isset($role) || $role === 'admin'): ?>
                        <!-- FORMULARIO ADMIN: 3 campos -->
                        <div>
                            <label for="usuario" class="block text-sm font-light text-gray-300 mb-2">Usuario</label>
                            <input 
                                type="text" 
                                id="usuario" 
                                name="usuario" 
                                placeholder="Admin"
                                required
                                class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            >
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-light text-gray-300 mb-2">Contraseña</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••"
                                required
                                class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            >
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-light text-gray-300 mb-2">Correo Electronico</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                placeholder="Rick@gmail.com"
                                required
                                class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            >
                        </div>

                    <?php elseif($role === 'empresas'): ?>
                        <!-- FORMULARIO EMPRESAS: 7 campos -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="nombre_empresa" class="block text-sm font-light text-gray-300 mb-2">Nombre Empresa</label>
                                <input 
                                    type="text" 
                                    id="nombre_empresa" 
                                    name="nombre_empresa" 
                                    placeholder="Rick"
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-light text-gray-300 mb-2">Correo Electronico</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    placeholder="Rick@gmail.com"
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-light text-gray-300 mb-2">Contraseña</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••"
                                required
                                class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            >
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="usuario" class="block text-sm font-light text-gray-300 mb-2">Usuario</label>
                                <input 
                                    type="text" 
                                    id="usuario" 
                                    name="usuario" 
                                    placeholder="Gerente"
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>

                            <div>
                                <label for="telefono" class="block text-sm font-light text-gray-300 mb-2">Teléfono</label>
                                <input 
                                    type="tel" 
                                    id="telefono" 
                                    name="telefono" 
                                    placeholder="6531-2373"
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="nit" class="block text-sm font-light text-gray-300 mb-2">NIT</label>
                                <input 
                                    type="text" 
                                    id="nit" 
                                    name="nit" 
                                    placeholder="432432432-442424-412412"
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>

                            <div>
                                <label for="direccion" class="block text-sm font-light text-gray-300 mb-2">Dirección</label>
                                <input 
                                    type="text" 
                                    id="direccion" 
                                    name="direccion" 
                                    placeholder="Centro de san salvador"
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>
                        </div>

                    <?php elseif($role === 'cliente'): ?>
                        <!-- FORMULARIO CLIENTES: 7 campos -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="usuario" class="block text-sm font-light text-gray-300 mb-2">Usuario</label>
                                <input 
                                    type="text" 
                                    id="usuario" 
                                    name="usuario" 
                                    placeholder="Rick"
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-light text-gray-300 mb-2">Correo Electronico</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    placeholder="Rick@gmail.com"
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-light text-gray-300 mb-2">Contraseña</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••"
                                required
                                class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                            >
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="nombre_completo" class="block text-sm font-light text-gray-300 mb-2">Nombre completo</label>
                                <input 
                                    type="text" 
                                    id="nombre_completo" 
                                    name="nombre_completo" 
                                    placeholder="Rick alejandro..."
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>

                            <div>
                                <label for="apellidos" class="block text-sm font-light text-gray-300 mb-2">Apellidos</label>
                                <input 
                                    type="text" 
                                    id="apellidos" 
                                    name="apellidos" 
                                    placeholder="Hernandez crespo..."
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="dui" class="block text-sm font-light text-gray-300 mb-2">DUI</label>
                                <input 
                                    type="text" 
                                    id="dui" 
                                    name="dui" 
                                    placeholder="06234322-7"
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>

                            <div>
                                <label for="fecha_nacimiento" class="block text-sm font-light text-gray-300 mb-2">Fecha de nacimiento</label>
                                <input 
                                    type="text" 
                                    id="fecha_nacimiento" 
                                    name="fecha_nacimiento" 
                                    placeholder="DD/MM/AAAA"
                                    required
                                    class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7132d1ff] focus:bg-white transition-all duration-200 placeholder-gray-500"
                                >
                            </div>
                        </div>

                    <?php endif; ?>

                    <!-- Botón para enviar el formulario -->
                    <button 
                        type="submit"
                        class="w-full bg-[#362DD2] hover:bg-[#4d6eef] text-white font-normal py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-[#6c8aff]/50 mt-6"
                    >
                        Registrarse
                    </button>

                    <!-- mensaje  para volver a iniciar sesion   -->
                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-400">
                            Ya tienes cuenta, 
                            <a href="?url=login/<?php echo isset($role) ? $role : 'admin'; ?>" class="text-[#8b9cff] hover:text-[#6c8aff] transition-colors font-normal">Inicia sesión</a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- boton-texto para regresar a home -->
            <div class="text-center mt-6">
                <a href="?url=home" class="text-sm text-gray-400 hover:text-white transition-colors">
                    ← Volver al inicio
                </a>
            </div>
        </main>
    </div>
</body>
</html>
