<!DOCTYPE html>
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
                                            <li class="breadcrumb-item active">Laporan Penjualan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Laporan Penjualan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="tbl-laporanpj">
                                                <thead>
                                                    <tr>
                                                        <th>Nota</th>
                                                        <th>Tanggal</th>
                                                        <th>Keterangan</th>
                                                        <th>Total Penjualan</th>
                                                        <th>Modal</th>
                                                        <th>Biaya kurang</th>
                                                        <th>Biaya lebih</th>
                                                        <th>Admin MP</th>
                                                        <th>Laba Bersih</th>
                                                        <th style="width: 12%; text-align:center">Aksi</th>
                                                        <!-- <th></th>
                                                        <th></th> -->
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

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <footer class="footer">
                © 2021 - VSKomputer.
            </footer>

        </div>
        <!-- End Right content here -->
        <!-- Modal edit-->
        <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="form-info-invoice">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nota</label>
                                        <input type="text" class="form-control" name="invoice-laporan-edit" id="invoice-laporan-edit" value="">
                                        <label for="exampleInputEmail1">Tanggal</label>
                                        <input type="text" class="form-control" name="tangal-laporan-edit" id="tangal-laporan-edit" value="">
                                        <label for="exampleInputEmail1">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan-laporan-edit" id="keterangan-laporan-edit" value="">
                                        <label for="exampleInputEmail1">Modal</label>
                                        <input type="number" class="form-control" name="modal-laporan-edit" oninput="this.value = this.value.replace(/[.,]/g, '')" id="modal-laporan-edit" value="">
                                        <input type="number" class="form-control" name="gtotal-laporan-edit" id="gtotal-laporan-edit" value="" hidden>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Biaya Kurang (-)</label>
                                        <input type="number" class="form-control" name="biayamin-laporan-edit" id="biayamin-laporan-edit" value="0">
                                        <label for="exampleInputEmail1">Biaya Lebih (+)</label>
                                        <input type="number" class="form-control" name="biayaplus-laporan-edit" id="biayaplus-laporan-edit" value="0">
                                        <label for="exampleInputEmail1">Biaya Admin</label>
                                        <input type="number" class="form-control" name="biayaadm-laporan-edit" id="biayaadm-laporan-edit" value="0">
                                        <label for="exampleInputEmail1">Laba</label>
                                        <input type="number" class="form-control" name="laba-laporan-edit" id="laba-laporan-edit" value="">

                                        <br>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div style="display: flex; justify-content: center;">
                            <button type="button" class="btn btn-primary waves-effect waves-light" id="alertify-success" onclick="save_edit_invoice()">
                                <span id="text-simpan">Save</span>
                                <span id="loading-simpan" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                            </button>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>QTY</th>
                                        <th>Harga Jual</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="view-edit-invoice-laporan">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal edit-->
        <!-- Modal VIEW invoice-->
        <div class="modal fade" id="modal-view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Nota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Invoice: <span id="no-invoice" style="font-size: medium;"></span><br>
                        Ref: <span id="ref-invoice" style="font-size: medium;"></span> <br>
                        Nama: <span id="nama-invoice" style="font-size: medium;"></span> <br>
                        Alamat: <span id="alamat-invoice" style="font-size: medium;"></span> <br>
                        Tanggal: <span id="tgl-invoice" style="font-size: medium;"></span>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode</th>
                                        <th>Barang</th>
                                        <th>QTY</th>
                                        <th>Modal</th>
                                        <th>Harga Jual</th>
                                        <th>Laba</th>
                                    </tr>
                                </thead>
                                <tbody id="data-view-invoice">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align: right;">Total</th>
                                        <th><span id="total-qty"></span></th>
                                        <th><span id="total-modal"></span></th>
                                        <th><span id="total-harga"></span></th>
                                        <th><span id="total-laba"></span></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal VIEW-->
    </div>
    <!-- END wrapper -->
    <?= $this->include('layout/footer_js'); ?>
</body>

</html>