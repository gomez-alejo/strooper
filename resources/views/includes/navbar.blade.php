<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<nav class="fixed top-0 w-full z-50 nav-glass">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <div class="text-3xl font-bold">
                    <a href="{{ url('/home') }}" class="text-gradient">STROOPER</a>
                </div>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                @auth
                    <a href="{{ route('play') }}" class="text-white hover:text-yellow-300 transition-colors font-medium">
                        <i class="fas fa-gamepad mr-2"></i> Juego
                    </a>
                @endauth
                <a href="#levels" class="text-white hover:text-yellow-300 transition-colors font-medium">
                    <i class="fas fa-layer-group mr-2"></i> Niveles
                </a>
                <a href="#about" class="text-white hover:text-yellow-300 transition-colors font-medium">
                    <i class="fas fa-info-circle mr-2"></i> Acerca
                </a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Menú de usuario mejorado -->
                    <div class="relative" x-data="{ open: false }">
                        <!-- Botón del avatar -->
                        <button 
                            @click="open = !open"
                            @keydown.escape="open = false"
                            class="flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-full"
                            aria-haspopup="true"
                            :aria-expanded="open"
                        >
                            <div class="relative">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-500 to-blue-600 flex items-center justify-center text-white shadow-md">
                                    <i class="fas fa-user text-lg"></i>
                                </div>
                                <span class="absolute -bottom-1 -right-1 bg-green-500 rounded-full w-3 h-3 border-2 border-gray-800"></span>
                            </div>
                            <span class="text-white font-medium hidden md:inline-block">{{ Auth::user()->username }}</span>
                            <i 
                                class="fas fa-chevron-down text-xs text-gray-300 transition-transform duration-200"
                                :class="{ 'transform rotate-180': open }"
                            ></i>
                        </button>
                        
                        <!-- Menú desplegable -->
                        <div 
                            x-show="open"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 w-56 bg-gray-800 rounded-lg shadow-xl z-50 border border-gray-700 divide-y divide-gray-700 focus:outline-none"
                            style="display: none;"
                        >
                            <!-- Encabezado -->
                            <div class="px-4 py-3 bg-gray-900">
                                <p class="text-sm font-medium text-white flex items-center">
                                    <i class="fas fa-user-circle mr-2 text-blue-400"></i>
                                    {{ Auth::user()->username }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1 flex items-center">
                                    <i class="fas fa-envelope mr-2 text-blue-400"></i>
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            
                            <!-- Opciones del menú -->
                            <div class="py-1">
                                <a 
                                    href="{{ route('profile') }}" 
                                    class="flex items-center px-4 py-2 text-sm text-gray-200 hover:bg-gray-700 transition-colors"
                                    @click="open = false"
                                >
                                    <i class="fas fa-id-card mr-3 w-5 text-center text-blue-400"></i>
                                    Mi Perfil
                                </a>
                                <a 
                                    href="#" 
                                    class="flex items-center px-4 py-2 text-sm text-gray-200 hover:bg-gray-700 transition-colors"
                                    @click="open = false"
                                >
                                    <i class="fas fa-cog mr-3 w-5 text-center text-blue-400"></i>
                                    Configuración
                                </a>
                            </div>
                            
                            <!-- Cerrar sesión -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button 
                                    type="submit"
                                    class="w-full text-left flex items-center px-4 py-2 text-sm text-red-400 hover:bg-gray-700 hover:text-red-300 transition-colors"
                                    @click="open = false"
                                >
                                    <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Botones para usuarios no autenticados -->
                    <a href="{{ route('demo') }}" class="btn-secondary text-sm flex items-center hover:scale-105 transition-transform">
                        <i class="fas fa-play-circle mr-2"></i>
                        Demo
                    </a>
                    <a href="{{ route('login') }}" class="btn-primary text-sm flex items-center hover:scale-105 transition-transform">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar Sesión
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>