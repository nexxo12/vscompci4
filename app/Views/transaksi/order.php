<?php

/**
 * @var string $title
 * @var string $date
 */
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= $title; ?></title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?= $this->include('layout/header_head'); ?>
    <style>
        .live-indicator {
            display: inline-block;
            width: 11px;
            height: 11px;
            background-color: #dc3545;
            border-radius: 50%;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .live-indicator::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #dc3545;
            border-radius: 50%;
            animation: live-pulse 1.5s infinite ease-out;
        }

        /* Status saat koneksi terputus / offline */
        .live-indicator.offline {
            background-color: #6c757d;
        }

        .live-indicator.offline::after {
            animation: none;
            opacity: 0;
        }

        @keyframes live-pulse {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            100% {
                transform: scale(2.6);
                opacity: 0;
            }
        }
    </style>

</head>

<body>
    <!-- Tombol Kontrol Suara Notifikasi -->
    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
            <h5 class="mb-2 mb-md-0 d-flex align-items-center">
                Live List Order
                <span id="live-dot" class="live-indicator ml-2" title="Live Monitoring Aktif"></span>
            </h5>

            <div class="d-flex align-items-center">
                <!-- Filter Tanggal (Default Hari Ini) -->
                <label for="filter_tanggal_order" class="small font-weight-bold mr-2 mb-0">Tanggal:</label>
                <input type="date" id="filter_tanggal_order" class="form-control form-control-sm mr-2" style="width: 155px;" value="<?= date('Y-m-d') ?>" readonly>

                <!-- Indikator & Tombol Tes Suara -->
                <button type="button" id="btn-toggle-sound" class="btn btn-sm btn-success text-nowrap" title="Klik untuk tes atau matikan suara">
                    <i class="fa fa-volume-up mr-1"></i> Suara Aktif
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" id="tbl-live-order">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Keterangan / Invoice MP</th>
                            <th>Grand Total</th>
                            <th>Status</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?= $this->include('layout/footer_js'); ?>
<script src="/assets/js/liveorder.js"></script>

</html>