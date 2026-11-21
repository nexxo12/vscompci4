//localStorage Menyimpan data ketikan secara otomatis di penyimpanan browser setiap kali ada perubahan input
$(document).ready(function() {
    const STORAGE_KEY = 'draft_input_penjualan_vsk';

    // 1. Daftar atribut 'name' atau 'id' input yang ingin dipertahankan
    const daftarField = [
        'tanggal',      
        'tanggal-jatuhtempo',     
        'typecustomer',      
        'namacustomer',      
        'alamat',    
        'refinv_mp',      
        'catatan',        
    ];

    // 2. Fungsi memulihkan data ke dalam input saat halaman dibuka
    function muatDraftPenjualan() {
        let savedData = localStorage.getItem(STORAGE_KEY);
        if (!savedData) return;

        let data = JSON.parse(savedData);
        daftarField.forEach(function(fieldName) {
            if (data[fieldName] !== undefined && data[fieldName] !== '') {
                let $el = $('[name="' + fieldName + '"]');
                if ($el.length) {
                    $el.val(data[fieldName]).trigger('change');
                }
            }
        });
    }

    // 3. Fungsi menyimpan setiap perubahan ketikan ke localStorage
    function simpanDraftPenjualan() {
        let data = {};
        daftarField.forEach(function(fieldName) {
            let $el = $('[name="' + fieldName + '"]');
            if ($el.length) {
                data[fieldName] = $el.val();
            }
        });
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
    }

    // Jalankan pemulihan data saat halaman selesai dimuat
    muatDraftPenjualan();

    // Pantau setiap perubahan (ketikan maupun pilihan dropdown) pada field tersebut
    daftarField.forEach(function(fieldName) {
        $(document).on('input change', '[name="' + fieldName + '"]', function() {
            simpanDraftPenjualan();
        });
    });
});

//fungsi ini di dalam callback 'success' AJAX saat transaksi final disimpan / checkout
function hapusDraftPenjualan() {
    localStorage.removeItem('draft_input_penjualan_vsk');
}

$(document).ready(function() {
        loadcart();
        refreshidpj();
        grandtotal();
        $("#button-save-garansi").prop('disabled', true);
        // $("#input_supp").attr("style", "display: none");
        var select = $('#supp_buy').val();
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
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
}

 function caribarang() {
        if ($.fn.DataTable.isDataTable('#datatable_caribarang')) {
            $('#datatable_caribarang').DataTable().destroy(); // Hapus instance DataTable sebelumnya
        }
        $('#Modalcaribrg').modal('show');
        $('#datatable_caribarang').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: '/transaksi/showstok',
            type: 'POST',
            columnDefs: [

            ],
            columns: [{
                    data: 'ID_BARANG',
                },
                {
                    data: 'NAMA_BARANG'
                },
                {
                    data: 'STOK'
                },
                {
                    data: 'HARGA_BELI_MASTER',
                    render: function(data, type, row) {
                    // Jika data HPP kosong/null, tampilkan tanda strip
                    if (data === null || String(data).trim() === '') {
                        return '<span class="text-muted">-</span>';
                    }

                    let angka = parseFloat(String(data).replace(/[^0-9.-]/g, '')) || 0;
                    if (type !== 'display') {
                        return angka;
                    }

                    let formatRupiah = 'Rp ' + angka.toLocaleString('id-ID');

                    return `
                        <div class="d-flex justify-content-between align-items-center text-nowrap">
                            <span class="hpp-value" data-asli="${formatRupiah}" data-tampil="false">Rp ••••••</span>
                            <button type="button" class="btn btn-link btn-sm text-secondary p-0 ml-2 btn-toggle-hpp" title="Lihat HPP">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    `;
                    }
                },
                {
                    data: 'add',
                },
            ],
            createdRow: function(row, data, dataIndex) {
                // Bersihkan jika ada tag HTML/spasi pada STOK, default ke 0 jika null
                let stok = parseInt(String(data.STOK).replace(/<[^>]*>/g, '').trim(), 10) || 0;

                if (stok <= 0) {
                    // Cari elemen button atau a di dalam kolom ke-4 (indeks 4)
                    $('td:eq(4)', row).find('button, a')
                        .prop('disabled', true)
                        .addClass('disabled')
                        .removeClass('btn-primary btn-info btn-success')
                        .addClass('btn-secondary')
                        .removeAttr('onclick')
                        .css({
                            'pointer-events': 'none',
                            'opacity': '0.5'
                        })
                        .attr('title', 'Stok habis');
                }
            }
        });
}

