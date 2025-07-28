document.addEventListener('DOMContentLoaded', function() {
    // Animaciones de entrada
    const elements = document.querySelectorAll('.slide-in, .bounce-in');
    elements.forEach(el => {
        el.style.opacity = '1';
        el.style.transform = 'translateY(0)';
    });

    // Mostrar/ocultar campos de contraseña
    const showPasswordButtons = document.querySelectorAll('.show-password');
    showPasswordButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });

    // Previsualización del avatar
    const avatarInput = document.querySelector('input[name="avatar"]');
    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.querySelector('.avatar-preview');
                    if (preview) {
                        preview.src = event.target.result;
                    } else {
                        const avatarContainer = document.querySelector('.avatar-container');
                        avatarContainer.innerHTML = `
                            <img src="${event.target.result}" 
                                 class="w-32 h-32 rounded-full profile-image object-cover avatar-preview">
                        `;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
});

function confirmDelete() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}




























































        // // Funciones de navegación
        // function goHome() {
        //     // Animación de salida
        //     document.body.style.opacity = '0';
        //     document.body.style.transform = 'scale(0.95)';
        //     setTimeout(() => {
        //         alert('Navegando al Home...');
        //         // Aquí se redirigiría a la página principal
        //     }, 300);
        // }

        // function startGame() {
        //     // Animación de salida
        //     document.body.style.opacity = '0';
        //     document.body.style.transform = 'scale(0.95)';
        //     setTimeout(() => {
        //         alert('Iniciando juego...');
        //         // Aquí se redirigiría al juego
        //     }, 300);
        // }

        // // Funciones de edición
        // function editName() {
        //     const newName = prompt('Ingresa tu nuevo nombre:');
        //     if (newName) {
        //         // Aquí se actualizaría en la base de datos
        //         alert('Nombre actualizado correctamente');
        //         location.reload();
        //     }
        // }

        // function editEmail() {
        //     const newEmail = prompt('Ingresa tu nuevo email:');
        //     if (newEmail) {
        //         alert('Email actualizado correctamente');
        //         location.reload();
        //     }
        // }

        // function editLevel() {
        //     const levels = ['Normal', 'Veterano', 'Dios'];
        //     const choice = prompt('Elige tu nivel favorito:\n1. Normal\n2. Veterano\n3. Dios');
        //     if (choice && choice >= 1 && choice <= 3) {
        //         alert(`Nivel favorito cambiado a: ${levels[choice-1]}`);
        //         location.reload();
        //     }
        // }

        // // Funciones de gestión de cuenta
        // function changePassword() {
        //     const currentPassword = prompt('Ingresa tu contraseña actual:');
        //     if (currentPassword) {
        //         const newPassword = prompt('Ingresa tu nueva contraseña:');
        //         if (newPassword) {
        //             alert('Contraseña actualizada correctamente');
        //         }
        //     }
        // }

        // function exportData() {
        //     alert('Descargando datos del usuario...');
        //     // Aquí se generaría y descargaría un archivo con los datos
        // }

        // function logout() {
        //     if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
        //         document.body.style.opacity = '0';
        //         setTimeout(() => {
        //             alert('Sesión cerrada correctamente');
        //             // Aquí se redirigiría al login
        //         }, 300);
        //     }
        // }

        // function deleteAccount() {
        //     if (confirm('⚠️ ¿Estás seguro de que quieres eliminar tu cuenta?\n\nEsta acción es IRREVERSIBLE y perderás todos tus datos.')) {
        //         const confirmation = prompt('Escribe "ELIMINAR" para confirmar:');
        //         if (confirmation === 'ELIMINAR') {
        //             alert('Cuenta eliminada correctamente');
        //             // Aquí se eliminaría la cuenta
        //         }
        //     }
        // }

        // // Animaciones al cargar
        // window.addEventListener('load', () => {
        //     document.body.style.opacity = '1';
        //     document.body.style.transform = 'scale(1)';
        // });

        // // Efectos de paralaje suaves
        // document.addEventListener('mousemove', (e) => {
        //     const floatingElements = document.querySelectorAll('.floating-animation');
        //     const mouseX = e.clientX / window.innerWidth;
        //     const mouseY = e.clientY / window.innerHeight;

        //     floatingElements.forEach((element, index) => {
        //         const speed = 0.5 + (index * 0.2);
        //         const x = (mouseX - 0.5) * speed * 20;
        //         const y = (mouseY - 0.5) * speed * 20;
        //         element.style.transform = `translate(${x}px, ${y}px)`;
        //     });
        // });

        // // Intersection Observer para animaciones al scroll
        // const observer = new IntersectionObserver((entries) => {
        //     entries.forEach(entry => {
        //         if (entry.isIntersecting) {
        //             entry.target.style.opacity = '1';
        //             entry.target.style.transform = 'translateY(0)';
        //         }
        //     });
        // });

        // document.querySelectorAll('.slide-in, .bounce-in').forEach(el => {
        //     observer.observe(el);
        // });
