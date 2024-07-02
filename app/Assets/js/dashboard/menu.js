const menuToggle = document.querySelector('.menu-toggle');
const sidebar = document.querySelector('.sidebar');
const mainLogo = $('.main-logo');

let menuOpen = false;

menuToggle.addEventListener('click', () => {
    if (!menuOpen) {
        sidebar.classList.add('active');
        menuOpen = true;

        // Agregar un event listener para cerrar el menú después de un breve retraso
        setTimeout(() => {
            document.addEventListener('click', closeMenuOnClickOutside);
        }, 100);
        mainLogo.fadeIn('slow');
    } else {
        closeMenu();
    }
});

function closeMenu() {
    sidebar.classList.remove('active');
    menuOpen = false;

    // Eliminar el event listener para cerrar el menú
    document.removeEventListener('click', closeMenuOnClickOutside);
    mainLogo.fadeOut('fast');
}

function closeMenuOnClickOutside(event) {
    if (!sidebar.contains(event.target) && event.target !== menuToggle) {
        closeMenu();
    }
}
