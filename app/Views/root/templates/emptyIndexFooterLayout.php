<?php
/**
 * @var $js
**/
?>

<?php if(!isset($removeFooter) || !$removeFooter): ?>
<center><footer>
        <p>Rastreo Pet © 2023 - Todos los derechos reservados</p>
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
</html>
