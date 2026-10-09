<!DOCTYPE html>
<html>
<?php
/**
 * @var string $tittle
 * @var mixed $JumlahLabaBulanIni 
 * @var mixed $BebanOperasional
 * @var mixed $BebanGaji
 * @var mixed $BebanPerlengkapan
 * @var mixed $BebanUtilitas
 * @var mixed $TotalBeban
 * @var mixed $HasilSebelumPajak
 * @var mixed $LabaPaid
 * @var mixed $LabaPending
 * @var mixed $showBebanOperasional
 * @var mixed $showBebanPerlengkapan
 * @var mixed $showBebanGaji
 * @var mixed $showBebanUtilitas
 * @var mixed $PajakPaymentCash
 * @var mixed $TotalLabaCASH
 * @var mixed $TotalLabaTokopedia
 * @var mixed $TotalLabaShopee
 * @var mixed $TotalLabaCashPaid
 * @var mixed $TotalLabaTokopediaPaid
 * @var mixed $TotalLabaShopeePaid
 * @var mixed $TotalLabaCashPending
 * @var mixed $TotalLabaTokopediaPending
 * @var mixed $TotalLabaShopeePending
 */
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= $tittle; ?></title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?= $this->include('layout/header_head'); ?>
    <style>
        @media print {

            /* CSS khusus untuk tampilan web normal agar terlihat rapi */
            .nama-perusahaan {
                font-size: 14px;
            }

            /* Membuat Nama Perusahaan di Tengah saat Print */
            .nama-perusahaan {
                text-align: center !important;
                width: 100% !important;
                font-size: 24px !important;
                /* Ukuran sedikit lebih kecil dari judul utama */
                font-weight: bold !important;
                color: #000000 !important;
                /* Warna teks gelap */
                margin-top: 0 !important;
                margin-bottom: 20px !important;
            }

            /* 1. Sembunyikan tombol cetak */
            #tombol-cetak {
                display: none !important;
            }

            /* 2. Ubah pembungkus judul menjadi block agar text-align berfungsi */
            .d-flex.justify-content-between {
                display: block !important;
            }

            /* 3. Buat tulisan judul berada di tengah dan diperbesar */
            .header-title {
                text-align: center !important;
                width: 100% !important;
                font-size: 24px !important;
                /* Tambahkan ini untuk memperbesar ukuran huruf */
                font-weight: bold !important;
                /* Membuat teks menjadi tebal */
                margin-top: 0 !important;
                margin-bottom: 2px !important;
            }



        }
    </style>

