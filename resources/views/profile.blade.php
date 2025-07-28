@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $recentGames = $user->recentGames(); // Ya definida en tu modelo User
@endphp

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
<body class="min-h-screen text-white bg-gray-900">
    <!-- Header -->
    <header class="p-6 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center text-xl font-bold floating-animation">
                S
            </div>
            <h1 class="text-2xl font-bold">STROOPER</h1>
        </div>
        
        <nav class="flex space-x-4">
            <a href="{{ url('/home') }}" class="btn-secondary px-6 py-3 rounded-full font-semibold hover:shadow-lg transition-all duration-300">
                🏠 Home
            </a>
            <a href="{{ url('/game') }}" class="btn-primary px-6 py-3 rounded-full font-semibold hover:shadow-lg transition-all duration-300">
                🎮 Jugar
            </a>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <!-- Profile Header -->
        <div class="mb-12">
            <div class="glass-effect rounded-3xl p-8 text-center">
                <div class="relative inline-block mb-6">
                    <img src="{{ $user->avatar ?? 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&h=150&fit=crop&crop=face' }}" 
                         alt="Profile" 
                         class="w-32 h-32 rounded-full profile-image bounce-in">
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white notification-dot"></div>
                </div>
                
                <h2 class="text-3xl font-bold mb-2">{{ $user->username }}</h2>
                <p class="text-gray-300 mb-4">{{ $user->level_title }}</p>
                
                <div class="flex justify-center space-x-6 text-sm">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-400">{{ $user->games_played }}</div>
                        <div class="text-gray-400">Partidas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-400">{{ $user->average_accuracy }}%</div>
                        <div class="text-gray-400">Precisión</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-400">{{ $user->best_time }}s</div>
                        <div class="text-gray-400">Mejor Tiempo</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            <div class="stat-card rounded-2xl p-6">
                <h3 class="text-lg font-semibold mb-2">Partidas Jugadas</h3>
                <div class="text-3xl font-bold mb-1">{{ $user->games_played }}</div>
                <p class="text-gray-400 text-sm">+12 esta semana</p>
            </div>

            <div class="stat-card rounded-2xl p-6">
                <h3 class="text-lg font-semibold mb-2">Mejor Porcentaje</h3>
                <div class="text-3xl font-bold mb-1">{{ $user->average_accuracy }}%</div>
                <p class="text-gray-400 text-sm">{{ $user->favorite_level }}</p>
            </div>

            <div class="stat-card rounded-2xl p-6">
                <h3 class="text-lg font-semibold mb-2">Tiempo Promedio</h3>
                <div class="text-3xl font-bold mb-1">{{ $user->best_time }}s</div>
                <p class="text-gray-400 text-sm">Reacción rápida</p>
            </div>
        </div>

        <!-- Información Personal -->
        <div class="grid md:grid-cols-2 gap-8">
            <div class="glass-effect rounded-2xl p-6">
                <h3 class="text-2xl font-bold mb-6">Información Personal</h3>
                <div class="space-y-4">
                    <div class="bg-white bg-opacity-10 p-4 rounded-xl">
                        <div class="font-semibold">Nombre</div>
                        <div class="text-gray-300">{{ $user->username }}</div>
                    </div>

                    <div class="bg-white bg-opacity-10 p-4 rounded-xl">
                        <div class="font-semibold">Email</div>
                        <div class="text-gray-300">{{ $user->email }}</div>
                    </div>

                    <div class="bg-white bg-opacity-10 p-4 rounded-xl">
                        <div class="font-semibold">Nivel Favorito</div>
                        <div class="text-gray-300">{{ $user->favorite_level }}</div>
                    </div>
                </div>
            </div>

            <div class="glass-effect rounded-2xl p-6">
                <h3 class="text-2xl font-bold mb-6">Gestión de Cuenta</h3>
                <div class="space-y-4">
                    <button onclick="changePassword()" class="w-full p-4 bg-blue-600 hover:bg-blue-700 rounded-xl">
                        🔐 Cambiar Contraseña
                    </button>
                    <button onclick="exportData()" class="w-full p-4 bg-green-600 hover:bg-green-700 rounded-xl">
                        📊 Exportar Datos
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full p-4 bg-yellow-600 hover:bg-yellow-700 rounded-xl">
                            🚪 Cerrar Sesión
                        </button>
                    </form>
                    <button onclick="deleteAccount()" class="w-full p-4 bg-red-600 hover:bg-red-700 rounded-xl">
                        🗑️ Eliminar Cuenta
                    </button>
                </div>
            </div>
        </div>

        <!-- Partidas Recientes -->
        <div class="mt-12 glass-effect rounded-2xl p-6">
            <h3 class="text-2xl font-bold mb-6">Partidas Recientes</h3>
            @forelse ($recentGames as $game)
                <div class="flex justify-between items-center p-4 bg-white bg-opacity-5 rounded-xl mb-2">
                    <div class="flex items-center">
                        <div class="w-3 h-3 {{ $game->level_color }} rounded-full mr-4"></div>
                        <div>
                            <div class="font-semibold">Nivel {{ $game->level }} - {{ $game->accuracy }}%</div>
                            <div class="text-gray-400 text-sm">{{ $game->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="text-green-400 font-bold">+{{ $game->score }} pts</div>
                </div>
            @empty
                <p class="text-gray-400">No hay partidas recientes.</p>
            @endforelse
        </div>
    </main>

    <script>
        function changePassword() {
            alert("Función cambiar contraseña no implementada todavía.");
        }
        function exportData() {
            alert("Función exportar datos no implementada.");
        }
        function deleteAccount() {
            if (confirm("¿Estás seguro de eliminar tu cuenta? Esta acción no se puede deshacer.")) {
                alert("Eliminar cuenta no implementado.");
            }
        }
    </script>
    @vite(['resources/js/profile.js'])
</body>
</html>
