const smallImage = document.getElementById('small-image');
const largeImage = document.getElementById('large-image');
const overlay = document.getElementById('zoom-overlay');

// Agregar un evento de clic a la imagen pequeña
smallImage.addEventListener('click', () => {
    // Aplicar el efecto de zoom
    smallImage.style.display = 'none';
    largeImage.style.opacity = '1';
    overlay.style.display = 'block';
});

// Agregar un evento de clic al contenedor para deshacer el zoom cuando se hace clic en la imagen grande
overlay.addEventListener('click', () => {
    overlay.style.display = 'none';
    largeImage.style.opacity = '0';
    smallImage.style.display = 'block';
});
