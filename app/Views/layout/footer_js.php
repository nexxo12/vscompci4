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
<script>
    $(document).ready(function() {
        loadcart();
        refreshidpj();
        caribarang();
        grandtotal();
        dtbl_CB = $('#datatable_caribarang').DataTable({});

        $("#input_supp").attr("style", "display: none");
        var select = $('#supp_buy').val();

        $('#supp_buy').on('change', function() {
            if (this.value == 20207 || this.value == 20216) {
                $("#input_supp").attr("style", "visibility: visible");
            } else {
                $("#input_supp").attr("style", "display: none");
            }
        });

        $("#refmp").attr("style", "display: none");
        $('#customer').on('change', function() {
            if (this.value == 8 || this.value == 5 || this.value == 10) {
                $("#refmp").attr("style", "visibility: visible");
                $("#alamat").attr("style", "display: none");
                $("#nama").attr("style", "visibility: visible");
            } else if (this.value == 1) {
                $("#alamat").attr("style", "visibility: visible");
                $("#refmp").attr("style", "display: none");
                $("#nama").attr("style", "visibility: visible");
            } else {
                $("#refmp").attr("style", "display: none");
                $("#alamat").attr("style", "display: none");
                $("#nama").attr("style", "display: none");
            }
        });
    });

    function rupiah(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
</script>

<!-- PAGE PENJUALAN-->
<script type="text/javascript">
    // FUNCTION UNTUK MENAMPILKAN BARANG SETELAH KLIK "CARI BARANG"
    function caribarang() {
        // $(document).ready(function() {
        $.ajax({
            type: "POST",
            async: false,
            url: '/Transaksi/showstok',
            dataType: "JSON",
            success: function(result) {
                var html = '';
                for (var i = 0; i < result.length; i++) {
                    var no = parseInt(i);
                    no++;
                    html += '<tr>' +
                        '<td>' + result[i].ID_BARANG + '</td>' +
                        '<td>' + result[i].NAMA_BARANG + ' (' + result[i].STOK + ')</td>' +
                        '<td>' + result[i].HARGA_BELI + '</td>' +
                        '<td><a class="addbrg-fromlist" href="/Transaksi/addbarang?id=' + result[i].ID_BARANG + '"><button id="list-brg" class="btn btn-primary ti-plus" onclick="addbrgfromlist()" type="button"></button></td>' +
                        '</tr>';
                }

                $('#tb_caribarang').html(html);

            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            },

        })
        // });

    }

    // FUNGSI MENDAPATKAN ID & NAMA BARANG KETIKA KLIK TOMBOL PLUS PADA DAFTAR BARANG
    function addbrgfromlist() {
        $(".addbrg-fromlist").click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: $(this).attr('href'), //data dikirim dari a href
                dataType: "JSON",
                success: function(result) {
                    for (var i = 0; i < result.length; i++) {
                        $("#idbarang").val(result[i].ID_BARANG);
                        $("#namabarang").val(result[i].NAMA_BARANG);
                        $("#stokdb").val(result[i].STOK);
                        $("#modalbarang").val(result[i].HARGA_BELI);
                        $("#stokinfo").html("<div>Stok: " + result[i].STOK + "</div>");
                        $('#Modalcaribrg').modal('hide');


                    }
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            })
        })
    }

    function grandtotal() {
        // MENAMPILKAN GRANDTOTAL, SUBTOTAL, DP, DISKON DI PAGE PENJUALAN (CHART)

        var subtotal = $.ajax({
            url: '/Transaksi/Subtotal',
            type: 'POST',
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            data: {
                id: $("#invoiceid").val()
            },

        });

        var total = $.ajax({
            url: '/Transaksi/TotalHarga',
            type: 'POST',
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            data: {
                id: $("#invoiceid").val()
            },
        });

        var dp = $.ajax({
            url: '/Transaksi/GetDP',
            type: 'POST',
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            data: {
                id: $("#invoiceid").val()
            },
        });

        var diskon = $.ajax({
            url: '/Transaksi/GetDiskon',
            type: 'POST',
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            data: {
                id: $("#invoiceid").val()
            },
        });

        var customer = $.ajax({
            url: '/Transaksi/GetNamaCustomer',
            type: 'POST',
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            data: {
                id: $("#invoiceid").val()
            },
        });

        var catatan = $.ajax({
            url: '/Transaksi/GetCatatan',
            type: 'POST',
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            data: {
                id: $("#invoiceid").val()
            },
        });

        $.when(subtotal, total, dp, diskon, customer, catatan).done(function(res_sub, res_tot, res_dp, res_diskon, res_cust, res_catatan) {
            // console.log(res_sub);
            // console.log(res_tot);
            var json_sub = res_sub[0];
            var decoded_sub = JSON.parse(json_sub);
            var json_tot = res_tot[0];
            var decoded_tot = JSON.parse(json_tot);
            var json_dp = res_dp[0];
            var decoded_dp = JSON.parse(json_dp);
            var json_diskon = res_diskon[0];
            var decoded_diskon = JSON.parse(json_diskon);
            var json_cust = res_cust[0];
            var decoded_cust = JSON.parse(json_cust);
            var json_catatan = res_catatan[0];
            var decoded_catatan = JSON.parse(json_catatan);
            // console.log(decoded_sub[0]['SUBTOTAL']);
            if (decoded_tot[0]['TOTAL_NETT'] == null) {
                $("#gTotal").html("<div>0</div>");
                $("#sTotal").html("<div>0</div>");
            } else {
                $("#sTotal").html("<div>" + rupiah(decoded_sub[0]['SUBTOTAL']) + "</div>");
                $("#gTotal").html("<div>" + rupiah(decoded_tot[0]['TOTAL_NETT']) + "</div>");
            }

            if (decoded_dp[0].DP == null) {
                $("#dp").html("<div>0</div>");

            } else {
                $("#dp").html("<div>" + rupiah(decoded_dp[0].DP) + "</div>");
            }

            if (decoded_diskon[0].DISKON == null) {
                $("#diskon").html("<div>0</div>");

            } else {
                $("#diskon").html("<div>" + rupiah(decoded_diskon[0].DISKON) + "</div>");
            }

            if (decoded_cust[0].NAMA == null) {
                $("#custname1").html("<div>Customer:</div>");
                $("#custname2").html("<div>Nama:</div>");

            } else {
                $("#custname1").html("<div>Customer: " + decoded_cust[0].NAMA + "</div>");
                $("#custname2").html("<div>Nama: " + decoded_cust[0].NAMACUST + "</div>");
            }
            if (decoded_catatan[0].CATATAN == null) {
                $("#catatan").html("<div></div>");

            } else {
                $("#catatan").html("<div>" + decoded_catatan[0].CATATAN + "</div>");
            }


        }).fail(function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        });

    }
