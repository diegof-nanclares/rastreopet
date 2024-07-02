Rastreo Pet
Este proyecto tiene como objetivo la implementación de una aplicación que permite localizar una mascota dado un código QR único que identifica el localizador de esta
El proyecto también permite el recolectar información sobre la mascota para el uso al momento de intentar localizarla

Tecnologías utilizadas
PHP 7.4
MySQL 8.0
HTML 5
CSS 3
JavaScript


Instalación
Para instalar la aplicación, siga los siguientes pasos:

Clonar este repositorio en su máquina local: 
Configurar la base de datos y las credenciales de acceso en el archivo config.php.
Ejecutar el archivo database.sql para crear la estructura de la base de datos.
Abrir la aplicación en su navegador.
Uso
La aplicación consta de las siguientes funcionalidades:
TODO descriptions


Contribución
Si desea contribuir al proyecto, puede hacerlo de la siguiente manera:

Crear una rama a partir de la rama develop.
Implementar sus cambios y realizar pruebas unitarias.
Crear una solicitud de cambios a la rama develop.
Esperar la revisión y aprobación del código por parte del equipo de desarrollo.

Autores
Diego Salazar

Licencia
N/A

ruta para probar el qr
http://192.168.1.2/checkqrstatus/?qrid=cXI2NDczZDhjOWM2YTBm

https://fps.local.com/checkqrstatus/?qrid=cXI2NDczZDhjOWM2YTBm


Activated flow
https://rastreopet.com/qr/activated/?qrId=cXI2NGRkMDk4YzRjZTI3

Files to change IP, development purposes
view_public_pet_information.css
font_face.css


Installation

- Remember to adjust upload_max_filesize = 20M


Clear bd
delete from findpetsmart.pet
SELECT * FROM findpetsmart.user;
SELECT * FROM findpetsmart.qr_locator;

// Check qr status
// http://192.168.1.2/checkqrstatus/?qrid=cXI2NDczZDhjOWM2YTBm

Local Clearing
set sql_safe_updates = 0;
delete from  findpetsmart.pet;
delete from  findpetsmart.position_track_history;
delete from  findpetsmart.qr_locator;
delete from  findpetsmart.user where entity_id <> 1;

TO DO
Deployment notes
Locally
set sql_safe_updates = 0;
delete from  findpetsmart.pet;
delete from  findpetsmart.position_track_history;
delete from  findpetsmart.qr_locator;
delete from  findpetsmart.user where entity_id <> 1;

Clear Test Data
rm -rf public/static/img/locators/*
rm -rf public/static/img/pet/profile/*
rm -rf app/lib/phpqrcode/*errors.txt

Note: Remember to update domain before deploying ---


