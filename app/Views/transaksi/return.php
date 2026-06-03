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
                                                        <option value="service-marketplace">Transaksi Marketplace</option>
                                                        <option value="service-offline">Transaksi Offline</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Input 3 -->
                                            <div class="form-group row" id="input-invoice">
                                                <label for="invoice" class="col-sm-2 col-form-label">Invoice :</label>
                                                <div class="input-group mt-2 col-sm-10">
                                                    <input type="text" class="form-control" value="" id="invoice" name="invoice" placeholder="Cari Invoice.." aria-label="Search for...">
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary ti-search" type="button" data-toggle="modal" data-target="#Modalcaribrg" onclick=""></button>
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
                                                    <input class="form-control" type="text" name="no_hp" id="no_hp" placeholder="Masukkan No. HP..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="input-barang">
                                                <label for="namabarang" class="col-sm-2 col-form-label">Barang:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="namabarang" id="namabarang" placeholder="Masukan nama barang..." value="">
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
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-service" onclick="">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <!-- Modal Service -->
                            <div class="modal fade" id="ModalService" tabindex="-1" role="dialog" aria-labelledby="ModalServiceLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalServiceLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda ingin mencetak dokumen ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="btn-close-modal" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="btn-print" class="btn btn-primary" onclick="window.print()">Print</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title">Daftar Service</h4>
                                        <p class="text-muted m-b-30 font-14">Prism is a lightweight, extensible syntax highlighter, built with modern web standards in mind.</p>

                                    </div>
                                </div>
                            </div> <!-- end col -->

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