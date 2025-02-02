
<?php
/**
 *  @var $qrImageGenerated
 * @var Models\Core\MenuRenderingManagement $menuRender
 */
$menuItems = $menuRender->getMenusByRole();
include  __DIR__ . "/../root/templates/menu-container.phtml";
?>
<div class="main-content">
    <center><img  src="/../../public/static/img/locators/<?= $qrImageGenerated ?>" width="200" height="200" alt=""/>
        <a href="/qrdownload/index/?img=<?= $qrImageGenerated ?>"><button>Descargar</button></a>
        <a href="/qr"><button>Atrás</button></a>
    </center>
</div>
