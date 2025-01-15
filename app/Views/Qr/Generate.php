
<?php
/**
 *  @var $qrImageGenerated
 */
?>
<div class="menu-container">
    <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <img class="main-logo"  src="<?= $logo ?>" alt="Rastreo Pet">
    <div class="sidebar">
        <div class="menu-items">
            <div class="greeting-section">
                <h3><i data-feather="circle" class="icon-font-10 feather-icon icon-green pulse-icon"></i><?= $_SESSION['name']  ?></h3>
            </div>
            <a href="/dashboard"><i data-feather="users" class="icon-font-15 feather-icon"></i><span>Usuarios</span></a>
            <a href="/qr"><i data-feather="map-pin" class="icon-font-15 feather-icon"></i><span>Localizadores</span></a>
            <a href="/pet/petsadmin"><i data-feather="list" class="icon-font-15 feather-icon"></i><span>Mascotas</span></a>
            <a href="/closesession"><i data-feather="log-out" class="icon-font-15 feather-icon"></i><span>Cerrar Sesión</span></a>
        </div>
    </div>
</div>
<div class="main-content">
    <center><img  src="/../../public/static/img/locators/<?= $qrImageGenerated ?>" width="200" height="200" alt=""/>
        <a href="/qrdownload/index/?img=<?= $qrImageGenerated ?>"><button>Descargar</button></a>
        <a href="/qr"><button>Atrás</button></a>
    </center>
</div>