</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <?= $this->include('layout/sidebar_left'); ?>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                <?= $this->include('layout/header'); ?>
                <!-- Top Bar End -->

                <div class="page-content-wrapper ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="page-title-box">
                                    <h4 class="page-title">Total Laba <?= date('F Y'); ?></h4>
                                </div>
                                <div class="alert alert-primary" role="alert" style="font-size: large;">
                                    <div style="display: flex; align-items: center; gap: 8px; color:black;">
                                        <i class="mdi mdi-cash" style="font-size: 58px;"></i>
                                        <span><?= 'Rp. ' . number_format($JumlahLabaBulanIni[0]['laba_bersih'], 0, ',', '.');  ?></span>
                                    </div>
                                    <table style="font-size: small; font-style: italic; border: none; margin-top: 8px; color:black;">
                                        <tr>
                                            <td>CASH</td>
                                            <td>:</td>
                                            <td><?= 'Rp. ' . number_format($TotalLabaCASH[0]['laba_bersih'], 0, ',', '.');  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tokopedia</td>
                                            <td>:</td>
                                            <td><?= 'Rp. ' . number_format($TotalLabaTokopedia[0]['laba_bersih'], 0, ',', '.');  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Shopee</td>
                                            <td>:</td>
                                            <td><?= 'Rp. ' . number_format($TotalLabaShopee[0]['laba_bersih'], 0, ',', '.');  ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="page-title-box">
                                    <h4 class="page-title">Laba Paid</h4>
                                </div>
                                <div class="alert alert-success" role="alert" style="font-size: large;">
                                    <div style=" display: flex; align-items: center; gap: 8px; color:black;">
                                        <i class="mdi mdi-check-circle" style="font-size: 58px;"></i>
                                        <span><?= 'Rp. ' . number_format($LabaPaid[0]['laba_bersih'], 0, ',', '.');  ?></span>
                                    </div>
                                    <table style="font-size: small; font-style: italic; border: none; margin-top: 8px; color:black;">
                                        <tr>
                                            <td>CASH</td>
                                            <td>:</td>
                                            <td><?= 'Rp. ' . number_format($TotalLabaCashPaid[0]['laba_bersih'], 0, ',', '.');  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tokopedia</td>
                                            <td>:</td>
                                            <td><?= 'Rp. ' . number_format($TotalLabaTokopediaPaid[0]['laba_bersih'], 0, ',', '.');  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Shopee</td>
                                            <td>:</td>
                                            <td><?= 'Rp. ' . number_format($TotalLabaShopeePaid[0]['laba_bersih'], 0, ',', '.');  ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="page-title-box">
                                    <h4 class="page-title">Laba Pending</h4>
                                </div>
                                <div class="alert alert-warning" role="alert" style="font-size: large;">
                                    <div style=" display: flex; align-items: center; gap: 8px; color:black;">
                                        <i class="mdi mdi-clock-alert" style="font-size: 58px;"></i>
                                        <span><?= 'Rp. ' . number_format($LabaPending[0]['laba_bersih'], 0, ',', '.');  ?></span>
                                    </div>
                                    <table style="font-size: small; font-style: italic; border: none; margin-top: 8px; color:black;">
                                        <tr>
                                            <td>CASH</td>
                                            <td>:</td>
                                            <td><?= 'Rp. ' . number_format($TotalLabaCashPending[0]['laba_bersih'], 0, ',', '.');  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tokopedia</td>
                                            <td>:</td>
                                            <td><?= 'Rp. ' . number_format($TotalLabaTokopediaPending[0]['laba_bersih'], 0, ',', '.');  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Shopee</td>
                                            <td>:</td>
                                            <td><?= 'Rp. ' . number_format($TotalLabaShopeePending[0]['laba_bersih'], 0, ',', '.');  ?></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="mt-0 header-title mb-1">Rincian Laba Rugi</h4>
                                            <h5 class="nama-perusahaan mb-0 text-muted mt-0">PT Vinorious Sukses Komputindo</h5>
                                            <!-- Tambahkan id dan onclick -->
                                            <button onclick="cetakHalaman()" id="tombol-cetak" class="btn btn-primary btn-sm">
                                                <i class="mdi mdi-printer me-1"></i> Cetak
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="datatable-laba" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Komponen</th>
                                                        <th>Kategori Akun</th>
                                                        <th>Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Pendapatan</td>
                                                        <td>Laba Bersih Usaha</td>
                                                        <td><?= 'Rp. ' . number_format($LabaPaid[0]['laba_bersih'], 0, ',', '.');  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Pendapatan Lain</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr class="bg-light" style="font-weight: bold; text-align: right;">
                                                        <td colspan="2">Total Pendapatan</td>
                                                        <td><?= 'Rp. ' . number_format($LabaPaid[0]['laba_bersih'], 0, ',', '.');  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Beban</td>
                                                        <td>Beban Operasional
                                                            <?php $no = 1; ?>
                                                            <?php foreach ($showBebanOperasional as $sbo) : ?>
                                                                <div style="display: flex; justify-content: space-between; font-size: small; font-style: italic;">
                                                                    <span><?= $no++; ?>. <?= $sbo['RINCIAN_KAS']; ?></span>
                                                                    <span><?= 'Rp. ' . number_format($sbo['PENGELUARAN_KAS'], 0, ',', '.');  ?></span>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </td>
                                                        <td><?= 'Rp. ' . number_format($BebanOperasional[0]['PENGELUARAN_KAS'], 0, ',', '.');  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Beban Perlengkapan
                                                            <?php $no = 1; ?>
                                                            <?php foreach ($showBebanPerlengkapan as $sbp) : ?>
                                                                <div style="display: flex; justify-content: space-between; font-size: small; font-style: italic;">
                                                                    <span><?= $no++; ?>. <?= $sbp['RINCIAN_KAS']; ?></span>
                                                                    <span><?= 'Rp. ' . number_format($sbp['PENGELUARAN_KAS'], 0, ',', '.');  ?></span>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </td>
                                                        <td><?= 'Rp. ' . number_format($BebanPerlengkapan[0]['PENGELUARAN_KAS'], 0, ',', '.');  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Beban Gaji
                                                            <?php $no = 1; ?>
                                                            <?php foreach ($showBebanGaji as $sbg) : ?>
                                                                <div style="display: flex; justify-content: space-between; font-size: small; font-style: italic;">
                                                                    <span><?= $no++; ?>. <?= $sbg['RINCIAN_KAS']; ?></span>
                                                                    <span><?= 'Rp. ' . number_format($sbg['PENGELUARAN_KAS'], 0, ',', '.');  ?></span>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </td>
                                                        <td><?= 'Rp. ' . number_format($BebanGaji[0]['PENGELUARAN_KAS'], 0, ',', '.');  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Beban Utilitas
                                                            <?php $no = 1; ?>
                                                            <?php foreach ($showBebanUtilitas as $sbu) : ?>
                                                                <div style="display: flex; justify-content: space-between; font-size: small; font-style: italic;">
                                                                    <span><?= $no++; ?>. <?= $sbu['RINCIAN_KAS']; ?></span>
                                                                    <span><?= 'Rp. ' . number_format($sbu['PENGELUARAN_KAS'], 0, ',', '.');  ?></span>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </td>
                                                        <td><?= 'Rp. ' . number_format($BebanUtilitas[0]['PENGELUARAN_KAS'], 0, ',', '.');  ?></td>
                                                    </tr>
                                                    <tr class="bg-light" style="font-weight: bold; text-align: right;">
                                                        <td colspan="2">Total Beban</td>
                                                        <td><?= 'Rp. ' . number_format($TotalBeban, 0, ',', '.');  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hasil</td>
                                                        <td>Laba / Rugi Sebelum Pajak</td>
                                                        <td><?= 'Rp. ' . number_format($HasilSebelumPajak, 0, ',', '.');  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Pajak Penghasilan (PPh 0.5%)
                                                            <div style="display: flex; justify-content: space-between; font-size: small; font-style: italic;">
                                                                <span>CASH: Rp. <?= number_format($PajakPaymentCash[0]['laba_bersih'], 0, ',', '.'); ?> x 0.5%</span>
                                                            </div>
                                                            <div style="display: flex; justify-content: space-between; font-size: small; font-style: italic;">
                                                                <span>Shopee & Tokopedia: dipotong di aplikasi</span>
                                                            </div>
                                                        </td>
                                                        <td><?= 'Rp. ' . number_format($PajakPaymentCash[0]['laba_bersih'] * 0.005, 0, ',', '.');  ?></td>
                                                    </tr>
                                                    <tr class="bg-light" style="font-weight: bold; text-align: right;">
                                                        <td colspan="2">Laba / Rugi Setelah Pajak</td>
                                                        <td><?= 'Rp. ' . number_format($HasilSebelumPajak - ($PajakPaymentCash[0]['laba_bersih'] * 0.005), 0, ',', '.');  ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>


                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

        </div>
        <!-- End Right content here -->
    </div>
    <!-- END wrapper -->
    <footer class="footer">
        <?= $this->include('layout/footerc'); ?>
    </footer>
    <?= $this->include('layout/footer_js'); ?>
</body>

</html>

<script>
    function cetakHalaman() {
        // Membuka dialog print bawaan browser
        window.print();
    }
</script>

<script>
    function cetakHalaman() {
        // 1. Ambil seluruh isi halaman asli
        var isiHalamanAsli = document.body.innerHTML;

        // 2. Ambil hanya bagian card/tabel laporan (sesuaikan dengan class pembungkus Anda)
        // Misalnya dibungkus oleh class "card-body"
        var isiCetak = document.querySelector('.card-body').innerHTML;

        // 3. Ubah isi halaman web menjadi hanya area tabel
        document.body.innerHTML = isiCetak;

        // 4. Sembunyikan tombol cetak di halaman sementara ini agar tidak ikut terprint
        if (document.getElementById('tombol-cetak')) {
            document.getElementById('tombol-cetak').style.display = 'none';
        }

        // 5. Jalankan fungsi print browser
        window.print();

        // 6. Kembalikan isi halaman web ke semula setelah dialog print ditutup
        document.body.innerHTML = isiHalamanAsli;

        // Reload halaman agar fungsi javascript kembali aktif normal
        window.location.reload();
    }
</script>