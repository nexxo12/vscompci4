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
                                        <form action="/Transaksi/savePembelian" method="POST" id="form-pembelian">
                                            <!-- TOAST -->
                                            <?php if (session()->getFlashData('pesan')) :  ?>
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong style="color: black;"><?= session()->getFlashData('pesan'); ?></strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                            <!-- END TOAST -->
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">ID Transaksi</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="id_pembelian" type="text" id="id_buy" value="BL-<?= date("d-m"); ?>-<?= $autonum; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group mt-2 ">
                                                        <!-- <input type="text" class="form-control" id="barang_buy" placeholder="Nama Barang" aria-label="Nama Barang"> -->
                                                        <select class="form-control select2 custom-select" data-live-search="true" name="idbarang">
                                                            <option selected>Cari Barang....</option>
                                                            <?php foreach ($showbarang as $show) : ?>
                                                                <option value="<?= $show['ID_BARANG']; ?>"><?= $show['NAMA_BARANG']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <!-- <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Add</button>
                                                    </span> -->
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
                                                    <input class="form-control" type="text" id="price_buy" name="hargabeli" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier</label>
                                                <div class="col-sm-10">
                                                    <select class="custom-select" id="supp_buy" name="id-supp">
                                                        <option selected>Pilih...</option>
                                                        <?php foreach ($supplier as $supp) : ?>
                                                            <option value="<?= $supp['ID_SUPP']; ?>"><?= $supp['NAMA']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="input_supp">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Supp</label>
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

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light" id="liveToastBtn">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Total Pembelian Tahun <?= date('Y'); ?></h4>
                                        <div class="card m-b-30 text-white card-primary">
                                            <div class="card-body">
                                                <blockquote class="card-bodyquote">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                                        erat a ante.</p>
                                                    <footer>Someone famous in <cite title="Source Title">Source Title</cite>
                                                    </footer>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title">History Pembelian:</h4>
                                        <div class="table-responsive">
                                            <table id="datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Inv</th>
                                                        <th>Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga Beli</th>
                                                        <th>Supplier</th>
                                                        <th>Supplier(MP)</th>
                                                        <th>Garansi</th>
                                                        <th>Input</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($showpembelian as $showbuy) : ?>
                                                        <tr>
                                                            <td><?= $showbuy['ID_BELI']; ?></td>
                                                            <td><?= $showbuy['NAMA_BARANG']; ?></td>
                                                            <td><?= $showbuy['JUMLAH']; ?></td>
                                                            <td><?= $showbuy['HARGA_BELI']; ?></td>
                                                            <td><?= $showbuy['NAMA']; ?></td>
                                                            <td><?= $showbuy['NamaSUPP']; ?></td>
                                                            <td><?= $showbuy['TGL_GARANSI']; ?></td>
                                                            <td><?= $showbuy['TGL_BELI']; ?></td>
                                                            <td><a href="<?= base_url('Transaksi/deletePembelian/' . $showbuy['ID_BELI']); ?>"><button type="button" class="btn btn-danger waves-effect waves-light ti-trash" id="liveToastBtn" onclick="return confirm('Are you sure ?')"></button></a></td>
                                                        </tr>
                                                    <?php endforeach; ?>
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