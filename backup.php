<?php foreach ($showbarang as $show) : ?>
    <tr>
        <td><span id="list_idbarang"><?= $show['ID_BARANG']; ?></span></td>
        <td width="50%"><span id="list_namabarang"><?= $show['NAMA_BARANG']; ?></span></td>
        <td><input type="text" id="stokmodal"></td>
        <td><?= number_format($show['HARGA_JUAL']); ?></td>
        <td>
            <?php
            if ($show['STOK'] <= 0) {
            ?>
                <button type="submit" class="btn btn-primary ti-plus" disabled></button>
            <?php
            } else {
            ?>
                <a class="listbarang" href="<?= base_url('Transaksi/addbarang?id=' . $show['ID_BARANG']); ?>"><button type="button" class=" btn btn-primary ti-plus"></button></a>

            <?php
            }
            ?>

        </td>

    </tr>
<?php endforeach; ?>