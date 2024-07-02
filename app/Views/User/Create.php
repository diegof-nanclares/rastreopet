<?php
/**
 * @var $qrId
 * @var $infoSectionIcon
 * @var $terms
 */
?>
<?php if(!$qrId): ?>
<center><a href="/dashboard">
    <button>Atrás</button>
</a>
</center>

<center><a href="/closesession">Cerrar Sesión</a></center>

<?php endif; ?>
<?php if($qrId): ?>
<div class="background-header" id="pictures-container">
   <div class="register-user-main-title">
       Para comenzar
       registraremos tus
       datos de contacto
   </div>
</div>
<?php endif; ?>
<div class="info-section info-sections active <?= $qrId ? 'register' : '' ?>" id="info-section">
    <div class="header-section-container">
        <img id="info-section-icon-dark"  src="<?= $infoSectionIcon; ?>" class="section-icon dark" alt="Icon section">
        <div class="title-section">Datos de contacto</div>
    </div>
    <div class="bottom-section">
        <form action="/saveuser/create" method="post" onsubmit=" return validateFormPasswords()">
            <table>
                <h2><?= $qrId ? '' : 'Registrar nuevo usuario'?></h2>
                <tr>
                    <td><label class="view-form-label" for="">Nombres * : </label></td>
                    <td><input class="view-textbox-form" required name="name" type="text" placeholder="Escribe tu(s) nombre(s)"></td>
                </tr>
                <tr>
                    <td><label class="view-form-label" for="">Apellidos * : </label></td>
                    <td><input class="view-textbox-form"  required name="lastname"  type="text" placeholder="Escribe tu(s) apellido(s)"></td>
                </tr>
                <tr>
                    <td><label class="view-form-label" for="">Celular * : </label></td>
                    <td><input  class="view-textbox-form" required type="number" name="cellphone"  maxlength="10" placeholder="Tu número de contacto"></td>
                </tr>
                <tr>
                    <td><label class="view-form-label" for="">Tu celular usa whatsapp? : </label></td>
                    <td><input class="view-checkbox-form"   name="is_phone_whatsapp"  type="checkbox"></td>
                </tr>
                <tr>
                    <td><label class="view-form-label" for="">Dirección: </label></td>
                    <td><input class="view-textbox-form"  type="text" name="address" placeholder="(Opcional)"></td>
                </tr>
                <tr>
                    <td><label class="view-form-label" for="">E-mail: </label></td>
                    <td><input class="view-textbox-form"  required name="email" type="email" placeholder="email@ejemplo.com"></td>
                </tr>
                <tr>
                    <td><label class="view-form-label" for="">Contraseña: </label></td>
                    <td><input class="view-textbox-form" id="password-one" required name="password" type="password" placeholder="Tu clave secreta"></td>
                </tr>
                <tr>
                    <td><label class="view-form-label" for="">Repetir Contraseña: </label></td>
                    <td><input class="view-textbox-form" id="password-two"  required type="password" placeholder="Repite tu clave secreta"></td>
                </tr>
                <tr>
                    <td colspan="2">  <hr></td>
                </tr>
                <tr>
                    <td colspan="2"><label class="view-form-label terms" for="">Al continuar aceptas los siguientes <a href="<?= $terms ?>" target="_blank">Términos y condiciones </a> </label>
                    <input class="view-checkbox-form terms"  required name="terms_and_conditions"  type="checkbox"></td>
                </tr>
                <tr>
                    <input type="hidden" name="qrlocator" value="<?= $qrId ?>">
                    <td colspan="2"><button class="primary-action" type="submit"><?= $qrId ? 'Continuar' : 'Guardar' ?></button></td>
                </tr>
            </table>
        </form>
    </div>
</div>
