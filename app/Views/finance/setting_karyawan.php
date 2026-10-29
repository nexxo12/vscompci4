<!DOCTYPE html>
<html>
<?php
/**
 * @var string $tittle
 * @var mixed $jabatan
 */
?>

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
                                            <li class="breadcrumb-item active">Pengaturan Karyawan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Pengaturan Karyawan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <h5 class="mb-0">Tambah Karyawan</h5>
                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-1" id="btn-hide-karyawan" onclick="" style="display: none;"><span class="mdi mdi-minus-box mr-1"></span>Close</button>
                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-1" id="btn-add-karyawan" onclick=""><span class="mdi mdi-plus-box mr-1"></span>Tambah</button>
                                        </div>
                                        <form action="" method="POST" id="form-add-karyawan" class="mt-2" style="display:none">
                                            <!-- Input 1 -->
                                            <div class="form-group row">
                                                <label for="idbarang" class="col-sm-2 col-form-label">Jabatan :</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <select class="form-control" name="kategori-jabatan-karyawan" id="kategori-jabatan-karyawan">
                                                            <?php foreach ($jabatan as $jbt) : ?>
                                                                <option value="<?= $jbt['id_jabatan']; ?>"><?= $jbt['nama_jabatan']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Input 2 -->
                                            <div class="form-group row">
                                                <label for="namabarang" class="col-sm-2 col-form-label">NIK</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="nik-karyawan" id="nik-karyawan" placeholder="Masukkan nik..." value="">
                                                </div>
                                            </div>

                                            <!-- Input 3 -->
                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-2 col-form-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="nama-karyawan" id="nama-karyawan" placeholder="Masukkan nama..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="email" name="email-karyawan" id="email-karyawan" placeholder="Masukkan email (optional)..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-2 col-form-label">No HP</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" name="hp-karyawan" id="hp-karyawan" placeholder="Masukkan hp..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="date" name="tl-karyawan" id="tl-karyawan" value="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <select class="form-control" name="jenkel-karyawan" id="jenkel-karyawan">
                                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                                            <option value="Laki-Laki">Laki-Laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-2 col-form-label">Alamat</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="alamat-karyawan" id="alamat-karyawan" placeholder="Masukkan alamat..." value="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="date" name="tanggal-masuk-karyawan" id="tanggal-masuk-karyawan" value="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-2 col-form-label">Status Karyawan</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <select class="form-control" name="status-karyawan" id="status-karyawan">
                                                            <option value="">-- Pilih Status --</option>
                                                            <option value="Tetap">Tetap</option>
                                                            <option value="Kontrak">Kontrak</option>
                                                            <option value="Magang">Magang</option>
                                                            <option value="Resign">Resign</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="text-center mt-3">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-save-add-karyawan" onclick="">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <h5 class="mb-0">Setting Karyawan</h5>
                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-1" id="btn-hide-datakaryawan" onclick="" style="display: none;"><span class="mdi mdi-minus-box mr-1"></span>Close</button>
                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-1" id="btn-add-datakaryawan" onclick=""><span class="mdi mdi-plus-box mr-1"></span>Tampilkan Data</button>
                                        </div>
                                        <div class="table-responsive mt-2" id="data-karyawan" style="display: none;">
                                            <table class="table table-bordered table-striped no-wrap" id="tbl-setting-karyawan">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Departement</th>
                                                        <th>Jabatan</th>
                                                        <th>NIK</th>
                                                        <th>Email</th>
                                                        <th>HP</th>
                                                        <th>Tgl Lahir</th>
                                                        <th>Jenkel</th>
                                                        <th>Alamat</th>
                                                        <th>Tgl Masuk</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <h5 class="mb-0">Tambah Jabatan</h5>
                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-1" id="btn-hide-jabatan" onclick="" style="display: none;"><span class="mdi mdi-minus-box mr-1"></span>Close</button>
                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-1" id="btn-add-jabatan" onclick=""><span class="mdi mdi-plus-box mr-1"></span>Tambah</button>
                                        </div>
                                        <form action="" method="POST" id="form-add-jabatan" class="mt-2" style="display: none;">
                                            <!-- Input 2 -->
                                            <div class="form-group row">
                                                <label for="namabarang" class="col-sm-2 col-form-label">Departement</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="dept-jabatan" id="dept-jabatan" placeholder="Masukkan departement..." value="" required>
                                                </div>
                                            </div>

                                            <!-- Input 3 -->
                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-2 col-form-label">Nama Jabatan</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="nama-jabatan" id="nama-jabatan" placeholder="Masukkan nama jabatan..." value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-2 col-form-label">Gaji</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" name="gaji-jabatan" id="gaji-jabatan" placeholder="Masukkan gaji pokok..." value="" required>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="text-center mt-3">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-save-add-jabatan" onclick="">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <h5 class="mb-0">Setting Jabatan</h5>
                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-1" id="btn-hide-datajabatan" onclick="" style="display: none;"><span class="mdi mdi-minus-box mr-1"></span>Close</button>
                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-1" id="btn-add-datajabatan" onclick=""><span class="mdi mdi-plus-box mr-1"></span>Tampilkan Data</button>
                                        </div>
                                        <div class="table-responsive mt-2" id="data-jabatan" style="display:none;">
                                            <table class="table table-bordered table-striped" id="tbl-setting-jabatan">
                                                <thead>
                                                    <tr>
                                                        <th>Departement</th>
                                                        <th>Nama Jabatan</th>
                                                        <th>Gaji Jabatan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->
                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <footer class="footer">
                <?= $this->include('layout/footerc'); ?>
            </footer>

        </div>
        <!-- End Right content here -->
    </div>
    <!-- END wrapper -->
    <?= $this->include('layout/footer_js'); ?>
</body>

</html>