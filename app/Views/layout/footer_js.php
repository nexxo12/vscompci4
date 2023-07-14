<!-- jQuery  -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<!-- <script src="/assets/js/bootstrap.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="/assets/js/modernizr.min.js"></script>
<script src="/assets/js/detect.js"></script>
<script src="/assets/js/fastclick.js"></script>
<script src="/assets/js/jquery.slimscroll.js"></script>
<script src="/assets/js/jquery.blockUI.js"></script>
<script src="/assets/js/waves.js"></script>
<script src="/assets/js/jquery.nicescroll.js"></script>
<script src="/assets/js/jquery.scrollTo.min.js"></script>

<script src="/assets/plugins/skycons/skycons.min.js"></script>
<script src="/assets/plugins/raphael/raphael-min.js"></script>
<script src="/assets/plugins/morris/morris.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

<!-- Required datatable js -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

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
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable_list').DataTable();
    });
</script> -->

<script type="text/javascript">
    $(document).ready(function() {
        $("#input_supp").attr("style", "display: none");
        var select = $('#supp_buy').val();

        $('#supp_buy').on('change', function() {
            if (this.value == 20207 || this.value == 20216) {
                $("#input_supp").attr("style", "visibility: visible");
            } else {
                $("#input_supp").attr("style", "display: none");
            }
        });

    });
</script>

<!-- PAGE PENJUALAN-->
<script type="text/javascript">
    $(".listbarang").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'), //data dikirim dari a href
            dataType: "JSON",
            success: function(result) {
                for (var i = 0; i < result.length; i++) {
                    $("#idbarang").val(result[i].ID_BARANG);
                    $("#namabarang").val(result[i].NAMA_BARANG);
                    // $("#id_brg").val(result[i].id_barang);
                    $('#exampleModal').modal('hide');

                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        })
    })
</script>
<script>
    $(document).ready(function() {
        loadcart();
        refreshidpj();
        $('#datatable_list').DataTable({
            processing: true,
            serverSide: true,
            // "bFilter": false,
            // "bLengthChange": false,
            // "bPaginate": false,
            // "bInfo": false,
            ajax: '/Transaksi/showstok',
            order: [],
            columnDefs: [{
                // targets: 0,
                orderable: false,
                "defaultContent": "-",
                "targets": "_all"
            }, ]
        });
    });
</script>
<script type="text/javascript">
    function refreshidpj() {
        $.ajax({
            type: "POST",
            async: false,
            url: '/Transaksi/refreshidpj',
            dataType: "JSON",
            success: function(result) {
                for (var i = 0; i < result.length; i++) {
                    var idpj = parseInt(result[i].ID_PENJUALAN);
                    idpj++;
                    $("#idpenjualan").val(idpj);

                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        })
    }

    // function listbarang() {
    //     $.ajax({
    //         type: "POST",
    //         async: false,
    //         url: '/Transaksi/showstok',
    //         dataType: "JSON",
    //         success: function(result) {
    //             var html = '';
    //             for (var i = 0; i < result.length; i++) {
    //                 var no = parseInt(i);
    //                 no++;
    //                 html += '<tr>' +
    //                     '<td>' + result[i].ID_BARANG + '</td>' +
    //                     '<td>' + result[i].NAMA_BARANG + '</td>' +
    //                     '<td>' + result[i].STOK + '</td>' +
    //                     '<td>' + result[i].HARGA_JUAL + '</td>' +
    //                     '<td><button class="btn btn-danger ti-trash" onclick="deletebrg()" value="' + result[i].ID_BARANG + '" type="button"></button></td>' +
    //                     '</tr>';
    //             }
    //             $('#ajax_listbarang').html(html);

    //         },
    //         error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
    //             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
    //         }
    //     })
    // }
</script>
<script type="text/javascript">
    function loadcart() {
        $.ajax({
            type: "POST",
            async: false,
            url: '/Transaksi/showlistbarang',
            dataType: "JSON",
            success: function(result) {
                var html = '';
                for (var i = 0; i < result.length; i++) {
                    var no = parseInt(i);
                    no++;
                    html += '<tr>' +
                        '<th>' + no + '</th>' +
                        '<td>' + result[i].NAMA_BARANG + '</td>' +
                        '<td>' + result[i].HARGA_JL + '</td>' +
                        '<td>' + result[i].JUMLAH_BELI + '</td>' +
                        '<td>' + result[i].TOTAL_HARGA + '</td>' +
                        '<td><button class="btn btn-danger ti-trash" onclick="deletebrg()" value="' + result[i].ID_PENJUALAN + '" type="button"></button></td>' +
                        '</tr>';
                }
                $('#datachart').html(html);

            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }


        })
    }
    $(".addchart").click(function(e) {
        e.preventDefault();
        $idbarang = $('#idbarang').val();
        $qty = $('#qty').val();
        if ($idbarang == '') {
            Swal.fire({
                title: 'Belum menambahkan barang!',
                icon: 'warning'
            })
        } else if ($qty == '') {
            Swal.fire({
                title: 'Belum input Qty!',
                icon: 'warning'
            })
        } else {
            $.ajax({
                type: "GET",
                url: '/Transaksi/addcart', //data dikirim dari form
                data: $("#form_addchart").serialize(),
                success: function() {
                    loadcart();
                    refreshidpj();
                    $('#qty').val('');
                    $('#namabarang').val('');
                    $('#harga').val(0);
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            })
        }

    })
</script>
<script type="text/javascript">
    function deletebrg() {
        $(".deletelist").click(function(e) {
            e.preventDefault();
            // var btnval = $("button").val();
            var fired_button = $(".deletelist").val();
            alert(fired_button);
            // $.ajax({
            //     type: "GET",
            //     url: $(this).attr('href'), //data dikirim dari a href
            //     dataType: "JSON",
            //     success: function(result) {
            //         for (var i = 0; i < result.length; i++) {
            //             $("#idbarang").val(result[i].ID_BARANG);
            //             $("#namabarang").val(result[i].NAMA_BARANG);
            //             // $("#id_brg").val(result[i].id_barang);
            //             $('#exampleModal').modal('hide');

            //         }
            //     },
            //     error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
            //         alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            //     }
            // })
        })
    }
</script>
<!-- PAGE PENJUALAN-->