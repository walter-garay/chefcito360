<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <header class="flex items-center justify-between p-4 bg-white shadow-md">
        <h1 class="text-2xl font-bold text-purple-800">FOODIED</h1>
        <nav class="space-x-8 text-gray-600">
            <a href="#" class="hover:text-purple-800">Inicio</a>
            <a href="#" class="hover:text-purple-800">Menú</a>
            <a href="#" class="hover:text-purple-800">Nosotros</a>
            <a href="#" class="hover:text-purple-800">Contacto</a>
        </nav>
        <button class="px-4 py-2 text-white bg-purple-800 rounded-lg hover:bg-purple-700">Regístrate</button>
    </header>

    <!-- Hero Section -->
    <section class="p-8 text-center bg-gradient-to-r from-purple-200 via-purple-100 to-white">
        <div class="max-w-3xl mx-auto space-y-6">
            <p class="text-xl font-semibold text-purple-600">¿Tienes Hambre?</p>
            <h2 class="text-4xl font-bold text-purple-800">VEN A FOODIED Y ORDENA</h2>
            <p class="text-gray-500">Aquí encontrarás siempre la mejor calidad de alimentos. Ordena ahora y satisface tus antojos.</p>
            <div class="flex items-center justify-center space-x-4">
                <button class="px-6 py-3 text-white bg-purple-800 rounded-full hover:bg-purple-700">Ordena Ahora</button>
                <button class="px-6 py-3 text-purple-800 border border-purple-800 rounded-full hover:bg-purple-50">Explorar Más</button>
            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <section class="py-8">
        <div class="text-center">
            <h3 class="text-2xl font-bold text-purple-800">Nuestro Menú Especial</h3>
            <p class="text-gray-500">Los platos más deliciosos y saludables para ti</p>
        </div>
        <div class="grid gap-6 mt-8 md:grid-cols-4">
            <!-- Card de Producto -->
            <div class="p-4 bg-white rounded-lg shadow-lg">
                <img src="https://via.placeholder.com/100" alt="Chicken Burger" class="w-full rounded-lg">
                <h4 class="mt-4 text-lg font-bold text-gray-800">Hamburguesa de Pollo</h4>
                <p class="text-gray-500">Hamburguesa de pollo saludable y deliciosa.</p>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-lg font-bold text-purple-800">$3.50</span>
                    <button class="px-4 py-1 text-white bg-purple-600 rounded-lg hover:bg-purple-700">Comprar</button>
                </div>
            </div>

            <!-- Card de Producto (repite para cada plato) -->
            <div class="p-4 bg-white rounded-lg shadow-lg">
                <img src="https://via.placeholder.com/100" alt="Chicken Pizza" class="w-full rounded-lg">
                <h4 class="mt-4 text-lg font-bold text-gray-800">Pizza de Pollo</h4>
                <p class="text-gray-500">Pizza deliciosa con ingredientes frescos.</p>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-lg font-bold text-purple-800">$3.80</span>
                    <button class="px-4 py-1 text-white bg-purple-600 rounded-lg hover:bg-purple-700">Comprar</button>
                </div>
            </div>

            <!-- Otro producto -->
            <div class="p-4 bg-white rounded-lg shadow-lg">
                <img src="https://via.placeholder.com/100" alt="Chicken Rice" class="w-full rounded-lg">
                <h4 class="mt-4 text-lg font-bold text-gray-800">Arroz con Pollo</h4>
                <p class="text-gray-500">Exquisito plato de arroz con pollo y verduras.</p>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-lg font-bold text-purple-800">$4.50</span>
                    <button class="px-4 py-1 text-white bg-purple-600 rounded-lg hover:bg-purple-700">Comprar</button>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow-lg">
                <img src="https://via.placeholder.com/100" alt="Postre Especial" class="w-full rounded-lg">
                <h4 class="mt-4 text-lg font-bold text-gray-800">Postre Especial</h4>
                <p class="text-gray-500">Postre delicioso y saludable.</p>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-lg font-bold text-purple-800">$2.50</span>
                    <button class="px-4 py-1 text-white bg-purple-600 rounded-lg hover:bg-purple-700">Comprar</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-12 bg-gray-50">
        <div class="text-center">
            <h3 class="text-2xl font-bold text-purple-800">¿Por qué Elegirnos?</h3>
            <p class="text-gray-500">Ofrecemos comida saludable, calidad garantizada y entregas rápidas.</p>
        </div>
        <div class="grid gap-6 mt-8 md:grid-cols-3">
            <!-- Característica 1 -->
            <div class="p-6 text-center bg-white rounded-lg shadow-lg">
                <img src="https://via.placeholder.com/50" alt="Healthy Food" class="mx-auto mb-4">
                <h4 class="text-lg font-bold text-gray-800">Comida Saludable</h4>
                <p class="text-gray-500">Ofrecemos alimentos frescos y nutritivos.</p>
            </div>

            <!-- Característica 2 -->
            <div class="p-6 text-center bg-white rounded-lg shadow-lg">
                <img src="https://via.placeholder.com/50" alt="Best Quality" class="mx-auto mb-4">
                <h4 class="text-lg font-bold text-gray-800">Mejor Calidad</h4>
                <p class="text-gray-500">Calidad excelente y platos hechos a pedido.</p>
            </div>

            <!-- Característica 3 -->
            <div class="p-6 text-center bg-white rounded-lg shadow-lg">
                <img src="https://via.placeholder.com/50" alt="Fast Delivery" class="mx-auto mb-4">
                <h4 class="text-lg font-bold text-gray-800">Entrega Rápida</h4>
                <p class="text-gray-500">Recibe tus pedidos a tiempo, cada vez.</p>
            </div>
        </div>
    </section>
</div>
