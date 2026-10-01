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
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
                }
            },
            columnDefs: [
                {
                    render: function(data, type, row) {
                        return row.delete + ' ' + row.edit;    
                    },
                    targets: 11 // Target kolom indeks
                },
                {
                    targets: [3],
                    render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
                }
            
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
                    data: 'delete', orderable: false, searchable: false
                },

            ]
    });
    $('#btn-filter').on('click', function() {
        // me-reload tabel dengan parameter tanggal yang baru
        table.ajax.reload();
    });

    $('#btn-reset').on('click', function() {
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
                $('#id-for-modal').text(result.ID_BELI);
                $('#nama-barang-pembelian').text(result.NAMA_BARANG);
                $('#harga-beli-pembelian').text(result.HARGA_BELI);
                $('#nama-supplier-pembelian').text(result.NAMA);
                $('#tgl-pembelian').text(result.TGL_BELI);
                $('#buy-payment').val(result.BUY_PAYMENT);
            },
            error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        }); 

    })
}
