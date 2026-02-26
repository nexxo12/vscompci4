$(document).ready(function() {
    refreshid_masterbarang();
    viewdata_masterbarang();
});

function viewdata_masterbarang() {
$('#tbl-masterbarang').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/master/view_masterbarang',
            type: 'POST',
            columnDefs: [{
                    targets: [5,6], // Target kolom indeks
                    render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
                },
                {
                    render: function(data, type, row) {
                        return row.aksi + ' ' + row.delete; // Gabungkan tombol edit dan delete
                    },
                    targets: 7 // Target kolom indeks
                }
            
            ],
            columns: [{
                    data: 'ID_BARANG',
                },
                {
                    data: 'NAMA_BARANG'
                },
                {
                    data: 'KATEGORI'
                },

                {
                    data: 'STOK'
                },
                {
                    data: 'SATUAN'
                },
                {
                    data: 'HARGA_JUAL',
                },
                
                {
                    data: 'G_TOTAL',
                    // render: function(data, type, row) {
                    //     return 'Rp ' + (row.STOK * row.HARGA_BELI).toLocaleString('id-ID');
                    // }
                },
                {
                    data: 'delete',
                },

            ]
        });
    }

function edit_barang() {
    $(".edit-barang").click(function(e) {
        e.preventDefault();
        $('#modal-edit-barang').modal('show');
        $.ajax({
            type: "POST",
            async: false,
            url: $(this).attr('href'),
            dataType: "JSON",
            success: function(result) {
                for (var i = 0; i < result.length; i++) {
                    $('#kode-barang-edit').val(result[i].ID_BARANG);
                    $('#nama-barang-edit').val(result[i].NAMA_BARANG);
                    $('#kategori-barang-edit').val(result[i].ID_KATEGORI).change();
                    $('#stok-barang-edit').val(result[i].STOK);
                    $('#harga-beli-terbaru-edit').val(result[i].HARGA_BELI);
                    $('#harga-jual-rekomendasi-edit').val(Math.round(result[i].HARGA_BELI * 1.2));

                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });

    });
}

 function delete_barang() {
        $(".delete-barang").click(function(e) {
            e.preventDefault();
            Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",    
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
            }).then((result) => {   if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: $(this).attr('href'),
                    dataType: "JSON",
                    success: function(response) {   
                        if (response.status === 'success') {
                            Swal.fire('Berhasil!', 'Data berhasil dihapus!', 'success');
                            $('#tbl-masterbarang').DataTable().ajax.reload(); // Reload DataTable
                        } else {
                            alert('Gagal menghapus data!');
                        }       
                    },
                    error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
                });
            }
        });
       
    });     
}


    function save_edit_barang() {
        $.ajax({
            type: "POST",
            async: false,
            url: '/master/save_edit_barang',
            data: $('#form-edit-barang').serialize(),
            dataType: "JSON",
            success: function(result) {
                console.log(result);
                if (result.status === 'success') {
                    Swal.fire('Berhasil!', 'Data berhasil diupdate!', 'success');
                    $('#modal-edit-barang').modal('hide');
                    $('#form-edit-barang')[0].reset(); // Reset form
                    refreshid_masterbarang(); // Refresh ID dengan data terbaru
                    $('#tbl-masterbarang').DataTable().ajax.reload(); // Reload DataTable
                } else {
                    alert('Gagal mengupdate data!');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });

    
       
    }


function refreshid_masterbarang() {
        $.ajax({
            type: "POST",
            async: false,
            url: '/master/refreshid_masterbarang',
            dataType: "JSON",
            success: function(result) {
                for (var i = 0; i < result.length; i++) {
                    var idpj = parseInt(result[i].ID_BARANG);
                    idpj++;
                    $("#idbarang").val("BR" + idpj);

                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });
    }

$("#btn-masterbarang").click(function(e) {
    e.preventDefault();
    // var idbarang = $("#idbarang").val();
    // var namabarang = $("#namabarang").val();
    // var kategori = $("#kategori").val();   
    if ($('#namabarang').val() === '' || $('#kategori').val() === '') {
        alert('Nama barang dan kategori harus diisi!');
        return; // Hentikan eksekusi jika ada field yang kosong
    }
    $.ajax({
            type: "POST",
            url: '/master/save_masterbarang',
            data: $('#form-masterbarang').serialize(),
            dataType: "JSON",
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            success: function(response) {
               console.log(response);
                if (response.status === 'success') {
                    alert('Data berhasil disimpan!');
                    $('#form-masterbarang')[0].reset(); // Reset form
                    refreshid_masterbarang(); // Refresh ID dengan data terbaru
                    location.reload();
                    
                }  else {
                    alert('Gagal menyimpan data!');
                }

            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });
    // alert(idbarang); 
});

function add_kategori() {
        $('#modal-kategori').modal('show');
}

function save_kategori() {
         $.ajax({
            type: "POST",
            url: '/master/save_kategori',
            data: $('#form-add-kategori').serialize(),
            dataType: "JSON",
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert('Kategori berhasil disimpan!');
                    $('#modal-kategori').modal('hide');
                    location.reload();  
                } else {
                   alert('Gagal menyimpan kategori!');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });
}
