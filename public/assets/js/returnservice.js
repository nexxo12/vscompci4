document.addEventListener('DOMContentLoaded', function() {
    // Sembunyikan input saat halaman dimuat
    $("#input-invoice").attr("style", "display: none");
    $("#input-ref").attr("style", "display: none");
    $("#input-garansi").attr("style", "display: none");
    listBarangReturn();
});

document.getElementById('jenis_service').addEventListener('change', function() {
    const jenisService = document.getElementById('jenis_service').value;
    if (jenisService === 'service-marketplace') {
        // Tampilkan input untuk transaksi marketplace
        $("#input-invoice").attr("style", "visibility: visible");
        $("#input-ref").attr("style", "visibility: visible");
        $("#input-garansi").attr("style", "visibility: visible");
    } else if (jenisService === 'service-offline') {
        // Tampilkan input untuk transaksi offline
        $("#input-invoice").attr("style", "display: none");
        $("#input-ref").attr("style", "display: none");
        $("#input-garansi").attr("style", "display: none");
    } else {
        // Sembunyikan input jika tidak ada jenis service yang dipilih
       $("#input-invoice").attr("style", "display: none");
        $("#input-ref").attr("style", "display: none");
        $("#input-garansi").attr("style", "display: none");
    }
    // console.log(jenisService);
    // alert(jenisService);
});

document.getElementById('jenis_service').addEventListener('change', function() {
    const jenisService = document.getElementById('jenis_service').value;
    
    if (jenisService === 'service-marketplace') {
        $.ajax({
            url: '/Transaksi/noNota',
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                console.log(result);
                $("#no_surat").val("TT-TM-"+result);
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });
    }
    if (jenisService === 'service-offline') {
        $.ajax({
            url: '/Transaksi/noNota',
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                console.log(result);
                $("#no_surat").val("TT-TO-"+result);
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });
    }
});

    // Function to save form data
    function saveFormData() {
        const formData = $('#form-service').serialize();
        const InvoiceReturn = $('#no_surat').val(); // Ambil nilai no_surat dari input
        if ($('#no_surat').val() === '') {
            Swal.fire({
                title: 'Error',
                text: 'Data tidak boleh kosong!',
                icon: 'error'
            });
            return;
        }

        if ($('#diterima_dari').val() === '') {
            Swal.fire({
                title: 'Error',
                text: 'Data penerima tidak boleh kosong!',
                icon: 'error'
            });
            return;
        }
         if ($('#no_hp').val() === '') {
            Swal.fire({
                title: 'Error',
                text: 'Data HP penerima tidak boleh kosong!',
                icon: 'error'
            });
            return;
        }
         if ($('#namabarang').val() === '') {
            Swal.fire({
                title: 'Error',
                text: 'Data barang tidak boleh kosong!',
                icon: 'error'
            });
            return;
        }
         if ($('#kelengkapan').val() === '') {
            Swal.fire({
                title: 'Error',
                text: 'Data kelengkapan tidak boleh kosong!',
                icon: 'error'
            });
            return;
        }
         if ($('#kerusakan').val() === '') {
            Swal.fire({
                title: 'Error',
                text: 'Data kerusakan tidak boleh kosong!',
                icon: 'error'
            });
            return;
        }
        $.ajax({
            url: '/Transaksi/saveService',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                alert('Data berhasil disimpan!');
                $('#namabarang').val('');
                $('#qty_barang_return').val('');
                $('#kelengkapan').val('');
                $('#kerusakan').val('');
                showFormData();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert('Error menyimpan data: ' + xhr.responseText);
            }
        });
    }

    function showFormData() {
        var no_surat = $('#no_surat').val();
        $.ajax({
            url: '/Transaksi/showService',
            type: 'POST',
            data: { no_surat: no_surat },
            dataType: 'json',
            success: function(response) {
                $('#card-preview-return').show(); // Tampilkan card preview
                // console.log(response);
                var dataList = Array.isArray(response) ? response : (response ? [response] : []);
                var rows = '';
                $.each(dataList, function(index, item) {
                rows += '<tr>' +
                    '<td>' + (item.BARANG || '-') + '</td>' +
                    '<td>' + (item.RETURN_QTY || '-') + '</td>' +
                    '<td>' + (item.KELENGKAPAN || '-') + '</td>' +
                    '<td>' + (item.KERUSAKAN || '-') + '</td>' +
                    '</tr>';
            });
                $('#tbl-preview-return').html(rows);
                
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert('Error menyimpan data: ' + xhr.responseText);
            }
        });
    }

    function printFormData() {
        const InvoiceReturn = $('#no_surat').val();
        Swal.fire({
                    title: 'Berhasil',
                    text: 'Data service berhasil disimpan!',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Cetak',
                    cancelButtonText: 'Tutup'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        window.open('/transaksi/return_service/print/' + InvoiceReturn, '_blank');
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                        $('#tbl-daftar-return').DataTable().reload();
                    }

                    $('#form-service')[0].reset();
                    document.getElementById('jenis_service').dispatchEvent(new Event('change'));
                });
    }

