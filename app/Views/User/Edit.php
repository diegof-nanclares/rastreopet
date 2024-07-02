<?php
/**
 * @var $user
 * @var $petsbyUser
 */
?>
<a href="/dashboard">
    <a href="#" onclick="history.back()"><button>Atrás</button></a>
</a>
<a href="/closesession">Cerrar Sesión</a>

<center><h2>Información Básica</h2>
<form action="/saveuser/edit/?>" method="post">
<table>
    <tr>
        <td><label for="">Nombre: </label></td>
        <td><input type="text" name="name" required value="<?= $user['name'] ?>"></td>
    </tr>
    <tr>
        <td><label for="">Apellido: </label></td>
        <td><input type="text" name="lastname" required value="<?= $user['lastname'] ?>"></td>
    </tr>
    <tr>
        <td><label for="">Teléfono / Celular: </label></td>
        <td><input type="text" name="cellphone" required  value="<?= $user['phone'] ?>"></td>
    </tr>
    <tr>
        <td><label for="">Este celular usa whatsapp? : </label></td>
        <td><input type="checkbox"  name="is_phone_whatsapp" <?= $user['is_phone_whatsapp'] == 1 ? 'checked' : ''; ?> ></td>
    </tr>
    <tr>
        <td><label for="">Dirección: </label></td>
        <td><input type="text"  name="address" value="<?= $user['address'] ?>"></td>
    </tr>
    <tr>
        <td><label for="">Rol: </label></td>
        <td>
            <select name="user_role"  required id="user_role">
                <option value=""> -- Selecciona una opción --</option>
                <option value="1" <?= $user['user_role'] === 1 ? 'selected' : '' ?>>Administrador del sistema</option>
                <option value="2" <?= $user['user_role'] === 2 ? 'selected' : '' ?>>Usuario estándar</option>
            </select>
        </td>
    </tr>
    <tr>
        <td><label for="">Usuario: </label></td>
        <td><input type="email" required name="email"  value="<?= $user['username'] ?>"></td>
    </tr>
    <tr>
        <td><label for="">Pasword: </label></td>
        <td><input type="password" required name="password" placeholder="Nueva contraseña"></td>
    </tr>

    <tr>
        <td><label for="">Repetir Pasword: </label></td>
        <td><input type="password" required name="password" placeholder="Repetir Nueva contraseña"></td>
    </tr>
    <tr>
        <input type="hidden" name="id" value="<?= $user['entity_id'] ?>">
        <td><button type="submit">Actualizar</button></td>
    </tr>
</table>
</form>
    <h2>Mascotas Asociadas <a href="/pet/index/?userid=<?= $user['entity_id'] ?>">
            <a6>Agregar</a6>
        </a></h2>
    <table>
        <thead>
        <th>ID</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Raza</th>
        <th>Rastreador</th>
        </thead>
        <tbody>
        <?php foreach ($petsbyUser as $pet): ?>
            <tr>
                <td><?= $pet['entity_id']; ?></td>
                <td><?= $pet['name']; ?></td>
                <td><?= $pet['pet_type']; ?></td>
                <td><?= $pet['pet_breed']; ?></td>
                <td><?= 'identifier here' ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table></table>
</center>

