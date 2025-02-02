<?php
/**
 * @var $imagePlaceHolder;
 * @var $pet;
 * @var $image;
 * @var $userId;
 * @var $logo;
 * @var Models\Core\MenuRenderingManagement $menuRender
 */
$menuItems = $menuRender->getMenusByRole();
include  __DIR__ . "/../root/templates/menu-container.phtml";
?>

<div class="form-container-main">
    <form action="/savepet/edit" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <img src="<?= $image ?>" alt="Pet picture" class="img-fluid" style="max-width: 100%;">
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <input type="file" name="img" class="form-control mt-3">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Información básica</h3>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="name">Nombre:</label>
                    <input required name="name" type="text" value="<?= $pet['name'] ?>" class="form-control" placeholder="Nombre de tu peludito">
                </div>
                <div class="col-md-6">
                    <label for="pet_type">Tipo:</label>
                    <select name="pet_type" class="form-select form-control"  required>
                        <option value="">-- Selecciona una opción --</option>
                        <option value="Gato" <?= $pet['pet_type'] === "Gato" ? 'selected' : '' ?>>Gato</option>
                        <option value="Perro" <?= $pet['pet_type'] === "Perro" ? 'selected' : '' ?>>Perro</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="pet_breed">Raza:</label>
                    <input type="text" name="pet_breed" value="<?= $pet['pet_breed'] ?>" class="form-control" placeholder="Raza de tu peludito">
                </div>
                <div class="col-md-6">
                    <label for="age">Edad:</label>
                    <input type="number" name="age" value="<?= $pet['age'] ?>" class="form-control" placeholder="Edad en años">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="reward">Recompensa:</label>
                    <input required type="number" name="reward" value="<?= $pet['reward'] ?>" class="form-control" placeholder="Recompensa por encontrarlo">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="weight">Peso:</label>
                    <input type="text" name="weight" value="<?= $pet['weight'] ?>" class="form-control" placeholder="Peso en Kg">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <h3>Historia Clínica</h3>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <label for="medicine">Medicamentos que toma:</label>
                    <textarea name="medicine" rows="4" class="form-control" placeholder="Medicamentos y cada cuanto se le deben suministrar (Opcional)"><?= $pet['medicine'] ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="alergy">Alergias:</label>
                    <textarea name="alergy" rows="3" class="form-control" placeholder="Alergias que tenga tu mascota (opcional)"><?= $pet['alergy'] ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h3>Alimentación</h3>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <label for="diet">Dieta:</label>
                    <textarea name="diet" rows="4" class="form-control" placeholder="Tipo de alimentos que consume"><?= $pet['diet'] ?></textarea>
                </div>
            </div>
            <div class="row">
                <input type="hidden" name="owner_id" value="<?= $pet['owner_id'] ?>">
                <input type="hidden" name="id" value="<?= $pet['entity_id'] ?>">
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
                </div>
            </div>
        </div>
    </form>

</div>
