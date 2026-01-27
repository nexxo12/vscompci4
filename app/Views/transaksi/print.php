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
                    <?php foreach ($viewnota as $nota) : ?>
                        <strong>NO. INVOICE : <?= $nota['INV_PENJUALAN']; ?></strong> <br>
                    <?php endforeach; ?>
                    Kepada: Vinorious Comp <br>
                    Alamat: Jl. Semampir Barat Gg. VIII No.25, Medokan Semampir, Kec. Sukolilo, Surabaya, Jawa Timur 60119<br>
                    Telp: 083853525037<br>
                    Tanggal: 23-06-2024<br>
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

            <tr>
                <td style="text-align: left;">BR002</td>
                <td>Kingstone HyperX 8GB DDR3-12800</td>
                <td style="text-align: right;">50.000</td>
                <td align="center">1</td>
                <td style="text-align: right;">50.000</td>
            </tr>
            <tr>
                <td style="text-align: left;">BR002</td>
                <td>Kingstone HyperX 8GB DDR3-12800</td>
                <td style="text-align: right;">50.000</td>
                <td align="center">1</td>
                <td style="text-align: right;">50.000</td>
            </tr>
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
                <strong>Catatan : Barang yang dibeli tidak dapat dikembalikan / ditukar</strong>
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
                <p style="text-align:center;"><br>
                    2 <br>
                    <br>
                    <br><br>
                    <b>2</b>
                </p>
            </td>
            <td rowspan="2">
                <p style="text-align:right;"><br>
                    Rp. 100.000 <br>
                    Rp. 0 <br>
                    Rp. 20.000 <br><br>
                    <b>Rp. 80.000</b>
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


    <!-- <script type="text/javascript">
        window.print();
    </script> -->
</body>

</html>