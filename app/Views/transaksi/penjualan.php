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
                                            <li class="breadcrumb-item active">Penjualan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Penjualan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <form action="" id="form_addchart">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card m-b-30">
                                                        <div class="card-body">

                                                            <h4 class="mt-0 header-title">Detail Barang</h4>
                                                            <br><br>
                                                            <div class="form-group row">
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">Invoice :</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text" value="INV/<?= date('y'); ?><?= date('m'); ?>/VSC/<?= $autonumPJ; ?>" name="invoice" id="invoiceid" readonly>
                                                                </div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="barang" class="col-sm-2 mt-2 col-form-label">Barang :</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group mt-2">
                                                                        <input type="text" width="10%" value="" id="idpenjualan" name="idpenjualan" hidden>
                                                                        <input type="text" width="10%" value="" id="idbarang" name="idbarang" hidden>
                                                                        <input type="text" width="10%" value="" id="modalbarang" name="modalbarang" hidden>
                                                                        <input type="text" width="10%" value="" id="stokdb" hidden>
                                                                        <input type="text" class="form-control" id="namabarang" name="namabarang" placeholder="Cari Barang.." aria-label="Search for..." readonly>
                                                                        <span class="input-group-append">
                                                                            <button class="btn btn-primary ti-search" type="button" data-toggle="modal" data-target="#Modalcaribrg"></button>
                                                                            <!-- data-toggle="modal" data-target="#exampleModal" -->
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Modal CARI BARANG-->
                                                            <div class="modal fade" id="Modalcaribrg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">List Barang</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="table-responsive">
                                                                                <table id="datatable_caribarang" class="table">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Kode</th>
                                                                                            <th>Nama Barang</th>
                                                                                            <th>Modal Rp.</th>
                                                                                            <th>Aksi</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="tb_caribarang">
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                        </tr>
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
                                                            <!-- End Modal -->
                                                            <div class="form-group row">
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">Qty :</label>
                                                                <div class="col-sm-5">
                                                                    <input class="form-control" type="number" value="" name="qty" id="qty" required>
                                                                </div>
                                                                <label for="example-text-input" class="col-sm-4 col-form-label">
                                                                    <div id="stokinfo">Stok: </div>
                                                                </label>

                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">Harga :</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="number" value="0" name="harga" id="harga">
                                                                </div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">DP :</label>
                                                                <div class="col-sm-4">
                                                                    <input class="form-control" type="number" value="" name="dp" id="example-text-input">
                                                                </div>
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">Diskon :</label>
                                                                <div class="col-sm-4">
                                                                    <input class="form-control" type="number" value="" name="diskon" id="example-text-input">

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-lg-6">
                                                    <div class="card m-b-30">
                                                        <div class="card-body">

                                                            <h4 class="mt-0 header-title">Info Customer</h4>
                                                            <br><br>
                                                            <div class="form-group row">
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">Date:</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="date" value="" name="tanggal" id="tanggal">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">Kasir :</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text" value="" name="kasir" id="example-text-input" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">Cust :</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-control" name="typecustomer" id="customer">
                                                                        <?php foreach ($showcustomer as $sc) : ?>
                                                                            <option value="<?= $sc['ID_PELANGGAN']; ?>"><?= $sc['NAMA']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="nama">
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama :</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text" value="" name="namacustomer" id="example-text-input" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="alamat">
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">Alamat :</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text" value="" name="alamat" id="example-text-input">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="refmp">
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">Ref MP :</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text" value="" placeholder="Optional..." name="refinv_mp" id="example-text-input">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-text-input" class="col-sm-2 col-form-label">Note :</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text" value="" placeholder="Optional..." name="catatan" id="example-text-input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="addchart btn btn-primary waves-effect waves-light" id="liveToastBtn">Add Chart</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div> <!-- end row -->

                        <!-- PAGE LIST BARANG CHECKOUT -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div id="custname1">Customer:</div>
                                        <div id="custname2">Nama:</div>
                                        <div class="table-responsive">
                                            <table class="table table-responsive-sm" id="table_listbarang">
                                                <thead class="thead-default">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama Barang</th>
                                                        <th>Harga Rp.</th>
                                                        <th>Qty</th>
                                                        <th>Subtotal</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="datachart">

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3">
                                                            <h6>Catatan: <div id="catatan"></div>
                                                            </h6>
                                                        </td>
                                                        <td style="text-align:right;">
                                                            <div>Diskon</div>
                                                        </td>
                                                        <td>
                                                            <div>Rp.</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="text-align:right;">
                                                            <div>Subtotal Rp.</div>
                                                        </td>
                                                        <td>
                                                            <div id="sTotal"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="text-align:right;">
                                                            <div>DP</div>
                                                        </td>
                                                        <td>
                                                            <div>Rp.</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="text-align:right;">
                                                            <h5>Total Rp.</h5>
                                                        </td>
                                                        <td>
                                                            <h5>
                                                                <div id="gTotal"></div>
                                                            </h5>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary waves-effect waves-light" id="liveToastBtn">Checkout</button>
                                        </div>
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