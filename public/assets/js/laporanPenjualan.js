//untuk menampilkan data invoice ketika klik tombol view (icon list) di datatable laporan
function view_inv() {
        $(".view-invoice").click(function(e) {
            e.preventDefault();
            $('#modal-view').modal('show');
            $.ajax({
                type: "POST",
                url: $(this).attr('href'), //data dikirim dari a href
                dataType: "JSON",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                success: function(result) {
                    // console.log(result);
                    var html = '';
                    var looplen = result.listnota.length;
                    for (var i = 0; i < looplen; i++) {
                        // console.log(result.listnota[i].ID_BARANG);
                        var no = parseInt(i);
                        no++;
                        html += '<tr>' +
                            '<td>' + no + '</td>' +
                            '<td>' + result.listnota[i].ID_BARANG + '</td>' +
                            '<td>' + result.listnota[i].NAMA_BARANG + '</td>' +
                            '<td>' + result.listnota[i].JUMLAH_BELI + '</td>' +
                            '<td>' + rupiah(result.listnota[i].HARGA_AWAL) + '</td>' +
                            '<td>' + rupiah(result.listnota[i].HARGA_JL) + '</td>' +
                            '<td>' + rupiah(result.listnota[i].LABA) + '</td>' +
                            '</tr>';
                    }
                    $('#data-view-invoice').html(html);
                    $('#no-invoice').html(result.listnota[0].INV_PENJUALAN);
                    if (result.listnota[0].REFMP == null) {
                        $('#ref-invoice').html(result.listnota[0].NAMA);

                    } else {
                        $('#ref-invoice').html(result.listnota[0].NAMA + ' ' + result.listnota[0].REFMP);;
                    }
                    $('#nama-invoice').html(result.listnota[0].NAMACUST);
                    $('#alamat-invoice').html(result.listnota[0].ALAMAT);
                    $('#tgl-invoice').html(moment(result.listnota[0].TANGGAL_TRANSAKSI).format('DD-MM-YYYY'));
                    $('#kasir').html(result.listnota[0].NAMA_LOGIN);
                    $('#total-qty').html(result.qty[0].JUMLAH_BELI);
                    $('#total-modal').html(rupiah(result.hargaawal[0].HARGA_AWAL));
                    $('#total-harga').html(rupiah(result.hargajual[0].HARGA_JL));
                    $('#total-laba').html(rupiah(result.hargajual[0].HARGA_JL - result.hargaawal[0].HARGA_AWAL));
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            })
        })
}

function view_edit_invoice($invoiceid) {
        //untuk menampilkan data (tabel bawah) ketika klik tombol edit (icon pencil) di datatable laporan
        $.ajax({
            type: "POST",
            url: '/finance/view_invoice?invoice=' + $invoiceid,
            dataType: "JSON",
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            success: function(result) {
                // console.log(result);
                var html = '';
                var looplen = result.listnota.length;
                for (var i = 0; i < looplen; i++) {
                    // console.log(result.listnota[i].ID_BARANG);
                    var no = parseInt(i);
                    no++;
                    html += '<tr>' +
                        '<td>' + no + '</td>' +
                        '<td>' + result.listnota[i].ID_BARANG + '</td>' +
                        '<td>' + result.listnota[i].NAMA_BARANG + '</td>' +
                        '<td>' + result.listnota[i].JUMLAH_BELI + '</td>' +
                        '<td>' + rupiah(result.listnota[i].HARGA_JL) + '</td>' +
                        '<td><a class="delete" href="/Transaksi/delete_barang?id=' + result.listnota[i].ID_PENJUALAN + '"><button class="btn btn-danger ti-trash" onclick="delete_view_edit_invoice()" type="button"></button></td>' +
                        '</tr>';
                }
                $('#view-edit-invoice-laporan').html(html);
                console.log(result.hargajual[0]);
                $('#modal-laporan-edit').val(result.hargaawal[0].HARGA_AWAL);
                $('#gtotal-laporan-edit').val(result.hargajual[0].HARGA_JL);
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        })
}

    //FUNGSI UNTUK DELETE BARANG DI MODAL EDIT INVOICE (icon pencil)
function delete_view_edit_invoice() {
        $(".delete").click(function(e) {
            e.preventDefault();
            $('#modal-edit').modal('show');
            $.ajax({
                type: "POST",
                url: $(this).attr('href'),
                dataType: "JSON",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                success: function(result) {
                    // console.log(result);
                    view_edit_invoice($invoiceid);
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            })
        })

}

    //fungsi untuk menampilkan data & edit invoice ketika klik tombol edit (icon pencil) di datatable laporan
function edit_invoice() {
        $(".edit-invoice").click(function(e) {
            e.preventDefault();
            $('#modal-edit').modal('show');
            $.ajax({
                type: "POST",
                url: $(this).attr('href'), //data dikirim dari finance/viewdata_invoice_penjualan
                dataType: "JSON",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                success: function(result) {
                    // console.log(result);
                    $invoiceid = result[0].id_inv;
                    $('#invoice-laporan-edit').val(result[0].id_inv);
                    $('#tangal-laporan-edit').val(moment(result[0].TGL_TRX).format('YYYY-MM-DD'));
                    $('#gtotal-laporan-edit').val(result[0].GRAND_TOTAL);
                    $('#customer-laporan-edit').val(result[0].BARANG);
                    $('#status-laporan-edit').val(result[0].INV_STATUS);
                    $('#jatuh-tempo-laporan-edit').val(moment(result[0].INV_JATUH_TEMPO).format('YYYY-MM-DD'));
                    $('#keterangan-laporan-edit').val(result[0].inv_ol);
                    if (result[0].modal == null) {
                        $('#modal-laporan-edit').val(0);

                    } else {
                        $('#modal-laporan-edit').val(result[0].modal);
                    }
                    if (result[0].potongan == null) {
                        $('#biayaadm-laporan-edit').val(0);

                    } else {
                        $('#biayaadm-laporan-edit').val(result[0].potongan);
                    }
                    if (result[0].ongkir == null) {
                        $('#biayamin-laporan-edit').val(0);

                    } else {
                        $('#biayamin-laporan-edit').val(result[0].ongkir);
                    }
                    if (result[0].laba_ongkir == null) {
                        $('#biayaplus-laporan-edit').val(0);

                    } else {
                        $('#biayaplus-laporan-edit').val(result[0].laba_ongkir);
                    }
                    if (result[0].laba == null) {
                        $('#laba-laporan-edit').val(0);

                    } else {
                        $('#laba-laporan-edit').val(result[0].laba);
                    }

                    view_edit_invoice($invoiceid)
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            })
        })
}

    //fungsi untuk menyimpan perubahan data invoice pada modal edit invoice (icon pencil) di datatable laporan
function save_edit_invoice() {
        $.ajax({
            type: "POST",
            url: '/finance/saveinfoinvoice?invoice=' + $("#invoice-laporan-edit").val(),
            data: $("#form-info-invoice").serialize(),
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
                $('#modal-edit').modal('hide');
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
}

$(document).ready(function() {
        table_laporan = $('#tbl-laporanpj').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/finance/viewdata_invoice_penjualan',
                type: 'GET',
                data: function (d) {
                    // Mengambil nilai dari input HTML dan memasukkannya ke parameter AJAX
                    var startpj = $('#pj_start_date').val();
                    var endpj = $('#pj_end_date').val();
                    d.pj_start_date = startpj; //Sesuaikan dengan nama parameter getGet di CI4
                    d.pj_end_date = endpj; //Sesuaikan dengan nama parameter getGet di CI4

                // SOLUSI MUTLAK: Jika filter terisi, paksa parameter length kirim -1 ke CI4
                    if (startpj !== '' && endpj !== '') {
                        d.length = -1;
                    }
                }
            },
            columnDefs: [{
                    targets: [5,6,7,8,9,10], // Target kolom indeks
                    render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
                },
                {
                    render: function(data, type, row) {
                        return row.view + ' ' + row.action + ' ' + row.print + ' ' + row.delete;
                    },
                    targets: 12 // Target kolom indeks
                }
            ],
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                autoFilter: true,
                text: ' Export',
                className: 'ti-export btn btn-success',
                title: 'Data Laporan', // Judul file excel
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], // Mengeksplor kolom ID sampai Tanggal Pelunasan saja (Kolom Aksi indeks 12 dilewati)
                    modifier: {
                        search: 'applied', // 'applied' atau 'none'
                        // order: 'applied'
                    }
                }
            }],
            columns: [{
                    data: 'id_inv'
                },
                {
                    data: 'TGL_TRX'
                },
                {
                    data: 'INV_JATUH_TEMPO'
                },
                {
                    data: 'BARANG'
                },
                {
                    data: 'inv_ol'
                },
                {
                    data: 'GRAND_TOTAL'
                },
                {
                    data: 'modal'
                },
                {
                    data: 'ongkir'
                },
                {
                    data: 'laba_ongkir'
                },
                {
                    data: 'potongan'
                },
                {
                    data: 'laba_bersih'
                },
                {
                    data: 'INV_STATUS',
                    render: function(data, type, row) {
                    // 1. Buat variabel untuk menampung class badge bootstrap
                        var badgeClass = '';

                        // 2. Tentukan warna badge berdasarkan teks status dari database
                        if (data === 'Pending') {
                            badgeClass = 'badge-warning text-dark'; // Warna Kuning
                        } else if (data === 'Terlambat') {
                            badgeClass = 'badge-danger';          // Warna Merah
                        } else if (data === 'Selesai') {
                            badgeClass = 'badge-success';         // Warna Hijau
                        } else {
                            badgeClass = 'badge-secondary';       // Warna Abu-abu (jika status kosong/lainnya)
                        }

                        // 3. Return elemen HTML badge utuh untuk ditampilkan ke tabel
                        return '<span class="badge ' + badgeClass + '">' + data + '</span>';
                    }
        
                },
                {
                    data: 'action'
                },
            ]
        });

        $('#btn-filter-pj').on('click', function(e) {
        e.preventDefault();
        table_laporan.ajax.reload();
    });

    $('#btn-reset-pj').on('click', function(e) {
        e.preventDefault();
        $('#pj_start_date').val('');
        $('#pj_end_date').val('');
        table_laporan.ajax.reload();
    });
});


$("#customer").change(function() {
        var selectedOption = $(this).find("option:selected");
        var selectedText = selectedOption.text();
        $("#penjualan-typecustomer").val(selectedText);
})