<!DOCTYPE html>
<html>
<?php
/**
 * @var string $tittle
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
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li class="breadcrumb-item"><a href="/">VSKomputer</a></li>
                                            <li class="breadcrumb-item active">Buku Kas</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Buku Kas Pemasukan dan Pengeluaran</h4>
                                </div>
                                <div class="alert alert-primary" role="alert">
                                    <text>Panduan Kategori:</text>
                                    <ul>
                                        <li><b>Aktivitas Pendanaan:</b> modal disetor, pembayaran dividen, penarikan dana oleh pemilik (prive), serta penerimaan atau pelunasan pinjaman bank jangka panjang.</li>
                                        <li><b>Pendapatan Usaha:</b> Omset / Hasil Penjualan Utama</li>
                                        <li><b>Beban Perlengkapan:</b> Aset Habis Pakai (< 1 Tahun), plastik packing, lakban, kotak kemasan, kertas print, tinta printer, nota penjualan, brosur cetak, dsb.</li>
                                        <li><b>Beban Utilitas & Sewa:</b> Pembayaran token listrik kantor, tagihan Wi-Fi/internet bulanan, pulsa operasional, sewa ruko/co-working space bulanan, dsb.</li>
                                        <li><b>Beban Operasional Lain:</b> Biaya pembuatan legalitas tambahan, biaya admin bulanan bank PT, biaya iklan (FB Ads/Google Ads), ongkos kirim sampel barang.</li>
                                        <li><b>Aktiva Tetap (Aset):</b> Pembelian barang modal berwujud yang berumur panjang seperti laptop kerja, printer, meja kursi kantor, handphone admin</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <form id="form-buku-kas" action="">
                                            <div class="form-group row">
                                                <label for="idbarang" class="col-sm-2 col-form-label">Tanggal:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" name="id-login-buku-kas" id="id-login-buku-kas" value="<?php echo session('ID_LOGIN'); ?>" hidden>
                                                    <input class="form-control" type="date" name="tgl-buku-kas" id="tgl-buku-kas" value="<?= date("Y-m-d"); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="idbarang" class="col-sm-2 col-form-label">Jenis Transaksi:</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="jenis-transaksi-buku-kas" id="jenis-transaksi-buku-kas" required>
                                                        <option value="">Pilih Jenis Transaksi</option>
                                                        <option value="pemasukan">Pemasukan</option>
                                                        <option value="pengeluaran">Pengeluaran</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="rincian-form" style="display: none;">
                                                <label for="idbarang" class="col-sm-2 col-form-label">Rincian:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="rincian-buku-kas" id="rincian-buku-kas" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="kategori-form" style="display: none;">
                                                <label for="idbarang" class="col-sm-2 col-form-label">Kategori:</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="kategori-buku-kas" id="kategori-buku-kas" required>
                                                        <option value="">Pilih Kategori</option>
                                                        <option value="Aktivitas Pendanaan">Aktivitas Pendanaan</option>
                                                        <option value="Pendapatan Usaha">Pendapatan Usaha</option>
                                                        <option value="Beban Perlengkapan">Beban Perlengkapan</option>
                                                        <option value="Beban Operasional">Beban Operasional</option>
                                                        <option value="Beban Utilitas">Beban Utilitas</option>
                                                        <option value="Aktiva Tetap (ASET)">Aktiva Tetap (ASET)</option>
                                                    </select>
                                                    <small class="form-text text-danger">Note: Ketik di kotak pencarian untuk menambahkan kategori baru jika tidak ada di daftar!</small>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="pemasukan-form" style="display: none;">
                                                <label for="idbarang" class="col-sm-2 col-form-label">Pemasukan:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" name="pemasukan-buku-kas" id="pemasukan-buku-kas" oninput="this.value = this.value.replace(/[.,]/g, '')" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row" id="pengeluaran-form" style="display: none;">
                                                <label for="idbarang" class="col-sm-2 col-form-label">Pengeluaran:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" name="pengeluaran-buku-kas" id="pengeluaran-buku-kas" oninput="this.value = this.value.replace(/[.,]/g, '')" value="">
                                                </div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="button" class="btn btn-primary" id="btn-save-buku-kas" onclick="">Tambah</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Data Buku Kas</h4>
                                        <table id="datatable-buku-kas" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Rincian</th>
                                                    <th>Kategori</th>
                                                    <th>Pemasukan</th>
                                                    <th>Pengeluaran</th>
                                                    <th>Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>


                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <footer class="footer">
                <?= $this->include('layout/footerc'); ?>
            </footer>

        </div>
        <!-- End Right content here -->
    </div>
    <!-- END wrapper -->
    <?= $this->include('layout/footer_js'); ?>
</body>

</html>