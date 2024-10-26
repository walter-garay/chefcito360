<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Main Content -->
            <div class="min-h-screen font-sans bg-gray-100">
                <header class="flex flex-col items-center justify-between p-4 mb-6 bg-white shadow-lg rounded-xl">
                    <h2 class="mb-4 text-xl font-semibold text-gray-800">Gestión del Restaurante</h2>
                    <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-3">
                        <!-- Card for each category -->
                        <div class="flex items-center justify-between p-4 text-white bg-green-500 rounded-lg shadow-md">
                            <div>
                                <h3 class="text-lg font-bold">Reservas de Mesa</h3>
                                <p class="text-sm">10 reservas pendientes</p>
                            </div>
                            <span class="flex items-center justify-center w-10 h-10 font-bold text-green-500 bg-white rounded-full">10</span>
                        </div>
                        <div class="flex items-center justify-between p-4 text-white bg-red-500 rounded-lg shadow-md">
                            <div>
                                <h3 class="text-lg font-bold">Pedidos Pendientes</h3>
                                <p class="text-sm">5 pedidos en cola</p>
                            </div>
                            <span class="flex items-center justify-center w-10 h-10 font-bold text-red-500 bg-white rounded-full">5</span>
                        </div>
                        <div class="flex items-center justify-between p-4 text-white bg-blue-500 rounded-lg shadow-md">
                            <div>
                                <h3 class="text-lg font-bold">Reunión del Equipo</h3>
                                <p class="text-sm">1 reunión programada</p>
                            </div>
                            <span class="flex items-center justify-center w-10 h-10 font-bold text-blue-500 bg-white rounded-full">1</span>
                        </div>
                    </div>
                </header>

                <!-- Main Content -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                    <!-- Left Column (Schedule) -->
                    <div class="col-span-2">
                        <div class="p-6 mb-6 bg-white shadow-lg rounded-xl">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-xl font-semibold text-gray-800">Agenda</h2>
                                <div class="flex space-x-4 text-gray-500">
                                    <button class="px-4 py-1 bg-blue-100 rounded-full">Día</button>
                                    <button class="px-4 py-1">Semana</button>
                                    <button class="px-4 py-1">Mes</button>
                                </div>
                            </div>
                            <div class="flex space-x-4 overflow-x-auto text-center">
                                <!-- Date Tabs -->
                                <div class="p-2">
                                    <span class="block text-sm text-gray-400">Lun</span>
                                    <span class="block text-xl font-bold text-gray-800">6</span>
                                </div>
                                <div class="p-2">
                                    <span class="block text-sm text-gray-400">Mar</span>
                                    <span class="block text-xl font-bold text-gray-800">7</span>
                                </div>
                                <div class="p-2">
                                    <span class="block text-sm text-gray-400">Mié</span>
                                    <span class="block text-xl font-bold text-gray-800">8</span>
                                </div>
                                <div class="p-2">
                                    <span class="block text-sm text-gray-400">Jue</span>
                                    <span class="block text-xl font-bold text-gray-800">9</span>
                                </div>
                                <div class="p-2 text-white bg-blue-500 rounded-lg">
                                    <span class="block text-sm">Vie</span>
                                    <span class="block text-xl font-bold">10</span>
                                </div>
                            </div>
                        </div>

                        <!-- Task List -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 text-green-900 bg-green-100 rounded-lg shadow">
                                <div>
                                    <h3 class="font-bold">Preparación de Ingredientes</h3>
                                    <span class="text-sm">Cocina</span>
                                </div>
                                <span class="font-bold text-gray-500">80%</span>
                            </div>
                            <div class="flex items-center justify-between p-4 text-pink-900 bg-pink-200 rounded-lg shadow">
                                <div>
                                    <h3 class="font-bold">Limpieza del Comedor</h3>
                                    <span class="text-sm">Equipo de limpieza</span>
                                </div>
                                <span class="font-bold text-gray-500">60%</span>
                            </div>
                            <div class="flex items-center justify-between p-4 text-blue-900 bg-blue-200 rounded-lg shadow">
                                <div>
                                    <h3 class="font-bold">Revisión de Inventario</h3>
                                    <span class="text-sm">Administración</span>
                                </div>
                                <span class="font-bold text-gray-500">50%</span>
                            </div>
                            <div class="flex items-center justify-between p-4 text-yellow-900 bg-yellow-200 rounded-lg shadow">
                                <div>
                                    <h3 class="font-bold">Capacitación del Personal</h3>
                                    <span class="text-sm">Recursos Humanos</span>
                                </div>
                                <span class="font-bold text-gray-500">40%</span>
                            </div>
                            <div class="flex items-center justify-between p-4 text-teal-900 bg-teal-200 rounded-lg shadow">
                                <div>
                                    <h3 class="font-bold">Capacitación del Personal II</h3>
                                    <span class="text-sm">Recursos Humanos</span>
                                </div>
                                <span class="font-bold text-gray-500">60%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (Profile and Calendar) -->
                    <div class="space-y-6">
                        <!-- Profile Card -->
                        <div class="p-6 text-center bg-white shadow-lg rounded-xl">
                            <img src="https://via.placeholder.com/80" alt="User" class="w-20 h-20 mx-auto mb-4 rounded-full">
                            <h3 class="text-xl font-semibold">Gerente del Restaurante</h3>
                            <p class="mb-4 text-gray-500">Administración</p>

                            <!-- Stats en horizontal -->
                            <div class="flex justify-center space-x-4 text-center">
                                <div class="p-2 text-green-700 bg-green-100 rounded-lg">
                                    <span class="text-sm">Reservas</span>
                                    <p class="text-lg font-bold">14</p>
                                </div>
                                <div class="p-2 text-blue-700 bg-blue-100 rounded-lg">
                                    <span class="text-sm">Pedidos</span>
                                    <p class="text-lg font-bold">8</p>
                                </div>
                                <div class="p-2 text-purple-700 bg-purple-100 rounded-lg">
                                    <span class="text-sm">Tareas</span>
                                    <p class="text-lg font-bold">4</p>
                                </div>
                            </div>
                        </div>

                        <!-- Calendar Widget -->
                        <div class="">
                            @livewire('recursos.calendario')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