function listBarangReturn() {
    $('#tbl-daftar-return').DataTable({
            autoWidth: true,
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: '/Transaksi/ListBarangReturn',
            type: 'POST',
            columnDefs: [
                {
                    render: function(data, type, row) {
                        return row.view + ' ' + row.edit + ' ' + row.print + ' ' + row.delete; // Gabungkan tombol 
                    },
                    targets: 6 // Target kolom indeks
                },
            
            ],
            columns: [{
                    data: 'NOSURAT',
                },
                {
                    data: 'TGL_INPUT'
                },
                {
                    data: 'INVOICE_NOTA'
                },
                {
                    data: 'NAMA'
                },
                {
                    data: 'NOHP',
                    render: function(data, type, row) {
                        if (!data) return '-';
                        let formattedPhone = data.toString().trim();
                        if (formattedPhone.startsWith('0')) {
                            formattedPhone = '62' + formattedPhone.slice(1);
                        }
                        formattedPhone = formattedPhone.replace(/\D/g, '');
                        return '<a href="https://wa.me/' + formattedPhone + '" target="_blank" style="text-decoration: underline; color: #007bff;">' + data + '</a>';
                    }
                },
                {
                    data: 'KETERANGAN',
                    render: function(data, type, row) {
                            var badgeStyle = 'display:inline-block; min-width:110px; font-size:0.95rem; padding:0.45rem 0.7rem; text-align:center;';
                            if (data === 'on process') {
                                return '<span class="badge bg-warning text-dark" style="' + badgeStyle + '">on process</span>';
                            } else if (data === 'selesai') {
                                return '<span class="badge bg-success" style="' + badgeStyle + '">selesai</span>';
                            } else {
                                return '<span class="badge bg-danger" style="' + badgeStyle + '">reject</span>';
                            }
                    }
                },
                {
                    data: 'view', orderable: false
                },

            ]
        });
}

function viewReturn() {
    $('.view_return').click(function(e) {
        e.preventDefault();
        var nota = $(this).attr('href').split('=')[1];
        $.ajax({
            url: '/Transaksi/showService',
            type: 'POST',
            data: { no_surat: nota },
            dataType: 'json',
            success: function(response) {
                // console.log(response);
                $('#Modal-view-return').modal('show');
                var dataList = Array.isArray(response) ? response : (response ? [response] : []);
                var rows = '';
                $.each(dataList, function(index, item) {
                    $('#retur-nota-service').text(item.NOSURAT);
                    $('#retur-tanggal-terima').text(item.TGL_INPUT);
                    $('#retur-noref').text(item.REF_MP);
                    $('#retur-tgl-beli').text(item.TGL_BELI);
                    $('#retur-hp').text(item.NOHP);
                    $('#retur-nama').text(item.NAMA);
                    rows += '<tr>' +
                    '<td>' + (item.BARANG || '-') + '</td>' +
                    '<td>' + (item.RETURN_QTY || '-') + '</td>' +
                    '<td>' + (item.KELENGKAPAN || '-') + '</td>' +
                    '<td>' + (item.KERUSAKAN || '-') + '</td>' +
                    '</tr>';
                });
                $('#isi-tbl-view-return').html(rows);

            }, error: function(xhr, ajaxOptions, thrownError) {
                alert('Error menyimpan data: ' + xhr.responseText);
            }
        });

    })
}

function editReturn() {
    $('.edit_return').click(function(e) {
        e.preventDefault();
        var no_surat = $(this).attr('href').split('=')[1];
        $.ajax({
            url: '/Transaksi/showService',
            type: 'POST',
            data: { no_surat: no_surat },
            dataType: 'json',
                success: function(response) {
                    $('#ModalEditStatusReturn').modal('show');
                    var dataList = Array.isArray(response) ? response : (response ? [response] : []);
                    $.each(dataList, function(index, item) {
                    $('#edit_return_id').val(item.NOSURAT);
                });
            },
        })

    })
}

function saveEditStatusReturn() {
    var formData = $('#form-edit-status-return').serialize();
    $.ajax({
        type: "POST",
        async: false,
        url: '/Transaksi/save_editreturn',
        data: formData,
        dataType: "JSON",
        success: function(result) {
            console.log(result);
            if (result.status === 'success') {
                Swal.fire('Berhasil!', 'Data berhasil diupdate!', 'success');
                $('#ModalEditStatusReturn').modal('hide');
                $('#form-edit-status-return')[0].reset();
                $('#tbl-daftar-return').DataTable().ajax.reload(); // Reload DataTable
            } else {
                alert('Gagal mengupdate data!');
            }
        },
        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
    });
}


function deletelistReturn() {
    $('.delete_return').click(function(e) {
        e.preventDefault();
        var nota = $(this).attr('href').split('=')[1];
        Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                url: '/Transaksi/deletereturn',
                type: 'POST',
                data: { nota: nota },
                dataType: 'json',
                success: function(response) {
                    Swal.fire(
                        'Terhapus!',
                        'Data berhasil dihapus.',
                        'success'
                    );
                    $('#tbl-daftar-return').DataTable().ajax.reload();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat menghapus data.',
                        'error'
                    );
                }
                });
            }
        });
    });
    
}

function addinvoice_return() {
        $('#Modal-return-cari-barang').modal('show');
        $('#tbl-daftarbrg-retur').DataTable().destroy();
        $('#tbl-daftarbrg-retur').DataTable({
             processing: true,
             serverSide: true,
             ajax: '/Transaksi/TampilBarangReturn',
             type: 'POST',
              columnDefs: [
                  {
                      render: function(data, type, row) {
                          return row.tambah; 
                      },
                      targets: 3  //Target kolom indeks
                  },
            
              ],
             columns: [{
                     data: 'id_inv',
                 },
                 {
                     data: 'TGL_TRX',
                 },
                 {
                     data: 'inv_ol',
                 },
                 {
                      data: 'tambah', orderable: false, searchable: false
                 },

             ]
         });
}



function tambahBarangReturn() {
    $(".add_return").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            async: false,
            url: $(this).attr('href'),
            dataType: "JSON",
            success: function(result) {
                console.log(result);
                for (var i = 0; i < result.length; i++) {
                    $('#invoice').val(result[i].id_inv);
                    $('#ref').val(result[i].inv_ol);
                    $('#garansi').val(result[i].TGL_TRX);
                    $('#Modal-return-cari-barang').modal('hide');

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
})
}

            


