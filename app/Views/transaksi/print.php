<title><?= $tittle; ?></title>
<?= $this->include('layout/header_head'); ?>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->
<style>
    /* General styles for screen display */
    body {
        margin: 8px;
        /* Default browser margin */
        padding: 0;
    }

    /* Styles specifically for printing */
    @media print {

        /* Set page margins to zero for all pages */
        @page {
            margin: 1mm !important;
            padding: 1mm !important;
            size: auto;
            /* Let browser determine size or set a specific size like A4 */
        }

        /* Ensure body and html elements also have no margins/padding */
        html,
        body {
            margin: 0px !important;
            padding: 0px !important;
            width: 100%;
            height: 100%;
        }

        .nama-toko {
            padding: 0;
            margin: 0;
        }

    }
</style>
<html>
<!-- <?php foreach ($viewnota as $nota) : ?>
    <h1>no nota: <?= $nota['INV_PENJUALAN']; ?></h1>
    <h1>id barang: <?= $nota['ID_BARANG']; ?></h1>
<?php endforeach; ?> -->

<body>
    <table class="table-responsive" border="0" width="100%">
        <tr>
            <!-- <td rowspan="3" width="10%"><img src="../img/logo.png" alt="" style="height:130px; width:160px;"></td> -->
            <td style="vertical-align: top;">
                <h2 class="nama-toko">Vinorious Computer</h2>
                <span class="mdi mdi-map-marker" style="font-size: 20px;"> Jl. Semampir Barat 8 No.25, Sukolilo - SBY </span><br>
                <span class="mdi mdi-whatsapp" style="font-size: 20px;"> 081-367-088-073</span> <br>
                <span class="mdi mdi-web" style="font-size: 20px;"> www.vskomputer.com</span>
            </td>
            <td style="width: 26%; vertical-align: top; text-align: center;">
                <!-- <h5>INVOICE</h5> -->
            </td>
            <td style="width: 35%;">
                <p>
                    <?php foreach ($viewnota as $nota) : ?><?php endforeach; ?>
                    <strong>NO. INVOICE : <?= $nota['INV_PENJUALAN']; ?></strong> <br>
                    Ref: <?= $nota['NAMA']; ?> <?= $nota['REFMP']; ?> <br>
                    Kepada: <?= $nota['NAMACUST']; ?> <br>
                    Alamat: <?= $nota['ALAMAT']; ?><br>
                    Tanggal: <?= date('d-m-Y', strtotime($nota['TANGGAL_TRANSAKSI'])); ?><br>
                </p>
            </td>
        </tr>
    </table>
    <table class="table-responsive" border="0" width="100%">
        <thead>
            <tr style="border: 1px solid black;">
                <th scope="col" width="8%" style="border-bottom: 1px;">Kode</th>
                <th scope="col">Nama Barang</th>
                <th style="text-align: center;" scope="col" width="15%">Harga (Rp.)</th>
                <th scope="col" width="7%" class="text-center">Jumlah</th>
                <th style="text-align: center;" scope="col" width="14%">Subtotal (Rp.)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($viewnota as $nota) : ?>
                <tr>
                    <td style="text-align: left;"><?= $nota['ID_BARANG']; ?></td>
                    <td><?= $nota['NAMA_BARANG']; ?></td>
                    <td style="text-align: right;"><?= number_format($nota['HARGA_JL'], 0, ',', '.'); ?></td>
                    <td align="center"><?= $nota['JUMLAH_BELI']; ?></td>
                    <td style="text-align: right;"><?= number_format($nota['TOTAL_HARGA'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tr style="height: 15px; border-top: 1px solid black;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr style="vertical-align: top;">
            <td colspan="2" style="border: 1px solid black">
                <strong>Catatan : <?= $nota['CATATAN']; ?></strong>
            </td>
            <td rowspan="2">
                <p style="text-align:right;"><br>
                    Subtotal<br>
                    Diskon<br>
                    DP<br><br>
                    <b>Total</b>

                </p>
            </td>
            <td rowspan="2">
                <?php foreach ($sum_qty as $qty) : ?><?php endforeach; ?>
                <p style="text-align:center;"><br>
                    <?= $qty['JUMLAH_BELI']; ?> <br>
                    <br>
                    <br><br>
                    <b><?= $qty['JUMLAH_BELI']; ?></b>
                </p>
            </td>
            <td rowspan="2">
                <p style="text-align:right;"><br>
                    <?php foreach ($sum_subtotal as $subtotal) : ?><?php endforeach; ?>
                    <?php foreach ($sum_totalharga as $totalharga) : ?><?php endforeach; ?>
                    <?php foreach ($sum_diskon as $disskon) : ?><?php endforeach; ?>
                    <?php foreach ($sum_dp as $dp) : ?><?php endforeach; ?>
                    <?php foreach ($sum_nett as $net) : ?><?php endforeach; ?>
                    <?php
                    if ($subtotal['SUBTOTAL'] == null) {
                        echo "Rp. " . number_format($totalharga['TOTAL_HARGA'], 0, ',', '.');
                    } else {
                        echo "Rp. " . number_format($subtotal['SUBTOTAL'], 0, ',', '.');
                    }
                    ?>
                    <br>
                    <?php
                    if ($disskon['DISKON'] == null) {
                        echo "Rp. 0";
                    } else {
                        echo "Rp. " . number_format($disskon['DISKON'], 0, ',', '.');
                    }
                    ?>
                    <br>
                    <?php
                    if ($dp['DP'] == null) {
                        echo "Rp. 0";
                    } else {
                        echo "Rp. " . number_format($dp['DP'], 0, ',', '.');
                    }
                    ?>
                    <br><br>
                    <b><?php
                        if ($net['TOTAL_NETT'] == null) {
                            echo "Rp. " . number_format($totalharga['TOTAL_HARGA'], 0, ',', '.');
                        } else {
                            echo "Rp. " . number_format($net['TOTAL_NETT'], 0, ',', '.');
                        }
                        ?>

                    </b>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" rowspan="4" width="60%">
                <ul style="font-size: 14px;">
                    <li>Simpan kardus komponen untuk administrasi garansi</li>
                    <li>Barang yang dibeli tidak dapat dikembalikan / ditukar (kecuali ada perjanjian)</li>
                    <li>Cek info garansi silahkan kunjungi www.vskomputer.com/garansi.html</li>
                    <li class="bca">Pembayaran lunas / DP silahkan ditransfer ke: <br> <strong>BCA 8980464289 a/n. Ravino Rahman</strong></li>
                </ul>
            </td>
        </tr>
    </table>
    <table class="table-responsive" border="0" width="100%">
        <tr>
            <td width="30%"></td>
            <td>
                <div style="text-align:center;">Penerima </div><br><br><br><br>(________)
            </td>
            <td width="40%"></td>
            <td>
                <div style="text-align:center;">Hormat kami</div><br><br><br><br>(________)
            </td>
        </tr>
    </table>


    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>