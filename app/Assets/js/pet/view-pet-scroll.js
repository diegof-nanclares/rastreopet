function screenScrollEvents() {
    window.addEventListener('scroll', function () {
        var foto = document.querySelector('.foto-efecto');
        var backgroud = document.querySelector('.background-header');
        var scrollPos = window.scrollY || window.scrollTop || document.getElementsByTagName("html")[0].scrollTop;

        // Aplicar el nuevo tamaño al contenedor y la imagen
        if (scrollPos > 100) {
            foto.classList.add('scroll');
            backgroud.classList.add('scroll');
        } else {
            foto.classList.remove('scroll');
            backgroud.classList.remove('scroll');
        }
    });
}

screenScrollEvents();
