if (navigator.geolocation) {
    const location_timeout = setTimeout(() => geolocFail(), 10000);

    navigator.geolocation.getCurrentPosition(
        (position) => {
            clearTimeout(location_timeout);

            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            updateWhatsapplink(lat, lng);
            geocodeLatLng(lat, lng);

            initMap(lat, lng);

            const pet_id = document.getElementById('pet_id').value;
            const qr_identifier = document.getElementById('locator').value;
            const petName = document.getElementById('pet_name').value;
            const email = document.getElementById('email').value;
            const baseUrl = 'https://rastreopet.com/';
            return;
            $.ajax({
                url: baseUrl + "position/save",
                type: "POST",
                dataType: "json",
                data: {
                    lat:  lat,
                    long: lng,
                    pet_id: pet_id,
                    qr_identifier: qr_identifier,
                    pet_name : petName,
                    email: email
                },
                success: function(data) {
                    console.log('Datos almacenados');
                },
                error: function(xhr, status, error) {
                    console.log('Datos no guardados');
                }
            });


        },
        (error) => {
            clearTimeout(location_timeout);
            if (error.code === 1) {
                // El usuario denegó el permiso, solicitar permiso nuevamente
                requestGeolocationPermission();
            } else {
                geolocFail();
            }
        }
    );
} else {
    // Fallback for no geolocation
    requestGeolocationPermission();
    geolocFail();
}

const updateWhatsapplink = (lat, long) => {
    const currentWhatsappLink = document.getElementById('whatsapp-link');
    if (currentWhatsappLink) {
        const currentText = currentWhatsappLink.href;
        currentWhatsappLink.href += " en la siguiente ubicacion: https://www.google.com/maps?q=" + lat + "," + long + "&z=10";
    }
}
const requestGeolocationPermission = () => {
    if (navigator.permissions) {
        navigator.permissions.query({name: 'geolocation'}).then((permissionStatus) => {
            if (permissionStatus.state === 'granted') {
                // Permiso concedido
                location.reload(); // Recargar la página para obtener la ubicación
            } else {
                permissionStatus.query().then((result) => {
                    if (result.state === 'granted') {
                        location.reload();
                    } else {
                        geolocFail();
                    }
                });
            }
        });
    } else {
        // No es compatible con navigator.permissions, manejar el error
        geolocFail();
    }
};

const geolocFail = () => {
    // Manejar el error cuando la geolocalización no está disponible o el permiso es denegado
    console.log("No se pudo obtener la ubicación.");
};

const geocodeLatLng = (lat, lng) => {
    // Realiza la geocodificación inversa para obtener la dirección basada en las coordenadas
    // Aquí puedes agregar tu propia lógica para procesar las coordenadas
};

let map;



const initMap = async (lat, lng) => {
    // The location of Uluru
    const position = {lat: lat, lng: lng};
    // Request needed libraries.
    //@ts-ignore
    const {Map} = await google.maps.importLibrary("maps");

    // The map, centered at Uluru
    map = new Map(document.getElementById("map"), {
        zoom: 16,
        center: position,
        mapId: "DEMO_MAP_ID",
    });

    const petPictureElement = document.getElementById('small-image');
    const originalImageUrl = petPictureElement.src;

    // Ensure square image dimensions
    const img = new Image();
    img.onload = () => {
        const squareSize = Math.min(img.width, img.height);

        const canvas = document.createElement('canvas');
        canvas.width = squareSize;
        canvas.height = squareSize;
        const context = canvas.getContext('2d');

        // Draw image centered, preserving aspect ratio
        context.drawImage(img, (squareSize - img.width) / 2, (squareSize - img.height) / 2);

        // Apply circular clipping path
        context.beginPath();
        context.arc(squareSize / 2, squareSize / 2, squareSize / 2, 0, 2 * Math.PI);
        context.clip();

        const imageData = canvas.toDataURL('image/png');

        // Create marker with the clipped image as the icon
        var marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: {
               // url: imageData,
                path: google.maps.SymbolPath.CIRCLE,
                scale: 5,
                fillColor: 'purple',
                fillOpacity: 0.7,
                strokeWeight: 1,
                strokeColor: '#000'
                // scaledSize: new google.maps.Size(12, 12),
                //origin: new google.maps.Point(0, 0),
                //anchor: new google.maps.Point(0, 0)
            },
            title: 'PERRITO O GATICO'
        });
    };
    img.src = originalImageUrl;
};
