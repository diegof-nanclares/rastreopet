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
    <link href="https://fonts.cdnfonts.com/css/jomhuria" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/jost" rel="stylesheet">
    <title>Rastreo Pet</title>
    <!-- Styles-->
    <?php
    if(isset($styles) &&  is_array($styles)):
        foreach ($styles as $stylesheet):?>
            <link rel="stylesheet" href="<?= $stylesheet?>">
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


