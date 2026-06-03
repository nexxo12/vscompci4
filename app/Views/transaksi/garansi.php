<?php

/**
 * @var string $tittle
 */
?>
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
                                            <li class="breadcrumb-item active">Garansi</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Garansi</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Daftar Garansi</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="tbl-garansi">
                                                <thead>
                                                    <tr>
                                                        <th>Invoice</th>
                                                        <th>Tanggal Order</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Data Garansi</h4>
                                        <div class="spinner-border text-primary " role="status" id="loading-data-garansi" style="display:none;">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="table-responsive">
                                            <form action="" id="data-garansi">
                                                <table class="table table-bordered" id="">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 16%;">ID</th>
                                                            <th style="width: 20%;">Invoice</th>
                                                            <th>Barang</th>
                                                            <th>Tanggal Order</th>
                                                            <th style="width: 20%;">Tanggal Habis</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbl-data-garansi">
                                                    </tbody>
                                                </table>
                                            </form>
                                            <div style="display: flex; justify-content: center;">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="button-save-garansi" onclick="update_garansi()">
                                                    <span id="text-simpan">Save</span>
                                                    <span id="loading-simpan" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                                                </button>
                                            </div>
                                        </div>
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