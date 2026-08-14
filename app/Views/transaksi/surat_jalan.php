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
                                            <li class="breadcrumb-item active">Surat Jalan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Surat Jalan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h4 class="mt-0 header-title mb-0">Buat Surat Jalan Service</h4>
                                            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-suratjalan-service">Daftar Surat Jalan</button>
                                            <!-- <a href="" class="btn btn-outline-primary btn-sm" id="btn-suratjalan-service">Daftar Surat Jalan</a> -->
                                        </div>
                                        <form action="" method="POST" id="form-suratjalan-service">
                                            <!-- Input 1 -->
                                            <div class="form-group row">
                                                <label for="no_surat" class="col-sm-2 col-form-label">No Surat:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="no_suratservice" id="no_suratservice" readonly value="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal :</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="date" name="tanggal-surat-service" id="tanggal-surat-service" placeholder="Masukkan tanggal..." value="">
                                                    <script>
                                                        // Mendapatkan tanggal hari ini (format YYYY-MM-DD)
                                                        const today = new Date(new Date().getTime() + 7 * 60 * 60 * 1000).toISOString().split('T')[0];

                                                        // Mengisi nilai input dengan tanggal hari ini
                                                        document.getElementById('tanggal-surat-service').value = today;
                                                    </script>
                                                </div>
                                            </div>
                                            <!-- Input 3 -->
                                            <div class="form-group row" id="input-diterima-dari">
                                                <label for="diterima_dari" class="col-sm-2 col-form-label">Kepada:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="kepada-suratjalan-service" id="kepada-suratjalan-service" placeholder="Masukkan nama..." value="RMA-">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-barang">
                                                <label for="namabarang" class="col-sm-2 col-form-label">Barang:</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control select2" name="sj-service-namabarang" id="sj-service-namabarang" data-placeholder="Pilih barang...">

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-barang">
                                                <label for="kelengkapan" class="col-sm-2 col-form-label">Jumlah:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" name="sj-service-qty" id="sj-service-qty" placeholder="Masukan jumlah..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-barang">
                                                <label for="kelengkapan" class="col-sm-2 col-form-label">Kelengkapan:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="kelengkapan-suratjalan-service" id="kelengkapan-suratjalan-service" placeholder="Masukan kelengkapan..." value="">
                                                </div>
                                            </div>
                                            <div class="form-group row" id="input-barang">
                                                <label for="serial_number" class="col-sm-2 col-form-label">SN:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="serialnumber-suratjalan-service" id="serialnumber-suratjalan-service" placeholder="Masukan serial number..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-barang">
                                                <label for="kerusakan" class="col-sm-2 col-form-label">Kerusakan:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="kerusakan-suratjalan-service" id="kerusakan-suratjalan-service" placeholder="Masukan kerusakan..." value="">
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="text-center mt-3">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-tambah-suratjalan-service" onclick="">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h4 class="mt-0 header-title mb-0">Buat Surat Jalan Pengiriman</h4>
                                            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-suratjalan-pengiriman">Daftar Surat Jalan</button>
                                            <!-- <a href="" class="btn btn-outline-primary btn-sm">Daftar Surat Jalan</a> -->
                                        </div>
                                        <form action="" method="POST" id="form-pengiriman">
                                            <!-- Input 1 -->
                                            <div class="form-group row">
                                                <label for="no_surat" class="col-sm-2 col-form-label">No Surat:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="no_suratpengiriman" id="no_suratpengiriman" readonly value="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tanggal2" class="col-sm-2 col-form-label">Tanggal :</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="date" name="tanggal2" id="tanggal2" placeholder="Masukkan tanggal..." value="">
                                                    <script>
                                                        // Mendapatkan tanggal hari ini (format YYYY-MM-DD)
                                                        const today2 = new Date(new Date().getTime() + 7 * 60 * 60 * 1000).toISOString().split('T')[0];
                                                        // Mengisi nilai input dengan tanggal hari ini
                                                        document.getElementById('tanggal2').value = today2;
                                                    </script>
                                                </div>
                                            </div>
                                            <!-- Input 3 -->
                                            <div class="form-group row" id="input-diterima-dari">
                                                <label for="diterima_dari" class="col-sm-2 col-form-label">Kepada:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="suratkirim_kepada" id="suratkirim_kepada" placeholder="Masukkan nama..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-alamat">
                                                <label for="alamat" class="col-sm-2 col-form-label">Alamat & HP:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="alamat" id="alamat" placeholder="Masukan alamat..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-barang">
                                                <label for="namabarang" class="col-sm-2 col-form-label">Barang:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="barang_kirim" id="barang_kirim" placeholder="Masukan nama barang..." value="">
                                                </div>
                                            </div>
                                            <div class="form-group row" id="input-serial-number">
                                                <label for="serial_number" class="col-sm-2 col-form-label">Keterangan:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="serial_number" id="serial_number" placeholder="Masukan serial number..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-kerusakan">
                                                <label for="kerusakan" class="col-sm-2 col-form-label">Total Coly:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="kerusakan" id="kerusakan" placeholder="Masukan kerusakan..." value="">
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="text-center mt-3">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-suratjalan_service" onclick="">Submit</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6" id="preview-sj-service" style="display: none;">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Preview</h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p id="title-no-surat"></p>
                                            </div>
                                            <div class="col-sm-4">
                                                <p id="title-kpd-surat"></p>
                                            </div>
                                            <div class="col-sm-4">
                                                <p id="title-tgl-surat"></p>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Barang</th>
                                                        <th>QTY</th>
                                                        <th>S/N</th>
                                                        <th>Kelengkapan</th>
                                                        <th>Kerusakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl-preview-suratjalan-service">

                                                </tbody>
                                            </table>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary waves-effect waves-light mt-3" id="btn-suratjalan-service-print">Print</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6" id="preview-sj-pengiriman" style="display: none;">
                                <div class="card m-b-30">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title">Preview</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Detail</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>No. Surat</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Customer</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Coly</td>
                                                        <td>-</td>
                                                    </tr>
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

            ..

            <?= $this->include('layout/footerc'); ?>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->

    <!-- Modal Daftar Surat Jalan Service -->
    <div class="modal fade" id="ModalSuratJalan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Surat Jalan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-sj">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mb-0" id="tbl-daftar-suratjalan" width="100%">
                            <thead>
                                <tr>
                                    <th>No. Surat</th>
                                    <th>Tanggal</th>
                                    <th>Kepada</th>
                                    <th>Barang</th>
                                    <th>Kerusakan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="">

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

    <!-- //MODAL EDIT SURAT JALAN SERVICE -->
    <div class="modal fade" id="ModalEditSuratJalan" tabindex="-1" role="dialog" aria-labelledby="ModalEditSuratJalan" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditSuratJalan">Edit Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-sj-edit">
                    <form action="" method="POST" id="form-edit-suratjalan-service">
                        <input type="text" name="edit_suratjalan_id" id="edit_suratjalan_id" hidden>

                        <select class="form-control" name="edit_suratjalan_status" id="edit_suratjalan_status">
                            <option value="">Pilih Status</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Potong Nota">Potong Nota</option>
                            <option value="Reject">Reject</option>
                        </select>
                        <button type="button" class="btn btn-primary waves-effect waves-light mt-3 btn-save-edit-suratjalan-service" id="btn-save-edit-suratjalan-service" style="display: block; margin: 0 auto;">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layout/footer_js'); ?>
</body>

</html>