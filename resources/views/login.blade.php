<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strooper - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css'])
    @vite(['resources/css/login.css'])
</head>
<body class="min-h-screen relative">
    <!-- Particles Background -->
    <div class="particles" id="particles"></div>

    <!-- Home Button -->
    <div class="fixed top-6 left-6 z-50">
        <button class="home-button px-6 py-3 rounded-full text-white font-bold text-lg hover:scale-110 transform transition-all duration-300 shadow-lg">
            <a href="{{ url('/home') }}">🏠 HOME</a>
        </button>
    </div>

    <!-- Main Container -->
    <div class="min-h-screen flex items-center justify-center px-4 relative z-10">
        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Side - Game Character/Branding -->
            <div class="slide-in-left text-center lg:text-left">
                <div class="floating-animation mb-8">
                    <div class="w-64 h-64 mx-auto lg:mx-0 gradient-bg rounded-full flex items-center justify-center pulse-glow">
                        <div class="text-8xl">🎮</div>
                    </div>
                </div>
                
                <h1 class="text-6xl lg:text-7xl font-black text-white mb-6 neon-text">
                    STROOPER
                </h1>
                
                <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                    ¡Prepárate para el desafío mental más intenso! 
                    Pon a prueba tu velocidad y precisión en el juego de colores más adictivo.
                </p>
                
                <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                    <div class="floating-animation bg-yellow-500 text-black px-4 py-2 rounded-full font-bold">
                        ⚡ RÁPIDO
                    </div>
                    <div class="floating-animation-delayed bg-blue-500 text-white px-4 py-2 rounded-full font-bold">
                        🧠 MENTAL
                    </div>
                    <div class="floating-animation bg-orange-500 text-white px-4 py-2 rounded-full font-bold">
                        🏆 COMPETITIVO
                    </div>
                </div>
            </div>

<!-- Right Side - Login Form -->
<div class="slide-in-right flex justify-center">
    <div class="bg-gray-900 bg-opacity-80 backdrop-blur-lg rounded-3xl p-6 shadow-2xl border border-purple-500 border-opacity-30 w-full max-w-md">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-black text-white mb-2 neon-text">INICIAR SESIÓN</h2>
            <p class="text-gray-400">¡Bienvenido de vuelta, jugador!</p>
        </div>
<form class="space-y-5" id="loginForm" method="POST" action="/login">
    @csrf
    <div class="scale-in">
        <label class="block text-white font-bold mb-2 text-lg">👤 Usuario</label>
        <input type="text" name="username"
               class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none text-base"
               placeholder="Ingresa tu nombre de usuario"
               required>
    </div>
    <div class="scale-in" style="animation-delay: 0.1s;">
        <label class="block text-white font-bold mb-2 text-lg">🔒 Contraseña</label>
        <input type="password" name="password"
               class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none text-base"
               placeholder="Ingresa tu contraseña"
               required>
    </div>
    <div class="flex items-center justify-between scale-in" style="animation-delay: 0.2s;">
        <label class="flex items-center text-white">
            <input type="checkbox" class="mr-2 accent-yellow-500">
            Recordarme
        </label>
        <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors text-sm">
            ¿Olvidaste tu contraseña?
        </a>
    </div>
    <button type="submit"
            class="game-button w-full py-3 rounded-xl text-white font-bold text-lg transition-all duration-300 bounce-in">
        🚀 JUGAR AHORA
    </button>
</form>

        <div class="mt-6 text-center">
            <p class="text-gray-400 mb-4">¿No tienes cuenta?</p>
            <button id="registerBtn"
                    class="game-button px-6 py-2 rounded-xl text-white font-bold text-base transition-all duration-300">
                ✨ REGISTRARSE
            </button>
        </div>
        <div class="mt-6 pt-4 border-t border-gray-700">
            <p class="text-center text-gray-400 mb-4">O continúa con:</p>
            <div class="flex gap-4 justify-center">
                <button class="bg-blue-600 hover:bg-blue-700 p-2 rounded-lg transition-all duration-300 hover:scale-110">
                    <span class="text-xl">📘</span>
                </button>
                <button class="bg-red-600 hover:bg-red-700 p-2 rounded-lg transition-all duration-300 hover:scale-110">
                    <span class="text-xl">🔴</span>
                </button>
                <button class="bg-gray-800 hover:bg-gray-700 p-2 rounded-lg transition-all duration-300 hover:scale-110">
                    <span class="text-xl">🐙</span>
                </button>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>

    <!-- Registration Modal -->
    <div id="registerModal" class="fixed inset-0 modal-backdrop z-50 flex items-center justify-center hidden">
        <div class="bg-gray-900 bg-opacity-95 backdrop-blur-lg rounded-3xl p-8 max-w-md w-full mx-4 shadow-2xl border border-purple-500 border-opacity-30 scale-in">
            <div class="text-center mb-6">
                <h3 class="text-3xl font-black text-white mb-2 neon-text">🎮 REGISTRO</h3>
                <p class="text-gray-400">¡Únete a la comunidad Strooper!</p>
            </div>

<form class="space-y-4" id="registerForm" method="POST" action="/register">
    @csrf
    <div>
        <label class="block text-white font-bold mb-2">👤 Nombre de Usuario</label>
        <input type="text" name="username"
               class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none"
               placeholder="Tu nombre de usuario"
               required>
    </div>
    <div>
        <label class="block text-white font-bold mb-2">📧 Email</label>
        <input type="email" name="email"
               class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none"
               placeholder="tu@email.com"
               required>
    </div>
    <div>
        <label class="block text-white font-bold mb-2">🔒 Contraseña</label>
        <input type="password" name="password"
               class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none"
               placeholder="Mínimo 8 caracteres"
               required>
    </div>
    <div>
        <label class="block text-white font-bold mb-2">🔒 Confirmar Contraseña</label>
        <input type="password" name="password_confirmation"
               class="input-field w-full px-4 py-3 rounded-xl text-white placeholder-gray-400 focus:outline-none"
               placeholder="Repite tu contraseña"
               required>
    </div>
    <div class="flex items-center text-white">
        <input type="checkbox" class="mr-2 accent-yellow-500" required>
        <span class="text-sm">Acepto los términos y condiciones</span>
    </div>
    <div class="flex gap-4">
        <button type="button"
                id="cancelRegister"
                class="w-1/2 py-3 bg-gray-700 hover:bg-gray-600 rounded-xl text-white font-bold transition-all duration-300">
            ❌ Cancelar
        </button>
        <button type="submit"
                class="game-button w-1/2 py-3 rounded-xl text-white font-bold transition-all duration-300">
            🚀 Crear Cuenta
        </button>
    </div>
</form>

        </div>
    </div>

    @vite(['resources/js/login.js'])
</body>
</html>