</script>

<script type="text/javascript">
    //FUNGSI UNTUK MENDAPATKAN UPDATE ID TABLE PENJUALAN
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

    // FUNCTION UNTUK MENAMPILKAN BARANG SETELAH KLIK "ADD CART"
    function loadcart() {
        $.ajax({
            type: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
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
                        '<td>' + rupiah(result[i].HARGA_JL) + '</td>' +
                        '<td>' + result[i].JUMLAH_BELI + '</td>' +
                        '<td>' + rupiah(result[i].SUBTOTAL) + '</td>' +
                        '<td><a class="delete-loadcart" href="/Transaksi/deletecart?id=' + result[i].ID_PENJUALAN + '"><button class="btn btn-danger ti-trash" onclick="deletebrg()" type="button"></button></td>' +
                        '</tr>';
                }
                $('#datachart').html(html);

            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }


        })
    }
</script>
<script type="text/javascript">
    // JS TOMBOL ADD CHART
    $(".addchart").click(function(e) {
        e.preventDefault();
        $idbarang = $('#idbarang').val();
        $qty = $('#qty').val();
        $stokdb = $('#stokdb').val();
        $namabrg = $('#namabarang').val();



        if ($idbarang == '') {
            Swal.fire({
                title: 'Belum menambahkan barang!',
                icon: 'warning'
            })
            // } else if ($qty !== $stokdb) {
            //     Swal.fire({
            //         title: '' + $namabrg + '<br>QTY [' + $qty + '] > Stok [' + $stokdb + ']',
            //         icon: 'warning'
            //     })
        } else if ($qty == '') {
            Swal.fire({
                title: 'Belum input Qty!',
                icon: 'warning'
            })

        } else if ($stokdb == 0) {
            Swal.fire({
                title: 'Stok ' + $namabrg + ' kosong!',
                icon: 'warning'
            })

        } else {
            $.ajax({
                type: "GET",
                url: '/Transaksi/addcart', //data dikirim dari form
                data: $("#form_addchart").serialize(),
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                success: function() {
                    loadcart();
                    refreshidpj();
                    $('#qty').val('');
                    $('#input-dp').val(0);
                    $('#input-diskon').val(0);
                    $('#namabarang').val('');
                    $('#harga').val(0);
                    $("#stokinfo").html("<div>Stok: </div>");
                    grandtotal();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                },
                afterSend: function() {

                }
            })
        }

    })
</script>

<script type="text/javascript">
    // FUNCTION untuk DELETE table CHART
    function deletebrg() {
        $(".delete-loadcart").click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: $(this).attr('href'), //data dikirim dari a href
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                dataType: "JSON",
                success: function() {
                    loadcart();
                    grandtotal();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            })
        })
    }
</script>

<script type="text/javascript">
    // FUNCTION CHECKOUT untuk CLEAR CHART & PRINT
    $(".checkout").click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Apakah semua item, qty, dan harga sudah benar?",
            icon: "question",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Simpan & Print",
            denyButtonText: `Simpan`
        }).then((result) => {
            //Script untuk save ke DB INV_Penjualan
            $.ajax({
                type: 'GET',
                url: '/Transaksi/InserttoinvPJ',
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                data: {
                    id: $("#invoiceid").val()
                },
                success: function(result) {},
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
            //end Script

            //TOMBOL SIMPAN DAN PRINT
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Data berhasil disimpan & nota siap di cetak!",
                    icon: "success",
                    confirmButtonText: '<i class="mdi mdi-printer"></i><a href="/transaksi/penjualan/print/' + $("#invoiceid").val() + '" target="_blank"><span style="color:white"> Print</span></a>',
                }).then((oke) => {
                    $.ajax({
                        type: "GET",
                        url: '/Transaksi/ClearListPenjualan',
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        dataType: "JSON",
                        success: function() {
                            location.reload();
                        },
                        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                        }
                    })
                });

                //TOMBOL SIMPAN
            } else if (result.isDenied) {
                $.ajax({
                    type: "GET",
                    url: '/Transaksi/ClearListPenjualan',
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    dataType: "JSON",
                    success: function() {
                        Swal.fire("Data berhasil disimpan!", "", "success").then((oke) => {
                            location.reload();
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
                })

            }
        });

    })
</script>
<!-- PAGE PENJUALAN-->