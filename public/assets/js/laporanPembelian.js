$(document).ready(function() {
   var table = $('#tbl-laporan-pembelian').DataTable({
            autoWidth: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '/Finance/showpembelianAll',
                type: 'GET',
                data: function (d) {
                    // Mengambil nilai dari input HTML dan memasukkannya ke parameter AJAX
                    var start = $('#start_date').val();
                    var end = $('#end_date').val();
                    d.start_date = start;
                    d.end_date = end;

                // SOLUSI MUTLAK: Jika filter terisi, paksa parameter length kirim -1 ke CI4
                    if (start !== '' && end !== '') {
                        d.length = -1;
                    }
                }
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<span class="mdi mdi-file-excel-box"></span> Export',
                    className: 'btn btn-success', // Opsional: menambah class CSS tombol
                    exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] // Mengeksplor kolom ID sampai Tanggal Pelunasan saja (Kolom Aksi indeks 11 dilewati)
                    }
                }
            ],
            
            columnDefs: [
                {
                    render: function(data, type, row) {
                        return row.delete + ' ' + row.edit;    
                    },
                    targets: 12 // Target kolom indeks
                },
                {
                    targets: [3],
                    render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
                },

            
            ],
            columns: [{
                    data: 'ID_BELI',
                },
                {
                    data: 'NAMA_BARANG'
                },
                {
                    data: 'JUMLAH'
                },
                {
                    data: 'HARGA_BELI'
                },
                {
                    data: 'NAMA'
                },
                {
                    data: 'NamaSUPP'
                },
                {
                    data: 'TGL_GARANSI'
                },
                {
                    data: 'TGL_BELI'
                },
                {
                    data: 'BUY_PAYMENT'
                },
                {
                    data: 'BUY_TGL_TEMPO'
                },
                {
                    data: 'BUY_TGL_PELUNASAN'
                },
                {
                    defaultContent: '',
                    render: function(data, type, row) {
                        var pembayaran = row.BUY_PAYMENT ? row.BUY_PAYMENT.toLowerCase() : ''; 
                        var tglPelunasan = row.BUY_TGL_PELUNASAN;
                        var tglJatuhTempo = row.BUY_TGL_TEMPO;

                         // Jika pembayaran Cash otomatis Lunas
                        if (pembayaran === 'cash') {
                            return '<span class="badge bg-success">Lunas</span>';
                        }

                         // 2. Jika pembayaran Tempo
                        if (pembayaran === 'tempo') {
                        // Cek jika tanggal pelunasan sudah diisi dengan benar
                            if (tglPelunasan && tglPelunasan !== '0000-00-00' && tglPelunasan !== '') {
                            return '<span class="badge bg-success">Lunas</span>';
                            } 
                            // Jika tanggal pelunasan kosong / 0000-00-00, lakukan pengecekan jatuh tempo
                            else {
                                var hariIni = new Date();
                                hariIni.setHours(0, 0, 0, 0); // Reset jam agar kalkulasi tanggal akurat

                                var jatuhTempo = new Date(tglJatuhTempo);

                                if (hariIni <= jatuhTempo) {
                                    return '<span class="badge bg-warning text-dark">Belum Lunas</span>';
                                } else {
                                    return '<span class="badge bg-danger">Terlambat (Overdue)</span>';
                                }
                            }
                        }

                        // Jika tidak memenuhi kondisi di atas
                        return '<span class="badge bg-secondary">-</span>';
                    }
                },
                {
                    data: 'delete', orderable: false, searchable: false
                },

            ]
    });
    $('#btn-filter').on('click', function(e) {
        e.preventDefault();
        table.ajax.reload();
    });

    $('#btn-reset').on('click', function(e) {
        e.preventDefault();
        $('#start_date').val('');
        $('#end_date').val('');
        table.ajax.reload();
    });
    
});

function editPembelian(){
    $('.edit-buy').on('click', function(e) {
        e.preventDefault();
        $('#modal-edit-laporan-pembelian').modal('show');
        var url = $(this).attr('href'); 
        $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            success: function(result) {
                // console.log(result);
                $('#id_pembelian').text(result.ID_BELI);
                $('#input-id-pembelian').val(result.ID_BELI);
                $('#id-for-modal').text(result.ID_BELI);
                $('#nama-barang-pembelian').text(result.NAMA_BARANG);
                $('#harga-beli-pembelian').text(result.HARGA_BELI); 
                $('#nama-supplier-pembelian').text(result.NAMA);
                $('#tgl-pembelian').text(result.TGL_BELI);
                $('#buy-payment').val(result.BUY_PAYMENT);
                $('#tgl-tempo-edit').val(result.BUY_TGL_TEMPO);

                if ($('#buy-payment').val() === 'Cash') {
                    $('#tgl-tempo-edit').prop('disabled', true);
                }
                else{
                    $('#tgl-tempo-edit').prop('disabled', false);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        }); 

    })
}

function saveEditPembelian(){ 
    var dataForm = $('#form-edit-pembelian').serialize();
    $.ajax({
            type: "POST",
            async: false,
            url: '/Finance/saveeditpembelian',
            data: dataForm,
            dataType: "JSON",
            success: function(result) {
                if (result.status === 'success') {
                    Swal.fire('Berhasil!', 'Data berhasil diupdate!', 'success');
                    $('#modal-edit-laporan-pembelian').modal('hide');
                    $('#form-edit-pembelian')[0].reset(); // Reset form
                    $('#tbl-laporan-pembelian').DataTable().ajax.reload(); // Reload DataTable
                } else {
                    alert('Gagal mengupdate data!');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });
}

// $(document).ready(function() {
//     if ($('#buy-payment').val() === 'Cash') {
//         $('#tgl-tempo-edit').prop('disabled', true);
//     }
//      if ($('#buy-payment').val() === 'Tempo') {
//         $('#tgl-tempo-edit').prop('disabled', false);
//     }
    
// })
