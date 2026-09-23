<!DOCTYPE html>
<?php
/**
 * @var string $tittle
 * @var string $autonum
 * @var array $showbarang
 * @var array $supplier
 * @var array $showpembelian
 */
?>
<html>

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
                                            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                                            <li class="breadcrumb-item active">Pembelian</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Pembelian</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <form action="" method="POST" id="form-pembelian">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">ID Transaksi</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="id_pembelian" type="text" id="id_buy" value="" readonly>
                                                    <input class="form-control" type="text" value="<?php echo session('ID_LOGIN'); ?>" name="idlogin" id="idlogin-input" hidden>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group mt-2 ">
                                                        <select class="form-control select2 custom-select" data-live-search="true" name="idbarang" id="barang_buy">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Satuan</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" value="unit" id="satuan_buy" name="satuan" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" id="jumlah_buy" name="jumlah" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Harga Beli</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" id="price_buy" oninput="this.value = this.value.replace(/[.,]/g, '')" name="hargabeli" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group mt-2 ">
                                                        <select class="form-control select2 custom-select" data-live-search="true" name="nama_supp" id="nama_supp">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="input_supp">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Keterangan</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" id="nama_supp" name="nama_supp">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Garansi Beli</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="date" id="price_buy" name="garansi_buy">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Tanggal Input</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="tanggal_input" id="example-text-input" value="<?= date("Y-m-d"); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Pembayaran</label>
                                                <div class="col-sm-10">
                                                    <select class="custom-select" id="buy-payment" name="buy-payment">
                                                        <option value="Cash">Cash</option>
                                                        <option value="Tempo">Tempo</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light" id="save-pembelian">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Total Pembelian <?= date('M Y'); ?></h4>

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped text-nowrap" id="tbl-total-pembelian-by-month">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Barang</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga Beli</th>
                                                            <th>Supplier</th>
                                                            <th>Keterangan</th>
                                                            <th>Tanggal Beli</th>
                                                            <th>Tanggal Input</th>
                                                            <th>Pembayaran</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-tampil-history-all-buy" onclick="showPembelianAll()">
                                    <span id="text-tampil-all-buy">Tampilkan Semua History</span>
                                    <span id="loading-tampil-all-buy" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                </button>
                                <div class="card m-b-30" style="display: none;" id="card-history-all-buy">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">History Semua Pembelian:</h4>
                                        <div class="table-responsive">
                                            <table id="tbl-show-all-buy" class="table text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga Beli</th>
                                                        <th>Supplier</th>
                                                        <th>Keterangan</th>
                                                        <th>Tanggal Beli</th>
                                                        <th>Tanggal Input</th>
                                                        <th>Pembayaran</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end row -->

                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <?= $this->include('layout/footerc'); ?>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->
    <?= $this->include('layout/footer_js'); ?>
</body>

</html>