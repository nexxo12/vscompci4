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
                                            <li class="breadcrumb-item active">Laporan Pembelian</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Laporan Pembelian</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->
                        <div class="row mb-3">
                            <!-- Tambahkan d-flex dan align-items-center agar teks dan input sejajar secara horizontal -->
                            <div class="col-md-4 d-flex align-items-center">
                                <!-- Tambahkan label teks di sini -->
                                <label for="start_date" style="white-space: nowrap; margin-right: 10px;">Start Date</label>
                                <input type="date" id="start_date" class="form-control" placeholder="Tanggal Awal">
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <!-- Tambahkan label teks di sini -->
                                <label for="end_date" style="white-space: nowrap; margin-right: 10px;">End Date</label>
                                <input type="date" id="end_date" class="form-control" placeholder="Tanggal Akhir" value="<?= date('Y-m-d'); ?>">
                            </div>

                            <div class="col-md-4">
                                <button id="btn-filter" class="btn btn-primary mdi mdi-filter"></button>
                                <button id="btn-reset" class="btn btn-secondary mdi mdi-refresh"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped nowrap" id="tbl-laporan-pembelian" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga Beli</th>
                                                        <th>Supplier</th>
                                                        <th>No Invoice</th>
                                                        <th>Tanggal Pembelian</th>
                                                        <th>Tanggal Input</th>
                                                        <th>Pembayaran</th>
                                                        <th>Jatuh Tempo</th>
                                                        <th>Tanggal Pelunasan</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                        </div> <!-- end row -->

                    </div><!-- container -->
                    <!-- modal edit barang -->
                    <div class="modal fade" id="modal-edit-laporan-pembelian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pembelian <text id="id-for-modal"></text></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="detail-pembelian">
                                                    <text>Kode: </text><text id="id_pembelian"></text><br>
                                                    <text>Nama Barang: </text><text id="nama-barang-pembelian"></text><br>
                                                    <text>Harga Beli: </text><text id="harga-beli-pembelian"></text><br>
                                                    <text>Supplier: </text><text id="nama-supplier-pembelian"></text><br>
                                                    <text>Tanggal Pembelian: </text><text id="tgl-pembelian"></text><br>
                                                </div>
                                                <form id="form-edit-pembelian" action="" method="post">
                                                    <input type="text" name="input-id-pembelian" id="input-id-pembelian" value="" hidden>
                                                    <label for="exampleInputEmail1">Pembayaran:</label>
                                                    <select class="custom-select" id="buy-payment" name="buy-payment">
                                                        <option value="Cash">Cash</option>
                                                        <option value="Tempo">Tempo</option>
                                                    </select>
                                                    <label for="exampleInputEmail1">Jatuh Tempo:</label>
                                                    <input type="date" class="form-control" name="tgl-tempo-edit" id="tgl-tempo-edit" value="">
                                                    <label for="exampleInputEmail1">Tanggal Pelunasan:</label>
                                                    <input type="date" class="form-control" name="tgl-pelunasan-edit" id="tgl-pelunasan-edit" value="">
                                                </form>
                                                <div class="text-center mt-3">
                                                    <button type="button" class="btn btn-primary" id="save-edit-pembelian" onclick="saveEditPembelian()">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal edit barang -->
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