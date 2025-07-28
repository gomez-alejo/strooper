@extends('layouts.app')

@section('title', 'Strooper - home')

@vite(['resources/css/style.css'])
@vite(['resources/css/home.css'])


@section('content')
    <!-- Game Trial Modal -->
    <div id="gameModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <!-- Game Interface -->
            <div id="gameInterface" class="text-center">
                <div class="mb-6">
                    <div class="text-sm text-gray-600 mb-2">Tiempo restante</div>
                    <div id="timeRemaining" class="text-3xl font-bold text-purple-600">30s</div>
                </div>
                <div class="bg-gray-100 rounded-xl p-8 mb-6 min-h-[200px] flex items-center justify-center">
                    <div id="gameArea" class="text-center">
                        <div id="wordDisplay" class="text-6xl font-black mb-6" style="color: #000;">PREPARADO?</div>
                        <div class="text-gray-600 mb-6">Presiona INICIAR cuando estés listo</div>
                        <button id="startGameBtn" class="bg-green-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-green-600 transition-colors">
                            INICIAR JUEGO
                        </button>
                    </div>
                </div>
                <!-- Game Buttons (Hidden initially) -->
                <div id="gameButtons" class="hidden space-y-4">
                    <div class="text-lg font-semibold text-gray-700 mb-4">¿El texto coincide con el color?</div>
                    <div class="flex gap-4 justify-center">
                        <button id="correctBtn" class="bg-green-500 text-white px-8 py-4 rounded-lg font-bold hover:bg-green-600 transition-all transform hover:scale-105">
                            ✅ CORRECTO
                        </button>
                        <button id="incorrectBtn" class="bg-red-500 text-white px-8 py-4 rounded-lg font-bold hover:bg-red-600 transition-all transform hover:scale-105">
                            ❌ INCORRECTO
                        </button>
                    </div>
                </div>
                <!-- Live Stats -->
                <div class="mt-6 grid grid-cols-3 gap-4 text-center">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="text-sm text-gray-600">Palabras</div>
                        <div id="modalWordsShown" class="text-xl font-bold">0</div>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="text-sm text-gray-600">Correctas</div>
                        <div id="modalCorrectAnswers" class="text-xl font-bold text-green-600">0</div>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="text-sm text-gray-600">Precisión</div>
                        <div id="modalAccuracy" class="text-xl font-bold text-blue-600">0%</div>
                    </div>
                </div>
            </div>
            <!-- Game Results (Hidden initially) -->
            <div id="gameResults" class="text-center hidden">
                <div class="text-4xl mb-4">🎉</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">¡Juego Terminado!</h3>
                <div class="space-y-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="text-lg font-semibold text-gray-700">Tu Resultado</div>
                        <div class="grid grid-cols-2 gap-4 mt-3">
                            <div>
                                <div class="text-sm text-gray-600">Palabras Mostradas</div>
                                <div id="finalWordsShown" class="text-2xl font-bold">0</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Respuestas Correctas</div>
                                <div id="finalCorrectAnswers" class="text-2xl font-bold text-green-600">0</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Precisión Final</div>
                                <div id="finalAccuracy" class="text-2xl font-bold text-blue-600">0%</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Tiempo Promedio</div>
                                <div id="averageTime" class="text-2xl font-bold text-purple-600">0s</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <button id="playAgainBtn" class="flex-1 bg-purple-500 text-white py-3 rounded-lg font-bold hover:bg-purple-600 transition-colors">
                        Jugar de Nuevo
                    </button>
                    <button id="closeResultsBtn" class="flex-1 bg-gray-500 text-white py-3 rounded-lg font-bold hover:bg-gray-600 transition-colors">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section -->
    <section class="gradient-bg min-h-screen flex items-center relative overflow-hidden">
        <!-- Floating Shapes -->
        <div class="absolute top-20 left-10 floating-animation">
            <div class="w-16 h-16 bg-yellow-400 rounded-full opacity-20"></div>
        </div>
        <div class="absolute top-40 right-20 floating-animation-delayed">
            <div class="w-12 h-12 bg-blue-400 rounded-lg opacity-20"></div>
        </div>
        <div class="absolute bottom-40 left-20 floating-animation-delayed-2">
            <div class="w-20 h-20 bg-orange-400 rounded-full opacity-20"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-white space-y-8 slide-in-left">
                    <div class="space-y-4">
                        <p class="text-yellow-300 font-semibold text-lg tracking-wide uppercase">¡Desafía tu mente!</p>
                        <h1 class="text-6xl lg:text-7xl font-black leading-tight">
                            RETA TU
                            <span class="block text-yellow-300">PERCEPCIÓN</span>
                            <span class="block">VISUAL</span>
                        </h1>
                    </div>
                    <p class="text-xl lg:text-2xl text-gray-100 leading-relaxed">
                        Prueba la famosa prueba de Stroop y descubre qué tan rápido puedes identificar cuando el nombre de un color coincide con el color del texto.
                    </p>
                    <!-- En la sección Hero -->
                <div class="flex flex-col sm:flex-row gap-4">
                @auth
                <a href="{{ route('play') }}" class="btn-primary text-lg px-8 py-4">
                🎮 JUGAR AHORA
                        </a>
                @else
                        <a href="{{ route('register') }}" class="btn-primary text-lg px-8 py-4">
                            🎮 JUGAR AHORA
                        </a>
                    @endauth
                    <button id="startTrialBtn" class="btn-secondary text-lg px-8 py-4">
                        Ver Demo
                        </button>
                </div>

                    <div class="flex items-center space-x-4 text-sm">
                        <span>Colores disponibles:</span>
                        <div class="flex space-x-2">
                            <div class="color-demo bg-yellow-400"></div>
                            <div class="color-demo bg-blue-500"></div>
                            <div class="color-demo bg-orange-500"></div>
                            <div class="color-demo bg-red-500"></div>
                            <div class="color-demo bg-green-500"></div>
                            <div class="color-demo bg-purple-500"></div>
                            <div class="color-demo bg-gray-800"></div>
                        </div>
                    </div>
                </div>
                <div class="slide-in-right">
                    <div class="relative">
                        <div class="bg-white rounded-3xl p-8 shadow-2xl mx-auto max-w-md">
                            <div class="text-center space-y-6">
                                <div class="text-6xl">🧠</div>
                                <h3 class="text-2xl font-bold text-gray-800">Prueba Gratuita</h3>
                                <p class="text-gray-600">30 segundos de diversión intensa. ¿Estás listo para el desafío?</p>
                                    <div class="space-y-4">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Palabras mostradas:</span>
                                            <span id="wordsShown" class="font-bold">0</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Respuestas correctas:</span>
                                            <span id="correctAnswers" class="font-bold text-green-600">0</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Precisión:</span>
                                            <span id="accuracy" class="font-bold text-blue-600">0%</span>
                                        </div>
                                    </div>
                                <button id="startTrialBtn" class="w-full bg-gradient-to-r from-pink-500 to-purple-600 text-white py-3 rounded-lg font-bold hover:shadow-lg transition-all">
                                    COMENZAR
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Levels Section -->
    <section id="levels" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 slide-in-up">
                <h2 class="text-5xl font-black text-gray-800 mb-4">
                    ELIGE TU <span class="text-gradient">NIVEL</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Cada nivel tiene su propio ritmo y desafío. Desde principiante hasta experto, encuentra tu nivel perfecto.
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Normal Level -->
                <div class="level-card card-hover slide-in-up" style="animation-delay: 0.2s;">
                    <div class="emoji">🌱</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">NIVEL NORMAL</h3>
                    <div class="space-y-4">
                        <div class="text-4xl font-black text-green-500">3s</div>
                        <p class="text-gray-600">Tiempo por palabra</p>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p>✅ Perfecto para principiantes</p>
                            <p>✅ Tiempo cómodo para pensar</p>
                            <p>✅ Ideal para aprender</p>
                        </div>
                        <button class="w-full bg-green-500 text-white py-2 rounded-lg font-bold hover:bg-green-600 transition-colors">
                            Jugar Normal
                        </button>
                    </div>
                </div>
                <!-- Veteran Level -->
                <div class="level-card card-hover slide-in-up" style="animation-delay: 0.4s;">
                    <div class="emoji">⚡</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">NIVEL VETERANO</h3>
                    <div class="space-y-4">
                        <div class="text-4xl font-black text-orange-500">2s</div>
                        <p class="text-gray-600">Tiempo por palabra</p>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p>🔥 Para jugadores experimentados</p>
                            <p>🔥 Requiere concentración</p>
                            <p>🔥 Desafío moderado</p>
                        </div>
                        <button class="w-full bg-orange-500 text-white py-2 rounded-lg font-bold hover:bg-orange-600 transition-colors">
                            Jugar Veterano
                        </button>
                    </div>
                </div>
                <!-- God Level -->
                <div class="level-card card-hover slide-in-up" style="animation-delay: 0.6s;">
                    <div class="emoji">👑</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">NIVEL DIOS</h3>
                    <div class="space-y-4">
                        <div class="text-4xl font-black text-red-500">1s</div>
                        <p class="text-gray-600">Tiempo por palabra</p>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p>⚡ Solo para expertos</p>
                            <p>⚡ Reflexes ultrarrápidos</p>
                            <p>⚡ Máximo desafío</p>
                        </div>
                        <button class="w-full bg-red-500 text-white py-2 rounded-lg font-bold hover:bg-red-600 transition-colors">
                            Jugar Dios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section id="about" class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="slide-in-left">
                    <h2 class="text-5xl font-black text-gray-800 mb-6">
                        ¿QUÉ ES EL <span class="text-gradient">EFECTO STROOP</span>?
                    </h2>
                    <div class="space-y-6 text-lg text-gray-600">
                        <p>
                            El efecto Stroop es un fenómeno psicológico descubierto por John Ridley Stroop en 1935.
                            Demuestra cómo nuestro cerebro procesa la información de manera automática.
                        </p>
                        <p>
                            Cuando vemos la palabra "AZUL" escrita en color rojo, nuestro cerebro experimenta un
                            conflicto entre leer la palabra y identificar el color, lo que causa una pequeña demora
                            en la respuesta.
                        </p>
                        <p>
                            Este juego te ayuda a entrenar tu concentración, velocidad de procesamiento y control
                            de impulsos mientras te diviertes.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-4 mt-8">
                        <div class="bg-white px-6 py-3 rounded-full shadow-md">
                            <span class="font-bold text-gray-800">🧠 Entrena tu cerebro</span>
                        </div>
                        <div class="bg-white px-6 py-3 rounded-full shadow-md">
                            <span class="font-bold text-gray-800">⚡ Mejora tus reflejos</span>
                        </div>
                        <div class="bg-white px-6 py-3 rounded-full shadow-md">
                            <span class="font-bold text-gray-800">🎯 Aumenta tu concentración</span>
                        </div>
                    </div>
                </div>
                <div class="slide-in-right">
                    <div class="bg-white rounded-3xl p-8 shadow-2xl">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Ejemplo del Juego</h3>
                        <div class="space-y-6">
                            <div class="text-center p-6 bg-gray-50 rounded-xl">
                                <div class="text-4xl font-black mb-4" style="color: #EF4444;">VERDE</div>
                                <p class="text-gray-600">¿El texto coincide con el color?</p>
                                <div class="flex gap-4 mt-4 justify-center">
                                    <button class="bg-red-500 text-white px-6 py-2 rounded-lg font-bold">❌ INCORRECTO</button>
                                    <button class="bg-green-500 text-white px-6 py-2 rounded-lg font-bold">✅ CORRECTO</button>
                                </div>
                            </div>
                            <div class="text-center text-sm text-gray-500">
                                En este caso, la respuesta correcta sería <strong>INCORRECTO</strong>
                                porque la palabra "VERDE" está escrita en color rojo.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 slide-in-up">
                <h2 class="text-5xl font-black text-gray-800 mb-4">
                    CARACTERÍSTICAS DEL <span class="text-gradient">JUEGO</span>
                </h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center slide-in-up" style="animation-delay: 0.1s;">
                    <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">⏱️</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tiempo Real</h3>
                    <p class="text-gray-600">Seguimiento en tiempo real de tu progreso y estadísticas</p>
                </div>
                <div class="text-center slide-in-up" style="animation-delay: 0.2s;">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🏆</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Puntuaciones</h3>
                    <p class="text-gray-600">Sistema local de puntuaciones más altas y logros</p>
                </div>
                <div class="text-center slide-in-up" style="animation-delay: 0.3s;">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">⚙️</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Personalizable</h3>
                    <p class="text-gray-600">Configura tiempos, duración y colores según tu preferencia</p>
                </div>
                <div class="text-center slide-in-up" style="animation-delay: 0.4s;">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">📱</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Compartir</h3>
                    <p class="text-gray-600">Comparte tus resultados en redes sociales</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to Action -->
    <section class="gradient-bg py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center slide-in-up">
            <h2 class="text-5xl font-black text-white mb-6">
                ¿LISTO PARA EL <span class="text-yellow-300">DESAFÍO</span>?
            </h2>
            <p class="text-xl text-gray-100 mb-8 max-w-2xl mx-auto">
                Únete a miles de jugadores que ya están entrenando su cerebro.
                Comienza ahora y descubre qué tan rápido puedes pensar.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="btn-primary text-xl px-12 py-5">
                    🚀 EMPEZAR AHORA
                </button>
                <button class="btn-secondary text-xl px-12 py-5">
                    Ver Tutorial
                </button>
            </div>
        </div>
    </section>
    @vite(['resources/js/home.js'])
@endsection