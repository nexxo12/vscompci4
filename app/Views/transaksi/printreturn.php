<?php

/**
 * @var string $tittle
 * @var array<int, array<string, mixed>> $viewsuratreturn
 * @var array<int, array<string, mixed>> $return
 * @var array<int, array<string, mixed>> $style
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
    }

    /* Styles specifically for printing */
    @media print {

        /* Set page margins to zero for all pages */
        @page {
            margin: 2mm !important;
            padding: 2mm !important;
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

        .listbarang-return {
            width: 100%;
            /* Memenuhi lebar halaman */
            display: flex;
            justify-content: center;
            /* Membuat konten di dalamnya ke tengah */
            margin: 20px 0;
        }

    }
</style>
<html>

<body>
    <table class="table-responsive" border="0" width="100%">
        <tr>
            <!-- <td rowspan="3" width="10%"><img src="../img/logo.png" alt="" style="height:130px; width:160px;"></td> -->
            <td style="vertical-align: top;">
                <h5 class="nama-toko">Vinorious Computer</h5>
                <span class="mdi mdi-map-marker" style="font-size: 18px;"> Jl. Semampir Barat 8/25, Sukolilo - SBY </span><br>
                <span class="mdi mdi-whatsapp" style="font-size: 18px;"> 081-367-088-073</span> <br>
                <span class="mdi mdi-web" style="font-size: 18px;"> www.vskomputer.com</span>
            </td>
            <td style="vertical-align: center; width:300px; text-align: center; font-size: 25px; font-weight: bold;">
                <b>TANDA TERIMA</b>
            </td>
            <td style="text-align: right; font-size: 20px; width:368px;">
                <?php foreach ($viewsuratreturn as $return) : ?> <?php endforeach; ?>
                <b>No. Surat: <?= $return['NOSURAT']; ?></b><br>
                <b>Tanggal: <?= date('d-m-Y', strtotime($return['TGL_INPUT'])); ?></b><br>
                <b>Diterima dari: <?= $return['NAMA']; ?></b><br>
                <b>HP: <?= $return['NOHP']; ?></b>
            </td>
        </tr>
    </table>
    <?php
    $noSurat = $return['NOSURAT'];
    $splitNoSurat = explode('-', $noSurat);
    $ResultnoSurat = $splitNoSurat[1];
    // $tampildetail = true;
    if ($ResultnoSurat === "TM") {
        $style = "display: block;";
    }
    if ($ResultnoSurat === "TO") {
        $style = "display: none;";
    }
    ?>
    <br>
    <p>Telah diterima barang-barang dengan rincian dan kondisi sebagai berikut:</p>
    <div class="detail-return-mp" style="<?= $style; ?>; font-weight: bold;">
        <p> Ref: <?= !empty($return['REF_MP']) ? $return['REF_MP'] : '-'; ?><br>
            Nota Pembelian: <?= !empty($return['INVOICE_NOTA']) ? $return['INVOICE_NOTA'] : '-'; ?><br>
            Tanggal Pembelian: <?= $return['TGL_BELI'] === '0000-00-00' ? '-' : $return['TGL_BELI']; ?>
        </p>
    </div>

    <div class="listbarang-return">
        <table class="table-responsive" border="1" style=" border-collapse: collapse;">
            <thead>
                <tr style="border: 1px solid black;">
                    <th scope="col" width="7%">No.</th>
                    <th scope="col" width="60%">Nama Barang</th>
                    <th scope="col" width="7%" class="text-center">Jumlah</th>
                    <th style="text-align: center;" width="10%">Kelengkapan</th>
                    <th style="text-align: center;" width="20%">Kerusakan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viewsuratreturn as $return) : $no = 1 ?>
                    <tr style="border: 1px solid black;">
                        <td style="text-align: left;"><?= $no++; ?></td>
                        <td style="text-align: left;"><?= $return['BARANG']; ?></td>
                        <td style="text-align: center;"><?= $return['RETURN_QTY']; ?></td>
                        <td style="text-align: center;"><?= $return['KELENGKAPAN']; ?></td>
                        <td style="text-align: center;"><?= $return['KERUSAKAN']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p><i>Catatan: Barang yang sudah selesai diservis wajib diambil maksimal 30 hari (1 bulan) setelah tanggal pemberitahuan selesai. Terima kasih atas pengertiannya.</i></p>
    <br>
    <table class="table-responsive tandatangan" border="0" width="100%" style="font-size: 14px;">
        <tr>
            <td width="35.5%"></td>
            <td>
                <div style="text-align:center;">Pengirim</div><br><br><br><br>(________)
            </td>
            <td width="37.5%"></td>
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