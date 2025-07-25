<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strooper Game - Demo</title>
    <script src="https://cdn.tailwindcss.com"></script>
     @vite(['resources/css/style.css'])
     @vite(['resources/css/demo.css'])
</head>
<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 glass-effect p-6 flex flex-col">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">STROOPER</h1>
                <p class="text-sm text-gray-200">Demo Version</p>
            </div>
            <nav class="flex-1 space-y-4">
                <button id="homeBtn" class="sidebar-btn w-full py-3 px-4 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-400">
                    <a href="{{ url('/home') }}">🏠 HOME</a>
                </button>
                <button id="playBtn" class="sidebar-btn w-full py-3 px-4 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-400">
                    🎮 JUGAR
                </button>
                <button id="settingsBtn" class="sidebar-btn w-full py-3 px-4 bg-gray-600 text-white font-bold rounded-lg hover:bg-gray-500">
                    ⚙️ AJUSTES
                </button>
                <button id="scoresBtn" class="sidebar-btn w-full py-3 px-4 bg-gray-600 text-white font-bold rounded-lg hover:bg-gray-500">
                    🏆 PUNTAJES
                </button>
                <button id="helpBtn" class="sidebar-btn w-full py-3 px-4 bg-gray-600 text-white font-bold rounded-lg hover:bg-gray-500">
                    ❓ AYUDA
                </button>
            </nav>
            <!-- Settings Panel -->
            <div id="settingsPanel" class="hidden mt-6 p-4 glass-effect rounded-lg">
                <h3 class="text-white font-bold mb-4">Configuración</h3>
                <div class="space-y-3">
                    <div>
                        <label class="text-white text-sm">Duración Demo (seg)</label>
                        <input type="range" id="durationSlider" min="10" max="60" value="30" class="w-full">
                        <span id="durationValue" class="text-yellow-400 text-sm">30s</span>
                    </div>
                    <div class="relative">
                        <button class="config-locked w-full py-2 px-3 bg-gray-700 text-gray-400 rounded cursor-not-allowed" data-locked="true">
                            Nivel de Dificultad
                        </button>
                    </div>
                    <div class="relative">
                        <button class="config-locked w-full py-2 px-3 bg-gray-700 text-gray-400 rounded cursor-not-allowed" data-locked="true">
                            Colores Personalizados
                        </button>
                    </div>
                    <div class="relative">
                        <button class="config-locked w-full py-2 px-3 bg-gray-700 text-gray-400 rounded cursor-not-allowed" data-locked="true">
                            Tiempo por Palabra
                        </button>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Game Area -->
        <main class="flex-1 flex flex-col items-center justify-center p-8">
            <div class="glass-effect rounded-3xl p-12 text-center float-animation relative">
                <button id="closeGame" class="absolute top-4 right-4 text-white text-2xl font-bold">X</button>
                <div id="gameStatus" class="text-white mb-8">
                    <h2 class="text-2xl font-bold mb-2">¡Presiona JUGAR para comenzar!</h2>
                    <p class="text-gray-200">Selecciona si la palabra coincide con su color</p>
                </div>
                <div id="wordDisplay" class="word-display text-white mb-12 h-24 flex items-center justify-center">
                    STROOPER
                </div>
                <div id="gameButtons" class="space-x-8 hidden">
                    <button id="correctBtn" class="btn-game px-12 py-4 bg-green-500 text-white font-bold rounded-full text-xl hover:bg-green-400 glow-effect">
                        ✓ CORRECTO
                    </button>
                    <button id="incorrectBtn" class="btn-game px-12 py-4 bg-red-500 text-white font-bold rounded-full text-xl hover:bg-red-400 glow-effect">
                        ✗ INCORRECTO
                    </button>
                </div>
                <div id="startButton" class="pulse-animation">
                    <button id="startGame" class="btn-game px-16 py-6 bg-yellow-500 text-black font-bold rounded-full text-2xl hover:bg-yellow-400 glow-effect">
                        ▶️ INICIAR DEMO
                    </button>
                </div>
            </div>
        </main>
        <!-- Stats Panel -->
        <aside class="w-80 p-6">
            <div class="stats-card rounded-2xl p-6 text-white">
                <h3 class="text-xl font-bold mb-6 text-center">📊 ESTADÍSTICAS</h3>
                <div class="space-y-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-400" id="wordsShown">0</div>
                        <div class="text-sm text-gray-300">Palabras Mostradas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-400" id="correctWords">0</div>
                        <div class="text-sm text-gray-300">Palabras Correctas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-400" id="accuracy">0%</div>
                        <div class="text-sm text-gray-300">Precisión</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-400" id="timeLeft">30</div>
                        <div class="text-sm text-gray-300">Tiempo Restante (seg)</div>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-3">
                        <div id="progressBar" class="bg-gradient-to-r from-pink-500 to-purple-500 h-3 rounded-full transition-all duration-300" style="width: 100%"></div>
                    </div>
                </div>
                <div class="mt-8 p-4 bg-black bg-opacity-30 rounded-lg">
                    <div class="text-center text-yellow-400 text-sm">
                        🎮 MODO DEMO
                    </div>
                    <div class="text-center text-gray-300 text-xs mt-1">
                        Regístrate para desbloquear todas las funciones
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <!-- Modal -->
    <div id="modal" class="fixed inset-0 modal hidden items-center justify-center z-50">
        <div class="glass-effect rounded-2xl p-8 m-4 max-w-md text-center relative">
            <button id="closeModal" class="absolute top-4 right-4 text-white text-2xl font-bold">X</button>
            <div class="text-6xl mb-4">🔒</div>
            <h3 class="text-2xl font-bold text-white mb-4">Función Bloqueada</h3>
            <p class="text-gray-200 mb-6">Este es un demo. Regístrate para una mejor experiencia y acceso a todas las funciones.</p>
            <button id="registerNow" class="px-8 py-3 bg-yellow-500 text-black font-bold rounded-full hover:bg-yellow-400 transition-all">
                Registrarse ahora
            </button>
        </div>
    </div>
    @vite(['resources/js/demo.js'])
</body>
</html>
