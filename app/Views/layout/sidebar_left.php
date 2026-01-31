<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="<?= base_url() ?>" class="logo">VSKomputer</a>
            <!-- <a href="index.html" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>

                <li>
                    <a href="/" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span> Dashboard</span>
                    </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-swap"></i><span> Transaksi </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="/transaksi/pembelian"><i class="mdi mdi-currency-usd"></i>Pembelian</a></li>
                        <li><a href="/transaksi/penjualan"><i class="mdi mdi-cart"></i>Penjualan</a></li>
                        <li><a href="/transaksi/return_service"><i class="mdi mdi-wrench"></i>Return / Service</a></li>
                        <li><a href="/transaksi/surat_jalan"><i class="mdi mdi-truck-delivery"></i>Surat Jalan</a></li>
                        <li><a href="/transaksi/garansi"><i class="mdi mdi-timer"></i>Garansi</a></li>
                    </ul>
                </li>

            </ul>
            <hr>
            <ul>
                <li class="menu-title">Master</li>
                <li>
                    <a href="/master_barang" class="waves-effect">
                        <i class="mdi mdi-package"></i>
                        <span>Master Barang</span>
                    </a>
                </li>
                <li>
                    <a href="/master_customer" class="waves-effect">
                        <i class="mdi mdi-account-multiple-plus"></i>
                        <span>Master Customer</span>
                    </a>
                </li>
                <li>
                    <a href="/master_supplier" class="waves-effect">
                        <i class="mdi mdi-truck-delivery"></i>
                        <span>Master Supplier</span>
                    </a>
                </li>
            </ul>
            <hr>
            <ul>
                <li class="menu-title">Finance</li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-multiple"></i> <span> Karyawan </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="/karyawan/add"><i class="mdi mdi-account-multiple-plus"></i>Tambah Karyawan</a></li>
                        <li><a href="/karyawan/pengaturan"><i class="mdi mdi-account-settings-variant"></i>Pengaturan</a></li>
                        <li><a href="/karyawan/gaji"><i class="mdi mdi-cash-usd"></i>Gaji</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-book-open-page-variant"></i> <span> Laporan </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="/laporan/penjualan"><i class="mdi mdi-currency-usd"></i>Penjualan</a></li>
                        <li><a href="/laporan/pembelian"><i class="mdi mdi-currency-usd"></i>Pembelian</a></li>
                        <li><a href="/laporan/laba"><i class="mdi mdi-currency-usd"></i>Laba</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->