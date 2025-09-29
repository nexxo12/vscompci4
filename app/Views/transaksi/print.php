<title><?= $tittle; ?></title>
<h1>ini halaman print</h1>
<html>
<?php foreach ($viewnota as $nota) : ?>
    <h1>no nota: <?= $nota['INV_PENJUALAN']; ?></h1>
    <h1>id barang: <?= $nota['ID_BARANG']; ?></h1>
<?php endforeach; ?>

</html>