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
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">ID Transaksi</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" id="id_buy" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                            <div class="col-sm-10">
                                                <div class="input-group mt-2">
                                                    <input type="text" class="form-control" id="barang_buy" placeholder="Nama Barang" aria-label="Nama Barang" readonly>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Cari</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Satuan</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="unit" id="satuan_buy">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="number" id="jumlah_buy">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Harga Beli</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" id="price_buy">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Supplier</label>
                                            <div class="col-sm-10">
                                                <select class="custom-select" id="supp_buy">
                                                    <option selected>Pilih...</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Tanggal</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" id="example-text-input" readonly>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary waves-effect waves-light">Simpan</button>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title">History Pembelian:</h4>
                                        <table id="datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Office</th>
                                                    <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                    <td>2011/04/25</td>
                                                    <td>$320,800</td>
                                                </tr>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                    <td>2011/04/25</td>
                                                    <td>$320,800</td>
                                                </tr>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                    <td>2011/04/25</td>
                                                    <td>$320,800</td>
                                                </tr>
                                            </tbody>
                                        </table>

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

    </div>
    <!-- END wrapper -->
    <?= $this->include('layout/footer_js'); ?>
</body>

</html>