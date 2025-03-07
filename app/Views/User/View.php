<?php
/**
 * @var $user
 * @var $petsbyUser
 * @var $logo
 * @var Models\Core\MenuRenderingManagement $menuRender
 */

$menuItems = $menuRender->getMenusByRole();
include  __DIR__ . "/../root/templates/menu-container.phtml";
// Fin name-section class for greeting
?>
<div class="main-content">
    <h4 class="section-page-title">Datos de Usuario <i data-feather="user" class="icon-font-25 feather-icon icon-line-top-4"></i></h4>
    <div class="form-container-main">
        <div class="container">
            <div class="container mt-4">
                <h3 class="info-separator">Información Básica
                    <a href="/useredit/index/?id=<?= $user['entity_id'] ?>">
                        <span>Modificar</span>
                    </a>
                </h3>
                <hr>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>"
                                   disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Apellido:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                   value="<?= $user['lastname'] ?>" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cellphone">Teléfono / Celular:</label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone"
                                   value="<?= $user['phone'] ?>" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="is_phone_whatsapp">Este celular usa WhatsApp?</label>
                            <input type="checkbox"  id="is_phone_whatsapp"
                                   name="is_phone_whatsapp" <?= $user['is_phone_whatsapp'] == 1 ? 'checked' : ''; ?>
                                   disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Dirección:</label>
                        <input type="text" class="form-control" id="address" name="address" required
                               value="<?= $user['address'] ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="user_role">Rol:</label>
                        <select class="form-control" id="user_role" name="user_role" disabled>
                            <option value=""> -- Selecciona una opción --</option>
                            <option value="1" <?= $user['user_role'] === 1 ? 'selected' : '' ?>>Administrador del
                                sistema
                            </option>
                            <option value="2" <?= $user['user_role'] === 2 ? 'selected' : '' ?>>Usuario estándar
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required
                               value="<?= $user['username'] ?>" disabled>
                    </div>
                </form>
                <h3 class="info-separator">Mascotas Asociadas <a href="/pet/index/?userid=<?= $user['entity_id'] ?>">
                        <a6>Agregar</a6>
                    </a></h3>
                <hr>
                <div class="datatable-inner">
                    <table id="datatablerows">
                        <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Raza</th>
                        <th>Ver</th>
                        <th>Rastreador</th>
                        </thead>
                        <tbody>
                        <?php foreach ($petsbyUser as $pet):

                            ?>
                            <tr>
                                <td><?= $pet['entity_id']; ?></td>
                                <td><?= $pet['name']; ?></td>
                                <td><?= $pet['pet_type']; ?></td>
                                <td><?= $pet['pet_breed']; ?></td>
                                <td><a href="/pet/detail/?id=<?= $pet['entity_id'] ?>">Ver</a></td>
                                <td>
                                    <?php if ($pet['qr_identifier']): ?>
                                        <a href="/qr/viewqrlocator/?id=<?= $pet['qr_identifier'] ?>">Localizador</a>
                                    <?php else: ?>
                                        Sin localizador
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var table = new DataTable('#datatablerows');
    </script>
    <?php if (isset($_GET['msg'])): ?>
        <script>
            showMessage('Atención', '<?= $_GET['msg']; ?>', 'success');
        </script>
    <?php endif; ?>

