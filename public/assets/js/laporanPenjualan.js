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
                $('#id_pelanggan_edit_laporan_pj').val(result.listnota[0].ID_PELANGGAN);
                $('#id_login_edit_laporan_pj').val(result.listnota[0].ID_LOGIN);
                $('#alamat_edit_laporan_pj').val(result.listnota[0].ALAMAT);
                $('#customer_edit_laporan_pj').val(result.listnota[0].NAMACUST);
                $('#ref_edit_laporan_pj').val(result.listnota[0].REFMP);
                $('#view-edit-invoice-laporan').html(html);
                // console.log(result.hargajual[0]);
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
                    refreshidpj();
                    view_edit_invoice($invoiceid);
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            })
        })

}

//fungsi untuk menampilkan data master barang untuk diinput ke edit modal laporan penjualan
function cari_barang_laporan_pj(){
            $('#tbl-cari-barang-laporan-pj').DataTable().destroy(); // Hapus instance DataTable sebelumnya
            $('#modal-cari-barang-laporan-pj').modal('show');
            $('#tbl-cari-barang-laporan-pj').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/finance/viewdata_masterbarang_edit_laporan_penjualan',
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
                    data: 'add',
                },
            ],
            createdRow: function(row, data, dataIndex) {
            // Bersihkan jika ada tag HTML/spasi pada STOK, default ke 0 jika null
            let stok = parseInt(String(data.STOK).replace(/<[^>]*>/g, '').trim(), 10) || 0;

                if (stok <= 0) {
                    // Cari elemen button atau a di dalam kolom ke-4 (indeks 3)
                    $('td:eq(3)', row).find('button, a')
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

function addbrgfromlist_edit_laporan_pj() {
    $(".add-listbarang-laporan-pj").click(function(e) {
        e.preventDefault();
            $.ajax({
                type: "GET",
                url: $(this).attr('href'), //data dikirim dari a href
                dataType: "JSON",
                success: function(result) {
                    // console.log(result);
                    for (var i = 0; i < result.length; i++) {
                        $("#id_barang_edit_laporan_pj").val(result[i].ID_BARANG);
                        $('#hargamodal_edit_laporan_pj').val(result[i].HARGA_BELI_MASTER);
                        $('#modal-cari-barang-laporan-pj').modal('hide');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            })
        })
    }

function clearlistbarang_edit_laporan_pj() {
     $.ajax({
        type: "GET",
        url: '/Transaksi/ClearListPenjualan',
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        },
        dataType: "JSON",
        success: function() {
            
        },
        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
    })
}

function update_barang_laporan_pj(){
    let idpenjualan  = $('#id_penjualan_edit_laporan_pj').val();
    let invoice      = $('#invoice-laporan-edit').val();
    let idbarang     = $('#id_barang_edit_laporan_pj').val(); 
    let typecustomer = $('#id_pelanggan_edit_laporan_pj').val(); 
    let idkasir      = $('#id_login_edit_laporan_pj').val(); 
    let tanggal      = $('#tangal-laporan-edit').val(); 
    let namacustomer = $('#customer_edit_laporan_pj').val(); 
    let alamat       = $('#alamat_edit_laporan_pj').val(); 
    let refinv_mp    = $('#ref_edit_laporan_pj').val();
    let qty          = parseInt(String($('#qty_edit_laporan_pj').val() || '0').replace(/[^0-9]/g, ''), 10) || 0; 
    let modalbarang  = parseFloat(String($('#hargamodal_edit_laporan_pj').val() || '0').replace(/[^0-9]/g, '')) || 0; 
    let harga        = parseFloat(String($('#hargajual_edit_laporan_pj').val() || '0').replace(/[^0-9]/g, '')) || 0;
        $.ajax({
                type: "POST",
                url: '/Transaksi/addcart', //data dikirim dari form
                data:{
                        idpenjualan  : idpenjualan,
                        invoice      : invoice,
                        idbarang     : idbarang,
                        typecustomer : typecustomer,
                        idkasir      : idkasir,
                        tanggal      : tanggal,
                        namacustomer : namacustomer,
                        alamat       :  alamat,
                        refinv_mp    :  refinv_mp,
                        qty          :  qty,
                        modalbarang  :  modalbarang,
                        harga        :  harga
                },
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                success: function() {
                    alert('Barang berhasil ditambahkan ke invoice');
                    view_edit_invoice($invoiceid);
                    $('#id_barang_edit_laporan_pj').val('');
                    $('#hargamodal_edit_laporan_pj').val('');
                    $('#qty_edit_laporan_pj').val('');
                    $('#hargajual_edit_laporan_pj').val('');
                    refreshidpj();
                    clearlistbarang_edit_laporan_pj();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                },
                afterSend: function() {

                }
            })
}

// Menjaga Scroll Modal 1 Setelah Modal 2 Ditutup
$(document).on('hidden.bs.modal', '.modal', function () {
    if ($('.modal:visible').length) {
        $('body').addClass('modal-open');
    }
});

    //fungsi untuk menampilkan data & edit invoice ketika klik tombol edit (icon pencil) di datatable laporan
function edit_invoice() {
        $(".edit-invoice").click(function(e) {
            e.preventDefault();
            $('#modal-edit').modal('show');
            refreshidpj();
            $('#hargamodal_edit_laporan_pj').val('');
            $('#id_barang_edit_laporan_pj').val('');
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