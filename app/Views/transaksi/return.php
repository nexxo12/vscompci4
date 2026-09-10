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
    <title><?= $tittle ?></title>
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
                                            <li class="breadcrumb-item active">Return & Service</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Return & Service</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Buat Tanda Terima</h4>
                                        <form action="" method="POST" id="form-service">
                                            <!-- Input 1 -->
                                            <div class="form-group row">
                                                <label for="no_surat" class="col-sm-2 col-form-label">No Nota:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="no_surat" id="no_surat" readonly value="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal :</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="date" name="tanggal" id="tanggal" placeholder="Masukkan tanggal..." value="">
                                                    <script>
                                                        // Mendapatkan tanggal hari ini (format YYYY-MM-DD)
                                                        const today = new Date(new Date().getTime() + 7 * 60 * 60 * 1000).toISOString().split('T')[0];

                                                        // Mengisi nilai input dengan tanggal hari ini
                                                        document.getElementById('tanggal').value = today;
                                                    </script>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jenis_service" class="col-sm-2 col-form-label">Jenis Service</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="jenis_service" id="jenis_service">
                                                        <option value="">--Pilih Jenis Service--</option>
                                                        <option value="service-marketplace">Transaksi Marketplace / Pembelian Vinorious</option>
                                                        <option value="service-offline">Transaksi Non Pembelian Vinorious</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Input 3 -->
                                            <div class="form-group row" id="input-invoice">
                                                <label for="invoice" class="col-sm-2 col-form-label">Invoice :</label>
                                                <div class="input-group mt-2 col-sm-10">
                                                    <input type="text" class="form-control" value="" id="invoice" name="invoice" placeholder="Cari Invoice.." aria-label="Search for..." readonly>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary ti-search" type="button" data-toggle="modal" id="btn-cari-barang-return" data-target="" onclick="addinvoice_return()"></button>
                                                        <!-- data-toggle="modal" data-target="#exampleModal" -->
                                                    </span>
                                                </div>

                                            </div>

                                            <div class="form-group row" id="input-ref">
                                                <label for="ref" class="col-sm-2 col-form-label">Ref:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="ref" id="ref" placeholder="" value="" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-garansi">
                                                <label for="garansi" class="col-sm-2 col-form-label">Tanggal Beli:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="garansi" id="garansi" placeholder="" value="" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-diterima-dari">
                                                <label for="diterima_dari" class="col-sm-2 col-form-label">Diterima dari:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="diterima_dari" id="diterima_dari" placeholder="Masukkan nama..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-no-hp">
                                                <label for="no_hp" class="col-sm-2 col-form-label">No. HP:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" name="no_hp" id="no_hp" placeholder="Masukkan No. HP..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-barang">
                                                <label for="namabarang" class="col-sm-2 col-form-label">Barang:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="namabarang" id="namabarang" placeholder="Masukan nama barang..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-qty-barang">
                                                <label for="qty_barang_return" class="col-sm-2 col-form-label">Qty:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" name="qty_barang_return" id="qty_barang_return" placeholder="Masukkan jumlah barang..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-barang">
                                                <label for="kelengkapan" class="col-sm-2 col-form-label">Kelengkapan:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="kelengkapan" id="kelengkapan" placeholder="Masukan kelengkapan..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-barang">
                                                <label for="kerusakan" class="col-sm-2 col-form-label">Kerusakan:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="kerusakan" id="kerusakan" placeholder="Masukan kerusakan..." value="">
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="text-center mt-3">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-service" onclick="saveFormData()">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card m-b-30" id="card-preview-return" style="display: none;">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Preview</h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p id="title-no-return"></p>
                                            </div>
                                            <div class="col-sm-4">
                                                <p id="title-diterima-return"></p>
                                            </div>
                                            <div class="col-sm-4">
                                                <p id="title-hp-return"></p>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Barang</th>
                                                        <th>QTY</th>
                                                        <th>Kelengkapan</th>
                                                        <th>Kerusakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl-preview-return">

                                                </tbody>
                                            </table>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary waves-effect waves-light mt-3" id="btn-return-print" onclick="printFormData()">Print</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div> <!-- end col -->


                            <!-- Modal daftar barang invoice pj untuk ke retur -->
                            <div class="modal fade" id="Modal-return-cari-barang" tabindex="-1" role="dialog" aria-labelledby="ModalServiceLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalServiceLabel">Daftar Transaksi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm mb-0" id="tbl-daftarbrg-retur" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No. Invoice</th>
                                                            <th>Tanggal</th>
                                                            <th>Referensi</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="btn-close-modal-retur-namabarang" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal daftar barang transaksi untuk pembelian dari vinorious -->
                            <div class="modal fade" id="Modal-detail-transaksi-addretur" tabindex="-1" role="dialog" aria-labelledby="ModalServiceLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalServiceLabel">Detail transaksi <p id="retur-no-invoice"></p>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="detail-trx-retur">
                                                No. Invoice: <p id="retur-no-invoice2"></p>
                                                Sales: <p id="retur-sales"></p>
                                                Nama: <p id="retur-namacust"></p>
                                                Tanggal Beli: <p id="retur-tglbeli"></p>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm mb-0" id="tbl-viewbrg-input-retur" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Barang</th>
                                                            <th>QTY</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="btn-close-modal-retur-namabarang" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal view retur / service -->
                            <div class="modal fade" id="Modal-view-return" tabindex="-1" role="dialog" aria-labelledby="ModalServiceLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalServiceLabel">Detail Data Return / Service</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="info-box">
                                                <div class="info-box-content">
                                                    No Nota: <b><span id="retur-nota-service">-</span></b><br>
                                                    Tanggal Terima: <b><span id="retur-tanggal-terima">-</span></b><br>
                                                    Sales Ref: <b><span id="retur-noref">-</span></b><br>
                                                    Tanggal Beli: <b><span id="retur-tgl-beli">-</span></b><br>
                                                    No HP: <b><span id="retur-hp">-</span></b><br>
                                                    Nama Pengirim: <b><span id="retur-nama">-</span></b>
                                                </div>
                                            </div>
                                            <h6>Daftar Barang:</h6>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm mb-0" id="tbl-view-return" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Barang</th>
                                                            <th>Jumlah</th>
                                                            <th>Kelengkapan</th>
                                                            <th>Kerusakan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="isi-tbl-view-return">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="btn-close-modal-retur-namabarang" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm mb-0" id="tbl-daftar-return" width="100%">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>No. Surat</th>
                                                        <th>Tanggal</th>
                                                        <th>No. Ref</th>
                                                        <th>Pengirim</th>
                                                        <th>HP</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi-tbl-daftar-return">

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->

                    </div> <!-- end row -->

                    <!-- //MODAL EDIT STATUS RETURN -->
                    <div class="modal fade" id="ModalEditStatusReturn" tabindex="-1" role="dialog" aria-labelledby="ModalEditStatusReturn" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalEditStatusReturn">Edit Status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body-return-edit">
                                    <form action="" method="POST" id="form-edit-status-return">
                                        <input type="text" name="edit_return_id" id="edit_return_id" value="" hidden>

                                        <select class="form-control" name="edit_return_status" id="edit_return_status">
                                            <option value="">Pilih Status</option>
                                            <option value="on process">on process</option>
                                            <option value="selesai">selesai</option>
                                            <option value="reject">reject</option>
                                        </select>
                                        <button type="button" class="btn btn-primary waves-effect waves-light mt-3 btn-save-edit-status-return" id="btn-save-edit-status-return" style="display: block; margin: 0 auto;" onclick="saveEditStatusReturn()">Save</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

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