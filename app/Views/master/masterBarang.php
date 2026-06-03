<?php

/**
 * @var string $tittle
 * @var array $kategori
 */
?>
<!DOCTYPE html>
<html>

asdasd

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
                                            <li class="breadcrumb-item active">Master Barang</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Master Barang</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title">Input Master Barang</h4>
                                        <form action="" method="POST" id="form-masterbarang">
                                            <!-- Input 1 -->
                                            <div class="form-group row">
                                                <label for="idbarang" class="col-sm-2 col-form-label">Kode :</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="idbarang" id="idbarang" readonly value="">
                                                </div>
                                            </div>

                                            <!-- Input 2 -->
                                            <div class="form-group row">
                                                <label for="namabarang" class="col-sm-2 col-form-label">Barang :</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="namabarang" id="namabarang" placeholder="Masukkan nama barang..." value="">
                                                </div>
                                            </div>

                                            <!-- Input 3 -->
                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-2 col-form-label">Kategori :</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <select class="form-control" name="kategori" id="kategori">
                                                            <option value="">-- Pilih Kategori --</option>
                                                            <?php foreach ($kategori as $k) : ?>
                                                                <option value="<?= $k['ID_KATEGORI']; ?>"><?= $k['KATEGORI']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary waves-effect waves-light" type="button" id="btn_kategori" onclick="add_kategori()">Add New</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="text-center mt-3">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-masterbarang" onclick="">Submit</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Manage Kategori</h4>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="tbl-masterbarang">
                                                <thead>
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kategori</th>
                                                        <th>Stok</th>
                                                        <th>Satuan</th>
                                                        <th>Harga Jual</th>
                                                        <!-- <th>Harga Jual</th> -->
                                                        <th>Total Stok</th>
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

                        </div> <!-- end row -->

                        <!-- modal edit barang -->
                        <div class="modal fade" id="modal-edit-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" id="form-edit-barang">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Kode</label>
                                                        <input type="text" class="form-control" name="kode-barang-edit" id="kode-barang-edit" value="" readonly>
                                                        <label for="exampleInputEmail1">Nama Barang</label>
                                                        <input type="text" class="form-control" name="nama-barang-edit" id="nama-barang-edit" value="">
                                                        <label for="exampleInputEmail1">Kategori</label>
                                                        <select class="form-control" name="kategori-barang-edit" id="kategori-barang-edit">
                                                            <option value="">-- Pilih Kategori --</option>
                                                            <?php foreach ($kategori as $k) : ?>
                                                                <option value="<?= $k['ID_KATEGORI']; ?>"><?= $k['KATEGORI']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <input type="text" class="form-control" name="satuan-barang-edit" id="satuan-barang-edit" value="Unit" hidden>
                                                        <label for="exampleInputEmail1">Stok</label>
                                                        <input type="number" class="form-control" name="stok-barang-edit" id="stok-barang-edit" value="0">
                                                        <label for="exampleInputEmail1">Harga Beli Terbaru</label>
                                                        <input type="number" class="form-control" name="harga-beli-terbaru-edit" id="harga-beli-terbaru-edit" value="0">
                                                        <label for="exampleInputEmail1">Harga Jual Rekomendasi</label>
                                                        <input type="number" class="form-control" name="harga-jual-rekomendasi-edit" id="harga-jual-rekomendasi-edit" value="0">
                                                        <div class="text-center mt-3">
                                                            <button type="button" class="btn btn-primary" id="save-edit-barang" onclick="save_edit_barang()">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Biaya Kurang (-)</label>
                                                        <input type="number" class="form-control" name="biayamin-laporan-edit" id="biayamin-laporan-edit" value="0">
                                                        <label for="exampleInputEmail1">Biaya Lebih (+)</label>
                                                        <input type="number" class="form-control" name="biayaplus-laporan-edit" id="biayaplus-laporan-edit" value="0">
                                                        <label for="exampleInputEmail1">Biaya Admin</label>
                                                        <input type="number" class="form-control" name="biayaadm-laporan-edit" id="biayaadm-laporan-edit" value="0">
                                                        <label for="exampleInputEmail1">Laba</label>
                                                        <input type="number" class="form-control" name="laba-laporan-edit" id="laba-laporan-edit" value="" readonly>

                                                        <br>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal edit barang -->

                        <!-- modal edit kategori -->
                        <div class="modal fade" id="modal-kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-scrollable modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Kategori</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" id="form-add-kategori">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Kategori</label>
                                                        <input type="text" class="form-control" name="input-kategori" id="input-kategori" value="">
                                                        <div class="text-center mt-3">
                                                            <button type="button" class="btn btn-primary" id="save-kategori" onclick="save_kategori()">Save</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal edit kategori -->


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