//script sensor harga hpp daftar barang
$(document).on('click', '.btn-toggle-hpp', function(e) {
    e.preventDefault();
    e.stopPropagation();

    let $wrapper = $(this).closest('div');
    let $teksHpp = $wrapper.find('.hpp-value');
    let $ikon    = $(this).find('i');
    let sedangTampil = $teksHpp.attr('data-tampil') === 'true';

    if (sedangTampil) {
        // Kembalikan ke mode sensor
        $teksHpp.text('Rp ••••••').attr('data-tampil', 'false');
        $ikon.removeClass('fa-eye-slash').addClass('fa-eye');
        $(this).attr('title', 'Lihat HPP');
    } else {
        // Tampilkan nominal Rupiah asli
        $teksHpp.text($teksHpp.attr('data-asli')).attr('data-tampil', 'true');
        $ikon.removeClass('fa-eye').addClass('fa-eye-slash');
        $(this).attr('title', 'Sembunyikan HPP');
    }
});

 // FUNGSI MENDAPATKAN ID & NAMA BARANG KETIKA KLIK TOMBOL PLUS PADA DAFTAR BARANG
    function addbrgfromlist() {
        $(".addbrg-fromlist").click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: $(this).attr('href'), //data dikirim dari a href
                dataType: "JSON",
                success: function(result) {
                    // console.log(result);
                    for (var i = 0; i < result.length; i++) {
                        $("#idbarang").val(result[i].ID_BARANG);
                        $("#namabarang").val(result[i].NAMA_BARANG);
                        $("#modalbarang").val(result[i].HARGA_BELI);
                        $('#Modalcaribrg').modal('hide');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            })
        })
    }

    //FUNGSI UNTUK MENDAPATKAN NILAI NAMA CUSTOMER, TOTAL HARGA, DP, DISKON, DLL-->
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

        var summodal = $.ajax({
            url: '/Transaksi/GetSumModal',
            type: 'POST',
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            data: {
                id: $("#invoiceid").val()
            },
        });

        $.when(subtotal, total, dp, diskon, customer, catatan, summodal).done(function(res_sub, res_tot, res_dp, res_diskon, res_cust, res_catatan, res_summodal) {
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
            var json_summodal = res_summodal[0];
            var decoded_summodal = JSON.parse(json_summodal);
            // console.log(decoded_sub[0]['SUBTOTAL']);
            if (decoded_tot[0]['TOTAL_NETT'] == null) {
                $("#gTotal").html("<div>0</div>");
                $("#sTotal").html("<div>0</div>");
                $("#sumtotal").val(0);
            } else {
                $("#sTotal").html("<div>" + rupiah(decoded_sub[0]['SUBTOTAL']) + "</div>");
                $("#gTotal").html("<div>" + rupiah(decoded_tot[0]['TOTAL_NETT']) + "</div>");
                $("#sumtotal").val(decoded_tot[0]['TOTAL_NETT']);
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

            if (decoded_summodal[0]['HARGA_AWAL'] == null) {
                $("#summodal").val(0);
            } else {
                $("#summodal").val(decoded_summodal[0]['HARGA_AWAL']);
            }


        }).fail(function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        });

    }

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
                    $("#id_penjualan_edit_laporan_pj").val(idpj);

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
                    $('#summtotal').val(0);
                    $('#summmodal').val(0);
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            })
        })
    }

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
                    id: $("#invoiceid").val(),
                    typecustomer: $("#penjualan-typecustomer").val(),
                    tanggal: $("#tanggal").val(),
                    jatem: $("#tanggal-jatuhtempo").val(),
                    keterangan: $("#namacustomer").val() + ' ' + $("#refinv_mp").val(),
                    grandtotal: $("#sumtotal").val(),
                    summodal: $("#summodal").val(),
                },
                success: function(result) {
                    // alert("Data berhasil disimpan!"); // Munculkan alert sukses
                    hapusDraftPenjualan();
                },
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
                            hapusDraftPenjualan();
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