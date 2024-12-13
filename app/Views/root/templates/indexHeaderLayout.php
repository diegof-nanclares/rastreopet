<?php
/**
 * @var $styles
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="icon" href="https://rastreopet.com/public/static/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="https://rastreopet.com/public/static/img/favicon/favicon.ico" type="image/x-icon">
    <link href="https://fonts.cdnfonts.com/css/jomhuria" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/jost" rel="stylesheet">
    <title>Rastreo Pet</title>
    <!-- Styles-->
    <?php
    if(isset($styles) &&  is_array($styles)):
        foreach ($styles as $stylesheet):?>
            <link rel="stylesheet" href="<?= $stylesheet?>">
        <?php endforeach; endif; ?>

    <?php  if(isset($js) &&  is_array($js)):
        foreach ($js as $script):?>
            <script src="<?= $script?>"></script>
        <?php endforeach; endif; ?>
    <style>
        @import url('https://fonts.cdnfonts.com/css/jomhuria');
        @import url('https://fonts.cdnfonts.com/css/jost');
    </style>
</head>
<body>
<header>
    <nav>
        <ul>
            <!-- TOD make a header -->
        </ul>
    </nav>
</header>

<script>
    document.addEventListener('touchstart', function(event) {
        if (event.touches.length > 1) {
            // Si hay más de un dedo tocando la pantalla, no hacer zoom
            event.preventDefault();
        }
    }, { passive: false });

    // Detectar y prevenir el doble toque para zoom
    var lastTouchEnd = 0;
    document.addEventListener('touchend', function(event) {
        var now = (new Date()).getTime();
        if (now - lastTouchEnd <= 300) {
            event.preventDefault(); // Prevenir el zoom
        }
        lastTouchEnd = now;
    }, false);
</script>


