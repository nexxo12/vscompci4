<!-- jQuery  -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<!-- <script src="/assets/js/bootstrap.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="/assets/js/modernizr.min.js"></script>
<script src="/assets/js/detect.js"></script>
<script src="/assets/js/fastclick.js"></script>
<script src="/assets/js/jquery.slimscroll.js"></script>
<script src="/assets/js/jquery.blockUI.js"></script>
<script src="/assets/js/waves.js"></script>
<script src="/assets/js/jquery.nicescroll.js"></script>
<script src="/assets/js/jquery.scrollTo.min.js"></script>
<script src="/assets/js/masterbarang.js"></script>
<script src="/assets/js/returnservice.js"></script>
<script src="/assets/js/suratjalan.js"></script>
<script src="/assets/js/pembelian.js"></script>
<script src="/assets/js/bukukas.js"></script>
<script src="/assets/js/karyawan.js"></script>
<script src="/assets/js/laporanPembelian.js"></script>
<script src="/assets/js/laporanPenjualan.js"></script>
<script src="/assets/js/penjualan.js"></script>
<script src="/assets/plugins/skycons/skycons.min.js"></script>
<script src="/assets/plugins/raphael/raphael-min.js"></script>
<script src="/assets/plugins/morris/morris.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

<!-- Required datatable js -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script> -->

<!-- Buttons examples -->
<script src="/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables/jszip.min.js"></script>
<script src="/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="/assets/plugins/datatables/vfs_fonts.js"></script>
<script src="/assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="/assets/plugins/datatables/buttons.print.min.js"></script>
<script src="/assets/plugins/datatables/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="/assets/pages/datatables.init.js"></script>
<script src="/assets/pages/dashborad.js"></script>

<!-- Plugins js -->
<script src="/assets/plugins/timepicker/moment.js"></script>
<script src="/assets/plugins/timepicker/tempusdominus-bootstrap-4.js"></script>
<script src="/assets/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
<script src="/assets/plugins/clockpicker/jquery-clockpicker.min.js"></script>
<script src="/assets/plugins/colorpicker/jquery-asColor.js" type="text/javascript"></script>
<script src="/assets/plugins/colorpicker/jquery-asGradient.js" type="text/javascript"></script>
<script src="/assets/plugins/colorpicker/jquery-asColorPicker.min.js" type="text/javascript"></script>
<script src="/assets/plugins/select2/select2.min.js" type="text/javascript"></script>

<script src="/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

<!-- Sweet-Alert  -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Plugins Init js -->
<script src="/assets/pages/form-advanced.js"></script>

<!-- App js -->
<script src="/assets/js/app.js"></script>
<script>
    /* BEGIN SVG WEATHER ICON */
    if (typeof Skycons !== 'undefined') {
        var icons = new Skycons({
                "color": "#fff"
            }, {
                "resizeClear": true
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);
        icons.play();
    };

    // scroll

    $(document).ready(function() {

        $("#boxscroll").niceScroll({
            cursorborder: "",
            cursorcolor: "#cecece",
            boxzoom: true
        });
        $("#boxscroll2").niceScroll({
            cursorborder: "",
            cursorcolor: "#cecece",
            boxzoom: true
        });

    });
</script>

<!-- SCRIPT DATATABLE DATA GARANSI -->
<script type="text/javascript">
    $(document).ready(function() {
        table_garansi = $('#tbl-garansi').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= base_url("/transaksi/viewdata_garansi") ?>',
            type: 'POST',
            // columnDefs: [{
            //         targets: [3, 4, 5, 6, 7, 8],
            //         render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
            //     },
            //     {
            //         render: function(data, type, row) {
            //             return row.view + ' ' + row.action + ' ' + row.print + ' ' + row.delete;
            //         },
            //         targets: 9 // Target kolom indeks
            //     }
            // ],
            columns: [{
                    data: 'id_inv',
                },
                {
                    data: 'TGL_TRX'
                },
                {
                    data: 'inv_ol'
                },

                {
                    data: 'edit'
                },
            ]
        });
    });
</script>

<!-- SCRIPT SHOW DATA GARANSI WHERE INVOICE -->
<script type="text/javascript">
    function show_garansi() {
        $(".view-garansi").click(function(e) {
            e.preventDefault();
            $("#button-save-garansi").prop('disabled', false);
            $.ajax({
                type: "POST",
                async: false,
                url: $(this).attr('href'),
                dataType: "JSON",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                beforeSend: function() {
                    $('#loading-data-garansi').show(0);
                },
                success: function(result) {
                    // console.log(result);
                    var html = '';
                    for (var i = 0; i < result.length; i++) {
                        var today = new Date();
                        today.setHours(0, 0, 0, 0);
                        var tgl_habis = new Date(result[i].TGL_HABIS);
                        var timeDiff = tgl_habis.getTime() - today.getTime();
                        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                        console.log(diffDays);
                        html += '<tr>' +
                            '<td><input type="text" name="id_penjualan[]" style="border: none; outline: none; width: 100%; box-sizing: border-box;" value="' + result[i].ID_PENJUALAN + '" readonly></td>' +
                            '<td ><input type="text" name="inv_penjualan[]" style="border: none; outline: none; width: 110%;" value="' + result[i].INV_PENJUALAN + '" readonly></td>' +
                            '<td>' + result[i].NAMA_BARANG + '</td>' +
                            '<td>' + result[i].TGL_BELI + '</td>' +
                            '<td><input type="text" name="tgl_habis[]" style="border: none; outline: none; width: 100%; box-sizing: border-box;" value="' + result[i].TGL_HABIS + '"></td>' +
                            '<td>' + (diffDays < 0 || isNaN(diffDays) ? '<span class="badge badge-danger">Garansi OFF</span>' : '<span class="badge badge-success">Garansi ON</span>') + '</td>' +
                            '</tr>';
                    }
                    $('#tbl-data-garansi').html(html);
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                },

                complete: function() {
                    $('#loading-data-garansi').hide(0);
                }

            })
        })

    }
</script>
<!-- END SCRIPT SHOW DATA GARANSI WHERE INVOICE -->

<!-- SCRIPT UPDATE DATA GARANSI -->
<script type="text/javascript">
    function update_garansi() {
        // $('data-garansi').submit(function(e) {
        //     e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/transaksi/update_garansi',
            data: $('#data-garansi').serializeArray(),
            dataType: "JSON",
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            beforeSend: function() {
                // 1. Tampilkan loading, sembunyikan teks
                $('#loading-simpan').show();
                $('#text-simpan').hide();
                // 2. Nonaktifkan tombol
                $('#save-edit-invoice').prop('disabled', true);
            },
            success: function(result) {
                // console.log(result);
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Perubahan berhasil disimpan",
                    showConfirmButton: false,
                    timer: 1000
                });
                $('#loading-simpan').hide();
                $('#text-simpan').show();
                $('#save-edit-invoice').prop('disabled', false);
                table_laporan.ajax.reload(null, false); //reload datatable tanpa reset paging
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            },
            complete: function() {
                // Proses selesai
                $('#save-edit-invoice').removeAttr('disabled'); // Aktifkan kembali
                $('#text-simpan').show(); // Tampilkan teks simpan
                $('#loading-simpan').hide(); // Sembunyikan loader
            }
        })
        // });


    }
</script>
<!-- END SCRIPT UPDATE DATA GARANSI -->

<!-- END PAGE GARANSI -->

<!-- END PAGE PENJUALAN-->