<?php
/**
 * @var $js
**/
?>

<?php if(!isset($removeFooter) || !$removeFooter): ?>
<center><footer>
        <p>Rastreo Pet © <?=  date("Y"); ?> - Todos los derechos reservados</p>
    </footer>
</center>
<?php endif; ?>
<!-- Bootstrap JS -->
<?php
if(isset($js) &&  is_array($js)):
    foreach ($js as $script):?>
        <script src="<?= $script?>"></script>
    <?php endforeach; endif; ?>
</body>
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
</html>
