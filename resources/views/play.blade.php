<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strooper - Color Challenge Game</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css'])
    @vite(['resources/css/play.css'])
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
    </div>
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <div class="text-center py-8">
            <h1 class="text-6xl font-bold text-white mb-2" style="background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                STROOPER
            </h1>
            <p class="text-gray-300 text-xl">Color Challenge Game</p>
        </div>
        <!-- Main Content Area -->
        <div class="flex-1 flex items-center justify-center px-8">
            <!-- Mode Selection Screen -->
            <div id="modeSelection" class="text-center">
                <h2 class="text-4xl font-bold text-white mb-12 animate-pulse">
                    Seleccione el Modo de Juego
                </h2>
                <div class="flex gap-8 justify-center">
                    <button id="classicoBtn" class="game-button text-white px-12 py-6 rounded-2xl text-2xl font-bold glow">
                        🎮 CLÁSICO
                    </button>
                    <button id="competitivoBtn" class="game-button text-white px-12 py-6 rounded-2xl text-2xl font-bold glow">
                        ⚡ COMPETITIVO
                    </button>
                </div>
            </div>
            <!-- Countdown Screen -->
            <div id="countdownScreen" class="hidden text-center">
                <div id="countdownNumber" class="countdown">3</div>
                <p class="text-white text-2xl mt-4">¡Prepárate!</p>
            </div>
            <!-- Game Screen -->
            <div id="gameScreen" class="hidden w-full max-w-3xl">
                <!-- Exit Game Button -->
                <div class="flex justify-end mb-4">
                    <button id="exitGameBtn" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-bold transition-all duration-300 hover:scale-105">
                        ✕ Finalizar Juego
                    </button>
                </div>

                <!-- Game Stats -->
                <div class="grid grid-cols-4 gap-4 mb-8">
                    <div class="stat-card text-center">
                        <div class="text-white text-sm">Palabras</div>
                        <div id="wordsShown" class="text-2xl font-bold text-white">0</div>
                    </div>
                    <div class="stat-card text-center">
                        <div class="text-white text-sm">Correctas</div>
                        <div id="correctWords" class="text-2xl font-bold text-green-400">0</div>
                    </div>
                    <div class="stat-card text-center">
                        <div class="text-white text-sm">Precisión</div>
                        <div id="accuracy" class="text-2xl font-bold text-yellow-400">0%</div>
                    </div>
                    <div class="stat-card text-center">
                        <div class="text-white text-sm">Tiempo</div>
                        <div id="timeRemaining" class="text-2xl font-bold text-red-400">30s</div>
                    </div>
                </div>
                <!-- Progress Bar -->
                <div class="w-full bg-gray-700 rounded-full h-2 mb-8">
                    <div id="progressBar" class="progress-bar w-full"></div>
                </div>
                <!-- Word Display -->
                <div class="text-center mb-12">
                    <div id="currentWord" class="word-display text-white">ROJO</div>
                    <div class="word-timer-line mt-4">
                        <div id="wordTimerLineInner" class="word-timer-line-inner" style="width: 100%;"></div>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex gap-8 justify-center">
                    <button id="correctBtn" class="bg-green-500 hover:bg-green-600 text-white px-16 py-8 rounded-2xl text-3xl font-bold transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        ✓ CORRECTO
                    </button>
                    <button id="incorrectBtn" class="bg-red-500 hover:bg-red-600 text-white px-16 py-8 rounded-2xl text-3xl font-bold transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        ✗ INCORRECTO
                    </button>
                </div>
            </div>
        </div>
        <!-- Bottom Navigation -->
        <nav class="bottom-nav py-4">
            <div class="flex justify-center gap-16">
                <button id="homeBtn" class="nav-button text-white text-center px-6 py-3">
                    <a href="{{ url('/home') }}">                    <div class="text-3xl mb-1">🏠</div>
                    <div class="text-sm">Home</div></a>
                </button>
                <button id="configBtn" class="nav-button text-white text-center px-6 py-3">
                    <div class="text-3xl mb-1">⚙️</div>
                    <div class="text-sm">Configuración</div>
                </button>
                <button id="scoresBtn" class="nav-button text-white text-center px-6 py-3">
                    <div class="text-3xl mb-1">🏆</div>
                    <div class="text-sm">Puntajes</div>
                </button>
            </div>
        </nav>
    </div>
    <!-- Difficulty Modal -->
    <div id="difficultyModal" class="modal fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="modal-content rounded-2xl p-8 max-w-md w-full mx-4">
            <h3 class="text-3xl font-bold text-white text-center mb-8">Selecciona Dificultad</h3>
            <div class="space-y-4">
                <button class="difficulty-btn dios w-full py-4 rounded-xl text-white text-xl font-bold" data-level="dios">
                    🔥 DIOS (1 segundo)
                </button>
                <button class="difficulty-btn veterano w-full py-4 rounded-xl text-white text-xl font-bold" data-level="veterano">
                    ⚡ VETERANO (2 segundos)
                </button>
                <button class="difficulty-btn normal w-full py-4 rounded-xl text-white text-xl font-bold" data-level="normal">
                    🎮 NORMAL (3 segundos)
                </button>
            </div>
            <button id="closeDifficultyModal" class="w-full mt-6 bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-xl">
                Cancelar
            </button>
        </div>
    </div>
    <!-- Configuration Modal -->
    <div id="configModal" class="modal fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="modal-content rounded-2xl p-8 max-w-lg w-full mx-4">
            <h3 class="text-3xl font-bold text-white text-center mb-8">Configuración Clásica</h3>
            <div class="space-y-6 text-white">
                <div>
                    <label class="block text-sm font-bold mb-2">Duración del Juego (segundos)</label>
                    <input type="range" id="gameDuration" min="10" max="120" value="30" class="w-full">
                    <span id="durationValue" class="text-sm text-gray-300">30 segundos</span>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Tiempo por Palabra (segundos)</label>
                    <input type="range" id="wordTime" min="1" max="10" value="3" class="w-full">
                    <span id="wordTimeValue" class="text-sm text-gray-300">3 segundos</span>
                </div>
            </div>
            <div class="flex gap-4 mt-8">
                <button id="saveConfig" class="flex-1 game-button text-white py-3 rounded-xl font-bold">
                    Guardar
                </button>
                <button id="closeConfigModal" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-xl">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
    <!-- Results Modal -->
    <div id="resultsModal" class="modal fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="modal-content rounded-2xl p-6 max-w-lg w-full mx-4">
            <h3 class="text-3xl font-bold text-white text-center mb-6">🎯 Resultados de la Partida</h3>

            <!-- Game Mode Display -->
            <div class="text-center mb-4">
                <span id="gameModeDisplay" class="px-3 py-1 rounded-full text-sm font-bold" style="background: var(--gradient-primary);">
                    Modo Clásico
                </span>
            </div>
            <!-- Results Table -->
            <div class="bg-gray-800 rounded-xl p-4 mb-4">
                <table class="w-full text-white text-sm">
                    <tbody>
                        <tr class="border-b border-gray-600">
                            <td class="py-2 font-semibold">📊 Palabras Mostradas:</td>
                            <td class="py-2 text-right" id="finalWordsShown">0</td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <td class="py-2 font-semibold text-green-400">✅ Respuestas Correctas:</td>
                            <td class="py-2 text-right text-green-400" id="finalCorrectWords">0</td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <td class="py-2 font-semibold text-red-400">❌ Respuestas Incorrectas:</td>
                            <td class="py-2 text-right text-red-400" id="finalIncorrectWords">0</td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <td class="py-2 font-semibold text-yellow-400">🎯 Precisión:</td>
                            <td class="py-2 text-right text-yellow-400 text-lg font-bold" id="finalAccuracy">0%</td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <td class="py-2 font-semibold text-blue-400">⚡ Tiempo Promedio de Reacción:</td>
                            <td class="py-2 text-right text-blue-400" id="finalReactionTime">0ms</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-semibold text-purple-400">⏱️ Duración de la Partida:</td>
                            <td class="py-2 text-right text-purple-400" id="finalGameDuration">30s</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Performance Badge -->
            <div class="text-center mb-4">
                <div id="performanceBadge" class="inline-block px-4 py-2 rounded-full text-lg font-bold">
                    🏆 ¡Excelente!
                </div>
            </div>
            <!-- Social Sharing -->
            <div class="mb-4">
                <h4 class="text-white text-base font-bold mb-3 text-center">📱 Compartir en Redes Sociales</h4>
                <div class="flex gap-3 justify-center">
                    <button id="shareFacebook" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold transition-all duration-300 hover:scale-105 flex items-center gap-2 text-sm">
                        📘 Facebook
                    </button>
                    <button id="shareTwitter" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg font-bold transition-all duration-300 hover:scale-105 flex items-center gap-2 text-sm">
                        🐦 Twitter
                    </button>
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button id="playAgainBtn" class="flex-1 game-button text-white py-3 rounded-xl text-base font-bold">
                    🔄 Jugar de Nuevo
                </button>
                <button id="backToMenuBtn" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-xl text-base font-bold transition-all duration-300">
                    🏠 Menú Principal
                </button>
            </div>
        </div>
    </div>
    <!-- Scores Modal -->
    <div id="scoresModal" class="modal fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="modal-content rounded-2xl p-8 max-w-2xl w-full mx-4">
            <h3 class="text-3xl font-bold text-white text-center mb-8">🏆 Puntajes</h3>
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <h4 class="text-xl font-bold text-white mb-4">Individuales</h4>
                    <div id="individualScores" class="space-y-2 text-white">
                        <!-- Scores will be populated here -->
                    </div>
                </div>
                <div>
                    <h4 class="text-xl font-bold text-white mb-4">Globales</h4>
                    <div id="globalScores" class="space-y-2 text-white">
                        <!-- Global scores will be populated here -->
                    </div>
                </div>
            </div>
            <button id="closeScoresModal" class="w-full mt-8 bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-xl">
                Cerrar
            </button>
        </div>
    </div>
    @vite(['resources/js/play.js'])
</body>
</html>