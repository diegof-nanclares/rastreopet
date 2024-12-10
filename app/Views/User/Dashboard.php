<?php
/**
 * @var $users
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
<hr>
<div class="menu-container">
    <div class="menu-toggle">
        <span></ion-icon>
</span>
        <span></span>
        <span></span>
    </div>
    <div class="sidebar">
        <div class="menu-items">
            <a href="/"><span>Home</span></a>
            <a href="/qr"><span>Localizadores</span></a>
            <a href="/pet"><span>Mascotas</span></a>
        </div>
    </div>
</div>

<div class="main-content">
    <table class="action-table-buttons">
        <tr>
            <td>
                <a href="/usercreate"><button class="primary-action-table-button">Crear Nuevo</button></a>
            </td>
        </tr>
    </table>
        <h4 class="section-page-title">Usuarios Registrados</h4>
        <div class="table-container">
            <table id="datatablerows">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Celular / Teléfono</th>
                    <th>Número con whatsapp</th>
                    <th>Dirección</th>
                    <th>Rol</th>
                    <th>E-mail</th>
                    <th>Ver</th>
                    <th>Llamar / Chatear </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user):
                    $whatsApp = $user['is_phone_whatsapp'] == 1 ? 1 : 0;
                    $comUrl = $whatsApp ? 'https://wa.me/' .$user['phone'] : 'tel:+57' . $user['phone'];
                    $comLabel = $whatsApp ? 'Chatear' : 'Llamar';
                    ?>
                    <tr>
                        <td><?= $user['entity_id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['lastname'] ?></td>
                        <td><?= $user['phone'] ?></td>
                        <td>
                            <input type="checkbox" disabled <?= $whatsApp ? 'checked' : ''  ?>>
                        </td>
                        <td><?= $user['address'] ?></td>
                        <td><?= $user['user_role'] === 1 ? 'Administrador' : 'Usuario Estándar' ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><a href="/userdetail/index/?id=<?=  $user['entity_id'];?>" target="_blank">Ver</a></td>
                        <td><a <?= $whatsApp ? 'target="_blank"' : '' ?> href="<?= $comUrl ?>"><?= $comLabel ?></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</div>
<script>
    var table = new DataTable('#datatablerows');
</script>
<?php if(isset($_GET['msg'])): ?>
<script>
showMessage('Atención', '<?= $_GET['msg']; ?>', 'success');
</script>
<?php endif; ?>
