<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Strooper Game</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css'])
    @vite(['resources/css/profile.css'])
</head>
<body class="min-h-screen text-white">
    <!-- Header -->
    <header class="p-6 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center text-xl font-bold floating-animation">
                S
            </div>
            <h1 class="text-2xl font-bold">STROOPER</h1>
        </div>
        
        <nav class="flex space-x-4">
            <button onclick="goHome()" class="btn-secondary px-6 py-3 rounded-full font-semibold hover:shadow-lg transition-all duration-300">
                <a href="{{ url('/home') }}">🏠 Home</a>
            </button>
            <button onclick="startGame()" class="btn-primary px-6 py-3 rounded-full font-semibold hover:shadow-lg transition-all duration-300">
                🎮 Jugar
            </button>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <!-- Profile Header -->
        <div class="slide-in mb-12">
            <div class="glass-effect rounded-3xl p-8 text-center">
                <div class="relative inline-block mb-6">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&h=150&fit=crop&crop=face" 
                         alt="Profile" 
                         class="w-32 h-32 rounded-full profile-image bounce-in">
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white notification-dot"></div>
                </div>
                
                <h2 class="text-3xl font-bold mb-2">Juan Pérez</h2>
                <p class="text-gray-300 mb-4">Maestro del Stroop</p>
                
                <div class="flex justify-center space-x-6 text-sm">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-400">127</div>
                        <div class="text-gray-400">Partidas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-400">85%</div>
                        <div class="text-gray-400">Precisión</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-400">1.2s</div>
                        <div class="text-gray-400">Mejor Tiempo</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            <div class="stat-card rounded-2xl p-6 bounce-in" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Partidas Jugadas</h3>
                    <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center">
                        🎯
                    </div>
                </div>
                <div class="text-3xl font-bold mb-2">127</div>
                <p class="text-gray-400 text-sm">+12 esta semana</p>
            </div>

            <div class="stat-card rounded-2xl p-6 bounce-in" style="animation-delay: 0.4s">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Mejor Porcentaje</h3>
                    <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                        📊
                    </div>
                </div>
                <div class="text-3xl font-bold mb-2">94.7%</div>
                <p class="text-gray-400 text-sm">Nivel Veterano</p>
            </div>

            <div class="stat-card rounded-2xl p-6 bounce-in" style="animation-delay: 0.6s">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Tiempo Promedio</h3>
                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                        ⚡
                    </div>
                </div>
                <div class="text-3xl font-bold mb-2">1.24s</div>
                <p class="text-gray-400 text-sm">Reacción rápida</p>
            </div>
        </div>

        <!-- Profile Management -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Personal Info -->
            <div class="glass-effect rounded-2xl p-6 slide-in" style="animation-delay: 0.8s">
                <h3 class="text-2xl font-bold mb-6 flex items-center">
                    <span class="w-8 h-8 bg-pink-500 rounded-lg flex items-center justify-center mr-3">👤</span>
                    Información Personal
                </h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-4 bg-white bg-opacity-5 rounded-xl">
                        <div>
                            <div class="font-semibold">Nombre</div>
                            <div class="text-gray-400">Juan Pérez</div>
                        </div>
                        <button onclick="editName()" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            ✏️
                        </button>
                    </div>

                    <div class="flex justify-between items-center p-4 bg-white bg-opacity-5 rounded-xl">
                        <div>
                            <div class="font-semibold">Email</div>
                            <div class="text-gray-400">juan@email.com</div>
                        </div>
                        <button onclick="editEmail()" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            ✏️
                        </button>
                    </div>

                    <div class="flex justify-between items-center p-4 bg-white bg-opacity-5 rounded-xl">
                        <div>
                            <div class="font-semibold">Nivel Favorito</div>
                            <div class="text-gray-400">Veterano</div>
                        </div>
                        <button onclick="editLevel()" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            ✏️
                        </button>
                    </div>
                </div>
            </div>

            <!-- Account Actions -->
            <div class="glass-effect rounded-2xl p-6 slide-in" style="animation-delay: 1s">
                <h3 class="text-2xl font-bold mb-6 flex items-center">
                    <span class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center mr-3">⚙️</span>
                    Gestión de Cuenta
                </h3>
                
                <div class="space-y-4">
                    <button onclick="changePassword()" class="w-full p-4 bg-blue-500 bg-opacity-20 hover:bg-opacity-30 rounded-xl text-left transition-all duration-300 hover:transform hover:scale-105">
                        <div class="flex items-center">
                            <span class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-4">🔐</span>
                            <div>
                                <div class="font-semibold">Cambiar Contraseña</div>
                                <div class="text-gray-400 text-sm">Actualiza tu contraseña</div>
                            </div>
                        </div>
                    </button>

                    <button onclick="exportData()" class="w-full p-4 bg-green-500 bg-opacity-20 hover:bg-opacity-30 rounded-xl text-left transition-all duration-300 hover:transform hover:scale-105">
                        <div class="flex items-center">
                            <span class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-4">📊</span>
                            <div>
                                <div class="font-semibold">Exportar Datos</div>
                                <div class="text-gray-400 text-sm">Descarga tu historial</div>
                            </div>
                        </div>
                    </button>

                    <button onclick="logout()" class="w-full p-4 bg-yellow-500 bg-opacity-20 hover:bg-opacity-30 rounded-xl text-left transition-all duration-300 hover:transform hover:scale-105">
                        <div class="flex items-center">
                            <span class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center mr-4">🚪</span>
                            <div>
                                <div class="font-semibold">Cerrar Sesión</div>
                                <div class="text-gray-400 text-sm">Salir de tu cuenta</div>
                            </div>
                        </div>
                    </button>

                    <button onclick="deleteAccount()" class="w-full p-4 bg-red-500 bg-opacity-20 hover:bg-opacity-30 rounded-xl text-left transition-all duration-300 hover:transform hover:scale-105">
                        <div class="flex items-center">
                            <span class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center mr-4">🗑️</span>
                            <div>
                                <div class="font-semibold">Eliminar Cuenta</div>
                                <div class="text-gray-400 text-sm">Acción irreversible</div>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Games -->
        <div class="mt-12 glass-effect rounded-2xl p-6 slide-in" style="animation-delay: 1.2s">
            <h3 class="text-2xl font-bold mb-6 flex items-center">
                <span class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center mr-3">🏆</span>
                Partidas Recientes
            </h3>
            
            <div class="space-y-3">
                <div class="flex justify-between items-center p-4 bg-white bg-opacity-5 rounded-xl hover:bg-opacity-10 transition-all">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-4"></div>
                        <div>
                            <div class="font-semibold">Nivel Normal - 87.5%</div>
                            <div class="text-gray-400 text-sm">Hace 2 horas</div>
                        </div>
                    </div>
                    <div class="text-green-400 font-bold">+250 pts</div>
                </div>

                <div class="flex justify-between items-center p-4 bg-white bg-opacity-5 rounded-xl hover:bg-opacity-10 transition-all">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-4"></div>
                        <div>
                            <div class="font-semibold">Nivel Veterano - 92.1%</div>
                            <div class="text-gray-400 text-sm">Ayer</div>
                        </div>
                    </div>
                    <div class="text-green-400 font-bold">+380 pts</div>
                </div>

                <div class="flex justify-between items-center p-4 bg-white bg-opacity-5 rounded-xl hover:bg-opacity-10 transition-all">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-purple-500 rounded-full mr-4"></div>
                        <div>
                            <div class="font-semibold">Nivel Dios - 73.2%</div>
                            <div class="text-gray-400 text-sm">Hace 2 días</div>
                        </div>
                    </div>
                    <div class="text-green-400 font-bold">+190 pts</div>
                </div>
            </div>
        </div>
    </main>

    <!-- Floating Elements -->
    <div class="fixed top-20 right-10 w-16 h-16 bg-yellow-400 rounded-full opacity-20 floating-animation" style="animation-delay: 1s;"></div>
    <div class="fixed bottom-20 left-10 w-12 h-12 bg-pink-500 rounded-full opacity-20 floating-animation" style="animation-delay: 2s;"></div>
    <div class="fixed top-1/2 right-5 w-8 h-8 bg-blue-400 rounded-full opacity-20 floating-animation" style="animation-delay: 3s;"></div>

    @vite(['resources/js/profile.js'])
</body>
</html>