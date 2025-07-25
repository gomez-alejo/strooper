<nav class="fixed top-0 w-full z-50 nav-glass">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <div class="text-3xl font-bold">
                    <span class="text-gradient">STROOPER</span>
                </div>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/play') }}" class="text-white hover:text-yellow-300 transition-colors font-medium">
                    <i class="fas fa-gamepad nav-icon"></i> Juego
                </a>
                <a href="#levels" class="text-white hover:text-yellow-300 transition-colors font-medium">
                    <i class="fas fa-layer-group nav-icon"></i> Niveles
                </a>
                <a href="#about" class="text-white hover:text-yellow-300 transition-colors font-medium">
                    <i class="fas fa-info-circle nav-icon"></i> Acerca
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <button class="btn-secondary text-sm">
                    <i class="fas fa-play nav-icon"></i> <a href="{{ url('/demo') }}">Demo</a>
                </button>
                @guest
                    <button class="btn-primary text-sm">
                        <i class="fas fa-sign-in-alt"></i> <a href="{{ url('/login') }}">Iniciar Sesión</a>
                    </button>
                @else
                    <a href="{{ route('profile') }}" class="text-white">
                        <i class="fas fa-user-circle text-2xl"></i>
                    </a>
                @endguest
            </div>
        </div>
    </div>
</nav>