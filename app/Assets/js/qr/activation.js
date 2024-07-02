swal("Has Activado correctamente el localizador de tu mascota", "" +
    "Cuando el localizador de tu mascota sea escaneado por alguien, la aplicación te mandará  una alerta al correo que registraste" +
    " y mostrará a esa persona la información necesaria para contactarte." +
    " Para administrar tu información y la de tu peludito(a) puedes ingresar con tu correo y contraseña  en la dirección https://rastreopet.com, a la que serás redirigido en un momento... "
    , "success")
    .then((value) => {
        window.location.href = "https://rastreopet.com/";
    });
