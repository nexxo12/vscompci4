$(document).ready(function() {
  refreshid_Pembelian();
  showBarangPembelian();
  showBuySupplier();
  showPembelianbyMonth();
});

function refreshid_Pembelian() {
        $.ajax({
            type: "POST",
            async: false,
            url: '/Transaksi/refreshid_Pembelian',
            dataType: "JSON",
            success: function(result) {
                $("#id_buy").val("PB" + result)
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });
    }

$("#save-pembelian").click(function(e){
    e.preventDefault();
    var formData = $('#form-pembelian').serialize();
    $.ajax({
        type: "POST",
        async: false,
        url: '/Transaksi/savePembelian',
        data: formData,
        dataType: "JSON",
        success: function(result) {
            console.log(result);
            if (result.status == 'success') {
                alert(result.message);
                // Reset form fields
                $('#form-pembelian')[0].reset();
                // $('#jumlah_barang').val(''); // Reset jumlah_barang
                // $('#harga_barang').val('');
                refreshid_Pembelian(); // Refresh ID with the latest data
            }
            
        },
        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
    });
})

function showBarangPembelian() {
    $.ajax({
        url: '/Transaksi/getBarangPembelian',
        type: 'GET',    
    dataType: 'json',
        success: function(result) {
            // console.log(result);
            var select = $("#barang_buy");
            select.empty();
            select.append('<option value="">-- Pilih Barang --</option>');
            $.each(result, function(index, item) {
                // console.log(item);
                select.append('<option value="' + item.ID_BARANG + '">' + item.NAMA_BARANG + '</option>');
            });
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });

}

function showBuySupplier() {
    $.ajax({
        url: '/Transaksi/getSupplierPembelian',
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            var select = $("#nama_supp");
            select.empty();
            select.append('<option value="">-- Pilih Supplier --</option>');
            $.each(result, function(index, item) {
                select.append('<option value="' + item.ID_SUPP + '">' + item.NAMA + '</option>');
            });
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });

}

function showPembelianbyMonth() {
$('#tbl-total-pembelian-by-month').DataTable({
            autoWidth: true,
            processing: true,
            serverSide: true,
            ajax: '/Transaksi/showpembelianMonth',
            type: 'POST',
            columnDefs: [
                {
                    render: function(data, type, row) {
                        return row.delete; 
                    },
                    targets: 9 // Target kolom indeks
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
                    data: 'delete', orderable: false, searchable: false
                },

            ]
    });

}

function deletePembelian() {
    $(".delete-buy").click(function(e) {
        e.preventDefault();
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        $.ajax({        
            type: "POST",
            url: $(this).attr('href'),
            dataType: "JSON",  
            success: function(result) {
                if (result.status == 'success') {
                    alert(result.message);
                    $('#tbl-total-pembelian-by-month').DataTable().ajax.reload();
                    $('#tbl-show-all-buy').DataTable().ajax.reload();
                } else {
                    alert(result.message);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
            })
        }
    })
    
}

function showPembelianAll() {
    $('#loading-tampil-all-buy').show();
    $('#text-tampil-all-buy').hide();
    $('#card-history-all-buy').show();
    $('#tbl-show-all-buy').DataTable().destroy();
$('#tbl-show-all-buy').DataTable({
            autoWidth: true,
            processing: true,
            serverSide: true,
            ajax: '/Transaksi/showpembelianAll',
            type: 'POST',
            columnDefs: [
                {
                    render: function(data, type, row) {
                        return row.delete; 
                    },
                    targets: 9 // Target kolom indeks
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
                    data: 'delete', orderable: false, searchable: false
                },

            ]
    });
     $('#text-tampil-all-buy').show();
     $('#loading-tampil-all-buy').hide();
}
