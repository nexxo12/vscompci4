<?php

/**
 * @var string $tittle
 * @var array<int, array<string, mixed>> $viewsuratjalan
 * @var array<int, array<string, mixed>> $surat
 */
?>
<title><?= $tittle; ?></title>
<?= $this->include('layout/header_head'); ?>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->
<style>
    /* General styles for screen display */
    body {
        margin: 8px;
        /* Default browser margin */
        padding: 0;
        font-size: 10px;
    }

    /* Styles specifically for printing */
    @media print {

        /* Set page margins to zero for all pages */
        @page {
            margin: 0 !important;
            padding: 0 !important;
            size: auto;
            /* Let browser determine size or set a specific size like A4 */
        }

        /* Ensure body and html elements use full printable area */
        html,
        body {
            margin: 0 !important;
            padding: 1mm !important;
            width: 100% !important;
            height: 100% !important;
            max-width: 100% !important;
            min-width: 100% !important;
        }

        body {
            box-sizing: border-box;
        }

        .nama-toko {
            padding: 0;
            margin: 0;
        }

    }
</style>
<html>

<body>
    <table class="table-responsive judulsurat" border="0" width="100%">
        <tr>
            <!-- <td rowspan="3" width="10%"><img src="../img/logo.png" alt="" style="height:130px; width:160px;"></td> -->
            <td style="vertical-align: top;">
                <h5 class="nama-toko">Vinorious Computer</h5>
                <span class="mdi mdi-map-marker" style="font-size: 18px;"> Jl. Semampir Barat 8/25, Sukolilo - SBY </span><br>
                <span class="mdi mdi-whatsapp" style="font-size: 18px;"> 081-367-088-073</span> <br>
                <span class="mdi mdi-web" style="font-size: 18px;"> www.vskomputer.com</span>
            </td>
            <td style="width: 26%; vertical-align: center; text-align: center;">
                <b>SURAT JALAN</b>
            </td>
            <td>
                <?php foreach ($viewsuratjalan as $surat) : ?><?php endforeach; ?>
                <p>
                    <b>No. Surat Jalan : </b><?= $surat['SURAT_NOMOR']; ?><br>
                    <b>Kepada : </b><?= $surat['SURAT_KEPADA']; ?><br>
                    <b>Tanggal : </b><?= $surat['SURAT_TANGGAL']; ?><br>
                </p>
            </td>
        </tr>
    </table>
    <br>
    <table class="table-responsive listbarang" border="0" width="100%">
        <thead>
            <tr style="border: 1px solid black;">
                <th scope="col" width="7%">No.</th>
                <th scope="col">Nama Barang</th>
                <th scope="col" width="7%" class="text-center">Jumlah</th>
                <th style="text-align: center;" scope="col">S/N</th>
                <th style="text-align: center;" scope="col">Kelengkapan</th>
                <th style="text-align: center;" scope="col">Kerusakan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($viewsuratjalan as $surat) : $no = 1 ?>
                <tr style="border: 1px solid black;">
                    <td style="text-align: left;"><?= $no++; ?></td>
                    <td style="text-align: left;"><?= $surat['SURAT_BARANG']; ?></td>
                    <td style="text-align: center;"><?= $surat['SURAT_QTY']; ?></td>
                    <td style="text-align: center;"><?= $surat['SURAT_SERIAL']; ?></td>
                    <td style="text-align: center;"><?= $surat['SURAT_KETERANGAN']; ?></td>
                    <td style="text-align: center;"><?= $surat['SURAT_KERUSAKAN']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <table class="table-responsive tandatangan" border="0" width="100%" style="font-size: 14px;">
        <tr>
            <td width="25%"></td>
            <td>
                <div style="text-align:center;">Pengirim </div><br><br><br><br>(________)
            </td>
            <td width="43%"></td>
            <td>
                <div style="text-align:center;">Penerima</div><br><br><br><br>(________)
            </td>
        </tr>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>