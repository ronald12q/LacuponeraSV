<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Seguro - Cuponera SV</title>
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
                        <span class="text-xs mt-1"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    </span>
                    <a href="?url=login/logout" class="bg-red-500/20 hover:bg-red-500 text-red-400 hover:text-white px-3 py-1 rounded text-sm transition-colors">Salir</a>
                </div>
            </div>
        </div>
    </header>

   
    <main class="max-w-3xl mx-auto px-4 py-8">
        <?php 
            $cantidadInicial = isset($_GET['cantidad']) ? max(1, min((int)$_GET['cantidad'], $cupon['cantidad_cupones'], 10)) : 1;
        ?>
        
        <div class="border-2 border-[#4a6fa5] rounded-2xl p-8 bg-[#252b42]">
            <h1 class="text-3xl font-bold text-center mb-8">Pago Seguro</h1>

            
            <div class="flex justify-center mb-8">
                <img src="public/images/tarjeta-de-credito.png" alt="Tarjeta" class="w-80 h-auto rounded-xl shadow-2xl">
            </div>

            
            <form id="formPago" class="space-y-6">
                <input type="hidden" id="id_oferta" value="<?php echo $cupon['id_oferta']; ?>">
                <input type="hidden" id="precio_unitario" value="<?php echo $cupon['precio_oferta']; ?>">
                <input type="hidden" id="max_cantidad" value="<?php echo min($cupon['cantidad_cupones'], 10); ?>">

                <div>
                    <label class="block text-sm mb-2">Cantidad de cupones</label>
                    <div class="flex items-center gap-4 mb-4">
                        <button type="button" onclick="cambiarCantidad(-1)" 
                                class="bg-gray-700 hover:bg-gray-600 text-white w-12 h-12 rounded-lg text-2xl transition-colors">
                            -
                        </button>
                        <input type="number" id="cantidad" value="<?php echo $cantidadInicial; ?>" min="1" 
                               max="<?php echo min($cupon['cantidad_cupones'], 10); ?>"
                               class="w-24 h-12 bg-white text-gray-900 text-center text-xl rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6366f1]"
                               onchange="actualizarTotal()" readonly>
                        <button type="button" onclick="cambiarCantidad(1)" 
                                class="bg-gray-700 hover:bg-gray-600 text-white w-12 h-12 rounded-lg text-2xl transition-colors">
                            +
                        </button>
                    </div>
                    <p class="text-xs text-gray-400">Máximo <?php echo min($cupon['cantidad_cupones'], 10); ?> cupones por compra</p>
                </div>

                <div>
                    <label class="block text-sm mb-2">Numero de tarjeta</label>
                    <input 
                        type="text" 
                        id="numeroTarjeta"
                        placeholder="0000-0000-0000-0000"
                        maxlength="19"
                        class="w-full bg-white text-gray-900 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#6366f1]"
                        required
                    >
                </div>

                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm mb-2">Vencimiento</label>
                        <input 
                            type="text" 
                            id="vencimiento"
                            placeholder="MM/AA"
                            maxlength="5"
                            class="w-full bg-white text-gray-900 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#6366f1]"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-sm mb-2">CVV</label>
                        <input 
                            type="text" 
                            id="cvv"
                            placeholder="692"
                            maxlength="3"
                            class="w-full bg-white text-gray-900 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#6366f1]"
                            required
                        >
                    </div>
                </div>

                
                <div class="flex justify-between items-center text-lg py-4 border-t border-gray-600">
                    <span>Total a pagar :</span>
                    <span id="totalPagar" class="text-2xl font-bold">$<?php echo number_format($cupon['precio_oferta'] * $cantidadInicial, 2); ?></span>
                </div>

                <button 
                    type="submit"
                    class="w-full bg-[#6366f1] hover:bg-[#5558e3] text-white text-xl font-semibold py-4 rounded-xl shadow-lg transition-all duration-300 hover:scale-105"
                >
                    Pagar
                </button>
            </form>
        </div>
    </main>

    
    <div id="modalCompra" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 p-4">
        <div class="bg-[#252b42] rounded-2xl p-8 max-w-md w-full text-center border-2 border-green-500 shadow-2xl">
          
            <div class="flex justify-center mb-6">
                <div class="bg-green-500 rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <h2 class="text-3xl font-bold mb-4 text-green-400">¡Compra Completada!</h2>
            
            <p class="text-gray-300 mb-6">Tu cupón ha sido adquirido exitosamente</p>

           
            <div class="bg-[#1a1f35] rounded-xl p-6 mb-6">
                <p class="text-sm text-gray-400 mb-2">Tu código de cupón es:</p>
                <p id="codigoCupon" class="text-3xl font-bold text-[#a78bfa] tracking-wider"></p>
            </div>

            <p class="text-sm text-gray-400 mb-6">Guarda este código para canjear tu cupón en el establecimiento</p>

          
            <a href="?url=cliente" class="block w-full bg-[#6366f1] hover:bg-[#5558e3] text-white text-lg font-semibold py-3 rounded-xl transition-colors">
                Volver a Cupones
            </a>
        </div>
    </div>

    <script>
        const precioUnitario = parseFloat(document.getElementById('precio_unitario').value);
        const maxCantidad = parseInt(document.getElementById('max_cantidad').value);

        function cambiarCantidad(delta) {
            const input = document.getElementById('cantidad');
            let valor = parseInt(input.value) + delta;
            if (valor < 1) valor = 1;
            if (valor > maxCantidad) valor = maxCantidad;
            input.value = valor;
            actualizarTotal();
        }

        function actualizarTotal() {
            const cantidad = parseInt(document.getElementById('cantidad').value);
            const total = cantidad * precioUnitario;
            document.getElementById('totalPagar').textContent = '$' + total.toFixed(2);
        }

        document.getElementById('numeroTarjeta').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join('-') || value;
            e.target.value = formattedValue;
        });

        
        document.getElementById('vencimiento').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
        });

       
        document.getElementById('cvv').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });

        document.getElementById('formPago').addEventListener('submit', async function(e) {
            e.preventDefault();

            const idOferta = document.getElementById('id_oferta').value;
            const cantidad = document.getElementById('cantidad').value;

            const formData = new FormData();
            formData.append('id_oferta', idOferta);
            formData.append('cantidad', cantidad);

            try {
                const response = await fetch('?url=cliente/procesarCompra', {
                    method: 'POST',
                    body: formData
                });

                const text = await response.text();
                
                const fecha = new Date().toISOString().slice(0, 10).replace(/-/g, '');
                const random = Math.random().toString(36).substring(2, 10).toUpperCase();
                const codigo = `CUP-${fecha}-${random}`;

                document.getElementById('codigoCupon').textContent = codigo;
                document.getElementById('modalCompra').classList.remove('hidden');
                document.getElementById('modalCompra').classList.add('flex');

            } catch (error) {
                console.error('Error:', error);
                alert('Error al procesar la compra. Intenta nuevamente.');
            }
        });
    </script>

</body>
</html>
