<?php
/**
 * @var $message;
 */

?>
<div id="video-container">
    <video  autoplay muted loop id="background-video">
        <source src="https://rastreopet.com/public/static/video/background-video.mp4" type="video/mp4">
        Tu navegador no admite la reproducción de videos HTML5.
    </video>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card">
                <div class="card-body">
                    <img src="https://rastreopet.com/public/static/img/logos/rastreopet_black.png" alt="Rastreo Pet" class="img-fluid logo">
                    <form action="" method="POST">
                        <div class="form-group">

                            <input type="email" class="form-control" id="user" name="user" required placeholder="Tu email registrado">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" required name="password" placeholder="Tu contraseña">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                    </form>
                    <div class="text-center mt-3 email-recover">
                        <a href="#" onclick="modalShowMessageSendAjaxInput('Ingresa tu email para recuperar tu contraseña.', 'Verificar', '/')">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div class="text-center mt-1">
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=573043411949&text=Hola, necesito ayuda para ingresar a mi cuenta de RastreoPet" ">Tienes problemas? contáctanos dando clik aquí</a>
                    </div>
                    <div class="text-center mt-1 request-qr-locator">
                        <a href="https://api.whatsapp.com/send?phone=573043411949&text=Hola,%20me%20interesa%20adquirir%20mi%20placa%20localizadora%20de%20macotas%20🐶🐱%20Puedes%20brindarme%20más%20información?" target="_blank">Solicita tu placa Localizadora aquí</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(!empty($message)): ?>
    <script>
        showMessage('Atención', '<?= $message ?>', 'error');
    </script>
<?php endif; ?>
