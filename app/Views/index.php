<?php

/**
 * @var string $tittle
 * @var array $totalpenjualan
 * @var array $totalpembelian
 * @var string $totalsupplier
 * @var string $totalbarang
 * @var array $totalhargaawal
 * @var array $totalpotongan
 * @var array $totalbiayamin
 * @var array $totalbiayaplus
 * @var array $penjualan
 * @var array $hargaawal
 * @var array $potongan
 * @var array $biayamin
 * @var array $biayaplus
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
                                            <li class="breadcrumb-item"><a href="#">VSKomputer</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->


                        <div class="row">
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="col-3 align-self-center">
                                                <div class="round">
                                                    <i class="mdi mdi-basket"></i>
                                                </div>
                                            </div>
                                            <div class="col-6 align-self-center text-center">
                                                <?php foreach ($totalpenjualan as $penjualan) : ?><?php endforeach; ?>
                                                <div class="m-l-10">
                                                    <h5 class="mt-0 round-inner"><?= number_format($penjualan['HARGA_JL'], 0, ',', '.'); ?></h5>
                                                    <p class="mb-0 text-muted">Total Penjualan <?= date('M'); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-3 align-self-end align-self-center">
                                                <h6 class="m-0 float-right text-center text-danger"> <i class="mdi mdi-arrow-down"></i> <span>5.26%</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="col-3 align-self-center">
                                                <div class="round">
                                                    <i class="mdi mdi-cash-multiple"></i>
                                                </div>
                                            </div>
                                            <div class="col-6 text-center align-self-center">
                                                <div class="m-l-10 ">
                                                    <?php foreach ($totalpenjualan as $penjualan) : ?><?php endforeach; ?>
                                                    <?php foreach ($totalhargaawal as $hargaawal) : ?><?php endforeach; ?>
                                                    <?php foreach ($totalpotongan as $potongan) : ?><?php endforeach; ?>
                                                    <?php foreach ($totalbiayamin as $biayamin) : ?><?php endforeach; ?>
                                                    <?php foreach ($totalbiayaplus as $biayaplus) : ?><?php endforeach; ?>
                                                    <h5 class="mt-0 round-inner">
                                                        <?= number_format($penjualan['HARGA_JL'] - $hargaawal['HARGA_AWAL'], 0, ',', '.'); ?>
                                                    </h5>
                                                    <p class="mb-0 text-muted">Total Laba Kotor <?= date('M'); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-3 align-self-end align-self-center">
                                                <h6 class="m-0 float-right text-center text-success"> <i class="mdi mdi-arrow-up"></i> <span>8.68%</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="col-3 align-self-center">
                                                <div class="round ">
                                                    <i class="mdi mdi-basket"></i>
                                                </div>
                                            </div>
                                            <div class="col-6 align-self-center text-center">
                                                <div class="m-l-10 ">
                                                    <?php foreach ($totalpembelian as $pembelian) : ?><?php endforeach; ?>
                                                    <h5 class="mt-0 round-inner"><?= number_format($pembelian['HARGA_BELI'], 0, ',', '.'); ?></h5>
                                                    <p class="mb-0 text-muted">Total Pembelian <?= date('M'); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-3 align-self-end align-self-center">
                                                <h6 class="m-0 float-right text-center text-danger"> <i class="mdi mdi-arrow-down"></i> <span>2.35%</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="col-3 align-self-center">
                                                <div class="round">
                                                    <i class="mdi mdi-rocket"></i>
                                                </div>
                                            </div>
                                            <div class="col-6 align-self-center text-center">
                                                <div class="m-l-10">
                                                    <?php foreach ($totalpotongan as $potongan) : ?><?php endforeach; ?>
                                                    <h5 class="mt-0 round-inner"><?= number_format($potongan['potongan'] + $biayaplus['laba_ongkir'] - $biayamin['ongkir'], 0, ',', '.'); ?></h5>
                                                    <p class="mb-0 text-muted">Total Potongan Admin <?= date('M'); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-3 align-self-end align-self-center">
                                                <h6 class="m-0 float-right text-center text-success"> <i class="mdi mdi-arrow-up"></i> <span>2.35%</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="col-3 align-self-center">
                                                <div class="round">
                                                    <i class="mdi mdi-basket"></i>
                                                </div>
                                            </div>
                                            <div class="col-6 align-self-center text-center">
                                                <div class="m-l-10">
                                                    <?php foreach ($totalpenjualan as $penjualan) : ?><?php endforeach; ?>
                                                    <?php foreach ($totalhargaawal as $hargaawal) : ?><?php endforeach; ?>
                                                    <?php foreach ($totalpotongan as $potongan) : ?><?php endforeach; ?>
                                                    <?php foreach ($totalbiayamin as $biayamin) : ?><?php endforeach; ?>
                                                    <?php foreach ($totalbiayaplus as $biayaplus) : ?><?php endforeach; ?>
                                                    <h5 class="mt-0 round-inner"><?= number_format($penjualan['HARGA_JL'] - $hargaawal['HARGA_AWAL'] + $biayaplus['laba_ongkir'] - $biayamin['ongkir'] - $potongan['potongan'], 0, ',', '.'); ?></h5>
                                                    <p class="mb-0 text-muted">Total Laba Bersih <?= date('M'); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-3 align-self-end align-self-center">
                                                <h6 class="m-0 float-right text-center text-danger"> <i class="mdi mdi-arrow-down"></i> <span>5.26%</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="col-3 align-self-center">
                                                <div class="round">
                                                    <i class="mdi mdi-cash-multiple"></i>
                                                </div>
                                            </div>
                                            <div class="col-6 text-center align-self-center">
                                                <div class="m-l-10 ">
                                                    <h5 class="mt-0 round-inner"><?= $totalsupplier; ?></h5>
                                                    <p class="mb-0 text-muted">Total Supplier</p>
                                                </div>
                                            </div>
                                            <div class="col-3 align-self-end align-self-center">
                                                <h6 class="m-0 float-right text-center text-success"> <i class="mdi mdi-arrow-up"></i> <span>8.68%</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="col-3 align-self-center">
                                                <div class="round ">
                                                    <i class="mdi mdi-basket"></i>
                                                </div>
                                            </div>
                                            <div class="col-6 align-self-center text-center">
                                                <div class="m-l-10 ">
                                                    <h5 class="mt-0 round-inner"><?= $totalbarang; ?></h5>
                                                    <p class="mb-0 text-muted">Total Barang</p>
                                                </div>
                                            </div>
                                            <div class="col-3 align-self-end align-self-center">
                                                <h6 class="m-0 float-right text-center text-danger"> <i class="mdi mdi-arrow-down"></i> <span>2.35%</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="col-3 align-self-center">
                                                <div class="round">
                                                    <i class="mdi mdi-rocket"></i>
                                                </div>
                                            </div>
                                            <div class="col-6 align-self-center text-center">
                                                <div class="m-l-10">
                                                    <h5 class="mt-0 round-inner"><?= $totalbarang; ?></h5>
                                                    <p class="mb-0 text-muted">Total Barang</p>
                                                </div>
                                            </div>
                                            <div class="col-3 align-self-end align-self-center">
                                                <h6 class="m-0 float-right text-center text-success"> <i class="mdi mdi-arrow-up"></i> <span>2.35%</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                        </div>
                        <!-- end row -->


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