modalShowMessageSendAjaxInput = (title, textButton, ajaxurl) => {
    swal({
        text: title,
        content: "input",
        button: {
            text: textButton,
            closeModal: false,
        },
    })
        .then(email => {
            if (!email) {
                 swal("Ingresa una dirección de email");
                 throw null;
            }

            return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
        })
        .then(results => {
            return results.json();
        })
        .then(json => {
            const movie = json.results[0];

            if (!movie) {
                return swal("No hay ninguna cuenta asociada a este email, por favor crea una e inicia sesión !");
            }

            const name = movie.trackName;
            const imageURL = movie.artworkUrl100;

            swal({
                title: "Top result:",
                text: name,
                icon: imageURL,
            });
        })
        .catch(err => {
            if (err) {
                swal("Oh no!", "Hubo un error, si persiste comunicate con el administrador", "error");
            } else {
                swal.stopLoading();
                swal.close();
            }
        });
}
