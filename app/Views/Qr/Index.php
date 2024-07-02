<?php
/**
 * @var $qrRecords
 */

?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<div class="close-session">
    <a href="/closesession">
        Cerrar Sesión
        <span class="door-icon">&#128682;</span>
    </a>
</div>

<a href="/dashboard">
    <button>Atrás</button>
</a>
<hr>
<div class="menu-container">
    <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="sidebar">
        <div class="menu-items">
            <a href="/"><span>Home</span></a>
            <a href="/"><span>Usuarios</span></a>
            <a href="/pet"><span>Mascotas</span></a>
        </div>
    </div>
</div>
<div class="main-content">
    <table class="action-table-buttons">
        <tr>
            <td>
                <a href="/qrgenerate"><button class="primary-action-table-button">Generar nuevo Qr</button></a>
            </td>
        </tr>
    </table>
    <div class="table-container">
        <h4 class="section-page-title">Localizadores generados</h4>
    <table id="datatablerows" class="display" style="width:80%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código localizador</th>
                <th>Habilitado</th>
                <th>Mascota</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($qrRecords as $qrRecord): ?>
            <tr>
                <td><?= $qrRecord['entity_id'] ?></td>
                <td><?= $qrRecord['qr_identifier'] ?></td>
                <td><?= $qrRecord['enabled'] ? 'Sí' : 'No' ?></td>
                <td><a href="pet/detail/?id=<?= $qrRecord['pet_id'] ?>"><?= $qrRecord['name']  ?></a></td>
                <td><a href="qr/viewqrlocator/?id=<?= $qrRecord['qr_identifier'] ?>">Ver</a></td>
            </tr>
        <?php endforeach; ?>
        <tfoot>
        </tfoot>
        </tbody>
    </table>
    </div>
</div>

<script>
    var table = new DataTable('#datatablerows');
</script>

