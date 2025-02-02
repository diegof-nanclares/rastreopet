<?php
/**
 * @var $imagePlaceHolder;
 * @var $pet;
 * @var $image;
 * @var $logo;
 * @var Models\Core\MenuRenderingManagement $menuRender
 */
$menuItems = $menuRender->getMenusByRole();
include  __DIR__ . "/../root/templates/menu-container.phtml";
?>
<div class="form-container-main">
<form action="/savepet/create" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <img class="img-fluid w-80" src="<?= $image ?>" alt="Pet picture">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="text-center">Información básica <a href="/pet/updatepet/?id=<?= $pet['entity_id'] ?>"> Modificar</a></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="name">Nombre:</label>
                <input required name="name" type="text" class="form-control" value="<?= $pet['name'] ?>" disabled placeholder="Nombre de tu peludito">
            </div>
            <div class="col-md-6">
                <label for="pet_type">Tipo:</label>
                <select name="pet_type" class="form-select form-control"  class="form-select" disabled required>
                    <option value="">-- Selecciona una opción --</option>
                    <option value="Gato" <?= $pet['pet_type'] === "Gato" ? 'selected' : '' ?>>Gato</option>
                    <option value="Perro" <?= $pet['pet_type'] === "Perro" ? 'selected' : '' ?>>Perro</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="pet_breed">Raza:</label>
                <input required type="text" name="pet_breed" class="form-control" disabled value="<?= $pet['pet_breed'] ?>" placeholder="Raza de tu peludito">
            </div>
            <div class="col-md-6">
                <label for="age">Edad:</label>
                <input required type="text" name="age" class="form-control" disabled value="<?= $pet['age'] ?>" placeholder="Edad en años">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="reward">Recompensa:</label>
                <input required type="number" name="reward" class="form-control" disabled value="<?= $pet['reward'] ?>" placeholder="Recompensa por encontrarlo">
            </div>
            <div class="col-md-6">
                <label for="weight">Peso:</label>
                <input type="text" name="weight" class="form-control" disabled value="<?= $pet['weight'] ?>" placeholder="Peso en Kg">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Historia Clínica</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="medicine">Medicamentos que toma:</label>
                <textarea name="medicine" class="form-control" rows="4" disabled placeholder="Medicamentos y cada cuanto se le deben suministrar (Opcional)"><?= $pet['medicine'] ?></textarea>
            </div>
            <div class="col-md-6">
                <label for="alergy">Alergias:</label>
                <textarea name="alergy" class="form-control" rows="3" disabled placeholder="Alergias que tenga tu mascota (opcional)"><?= $pet['alergy'] ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Alimentación</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="diet">Dieta:</label>
                <textarea name="diet" class="form-control" rows="4" disabled placeholder="Tipo de alimentos que consume"><?= $pet['diet'] ?></textarea>
            </div>
        </div>
    </div>
</form>
</div>
