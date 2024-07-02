
<?php
/**
 *  @var $qrData
 *  @var $petImage
 *  @var $petData
 *  @var $qrTrackingData
 */

$img = $qrData['img_name'] . '.' . $qrData['img_ext'];
use Models\Utils\Util;
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<a href="/qr"><button>Atrás</button></a>
<table>

    <tr>
        <?php if($petData): ?>
        <td colspan="2">
            <h3> <a href="/pet/updatepet/?id=<?= $petData['entity_id'] ?>"><?= $petData['name'] ?></a></h3>
            <img width="250" height="250" src="<?= $petImage ?>" alt="Pet picture">
        </td>
        <?php endif; ?>
        <td>
        <td><img  src="/../../public/static/img/locators/<?= $img ?>" width="200" height="200" alt=""/></td>
        </td>
    </tr>
    <tr>

    </tr>
    <tr>
        <td><a href="/Qrdownload/index/?img=<?= $img ?>"><button>Descargar localizador QR</button></a></td>
    </tr>
</table>
<td colspan="2">
    <hr>
</td>
<table>
</table>
<center>
    <h2>Historial de localizaciones</h2>
</center>

<!--    // Here is the table with localizations -->
<table id="example" class="display" style="width:80%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Latitud</th>
        <th>Longitud</th>
        <th>Fecha/Hora</th>
        <th>Ver posición</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($qrTrackingData as $qrRecord): ?>
        <tr>
            <td><?= $qrRecord['entity_id'] ?></td>
            <td><?= $qrRecord['lattitude'] ?></td>
            <td><?= $qrRecord['longitude'] ?></td>
            <td><?= Util::formatDateTimeFull($qrRecord['created_at']);  ?></td>
            <td><a target="_blank"  href="https://www.google.com/maps?q=<?= $qrRecord['lattitude'] ?>,<?=  $qrRecord['longitude'] ?>">Ver</a></td>
        </tr>
    <?php endforeach; ?>
    <tfoot>
    </tfoot>
    </tbody>
</table>
</table>

<script>
    var table = new DataTable('#example');
</script>






