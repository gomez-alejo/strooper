
        // Particles Animation
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            
            function createParticle() {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                const size = Math.random() * 4 + 2;
                const startPosition = Math.random() * window.innerWidth;
                const duration = Math.random() * 3 + 2;
                
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = startPosition + 'px';
                particle.style.animationDuration = duration + 's';
                
                particlesContainer.appendChild(particle);
                
                setTimeout(() => {
                    if (particle.parentNode) {
                        particle.parentNode.removeChild(particle);
                    }
                }, duration * 1000);
            }
            
            setInterval(createParticle, 300);
        }

        // Modal functionality
        const registerBtn = document.getElementById('registerBtn');
        const registerModal = document.getElementById('registerModal');
        const cancelRegister = document.getElementById('cancelRegister');

        registerBtn.addEventListener('click', () => {
            registerModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        cancelRegister.addEventListener('click', () => {
            registerModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });

        registerModal.addEventListener('click', (e) => {
            if (e.target === registerModal) {
                registerModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });



        // Initialize animations
        createParticles();

        // Add hover effects to buttons
        document.querySelectorAll('.game-button').forEach(button => {
            button.addEventListener('mouseenter', () => {
                button.style.transform = 'translateY(-3px) scale(1.05)';
            });
            
            button.addEventListener('mouseleave', () => {
                button.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add focus effects to inputs
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.style.transform = 'scale(1)';
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !registerModal.classList.contains('hidden')) {
                registerModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });

        // Add dynamic background colors
        setInterval(() => {
            const colors = ['--primary-pink', '--primary-purple', '--accent-blue'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            document.documentElement.style.setProperty('--dynamic-color', `var(${randomColor})`);
        }, 5000);
