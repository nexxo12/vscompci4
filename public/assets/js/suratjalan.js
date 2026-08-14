$(document).ready(function() {
    generateNoSuratJalanService();
    show_barang_suratjalan_service();
});

$("#btn-suratjalan-service").click(function(event) {
        event.preventDefault();
        // // alert("oke");
        $("#ModalSuratJalan").modal("show");
        $('#tbl-daftar-suratjalan').DataTable({
            autoWidth: true,
            processing: true,
            serverSide: true,
            ajax: '/Transaksi/view_daftar_suratjalan',
            type: 'POST',
            columnDefs: [
                {
                    render: function(data, type, row) {
                        return row.edit + ' ' + row.print + ' ' + row.delete; // Gabungkan tombol edit dan delete
                    },
                    targets: 6 // Target kolom indeks
                },
            
            ],
            columns: [{
                    data: 'SURAT_NOMOR',
                },
                {
                    data: 'SURAT_TANGGAL'
                },
                {
                    data: 'SURAT_KEPADA'
                },
                {
                    data: 'SURAT_BARANG'
                },
                {
                    data: 'SURAT_KERUSAKAN'
                },
                {
                    data: 'SURAT_STATUS',
                    render: function(data, type, row) {
                            var badgeStyle = 'display:inline-block; min-width:110px; font-size:0.95rem; padding:0.45rem 0.7rem; text-align:center;';
                            if (data === 'Proses') {
                                return '<span class="badge bg-warning text-dark" style="' + badgeStyle + '">Proses</span>';
                            } else if (data === 'Selesai') {
                                return '<span class="badge bg-success" style="' + badgeStyle + '">Selesai</span>';
                            } else if (data === 'Potong Nota') {
                                return '<span class="badge bg-info" style="' + badgeStyle + '">Potong Nota</span>';
                            } else if (data === 'Reject') {
                                return '<span class="badge bg-danger" style="' + badgeStyle + '">Reject</span>';
                            } else {
                                return '<span class="badge bg-secondary" style="' + badgeStyle + '">Unknown</span>';
                            }
                    }
                },
                {
                    data: 'edit', orderable: false
                },

            ]
        });
});

function delete_sj_service() {
        $(".delete_SJ").click(function(e) {
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
                            $('#tbl-daftar-suratjalan').DataTable().ajax.reload(); // Reload DataTable
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

function edit_sj_service() {
    $(".edit_SJ").click(function(e) {
        e.preventDefault();
        $("#ModalEditSuratJalan").modal("show");
        // var noSuratService = $(this).attr('href').split('=')[1];
        $.ajax({
            type: "POST",
            async: false,
            url: $(this).attr('href'),
            dataType: "JSON",
            success: function(result) {
                console.log(result);
                for (var i = 0; i < result.length; i++) {
                    $('#edit_suratjalan_id').val(result[i].SURAT_NOMOR);
                    $('#edit_suratjalan_status').val(result[i].SURAT_STATUS);

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
        });

    })
}

$(".btn-save-edit-suratjalan-service").click(function(e) {
    e.preventDefault();
    // alert("oke");
    var formData = $('#form-edit-suratjalan-service').serialize();
    $.ajax({
        type: "POST",
        async: false,
        url: '/Transaksi/save_edit_suratjalan_service',
        data: formData,
        dataType: "JSON",
        success: function(result) {
            console.log(result);
            if (result.status === 'success') {
                Swal.fire('Berhasil!', 'Data berhasil diupdate!', 'success');
                $('#ModalEditSuratJalan').modal('hide');
                $('#form-edit-suratjalan-service')[0].reset();
                $('#tbl-daftar-suratjalan').DataTable().ajax.reload(); // Reload DataTable
            } else {
                alert('Gagal mengupdate data!');
            }   
        },
        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
    });
})
    

function generateNoSuratJalanService() {
    $.ajax({
        url: '/Transaksi/NoSuratJalanService',
        type: 'GET',
        dataType: 'json',
        cache: false,
        success: function(result) {
            // console.log(result);
            $("#no_suratservice").val("SJ-SR-"+result);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });

    $.ajax({
        url: '/Transaksi/NoSuratJalanPengiriman',
        type: 'GET',
        dataType: 'json',
        cache: false,
        success: function(result) {
            // console.log(result);
            $("#no_suratpengiriman").val("SJ-VSC-"+result);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

function show_barang_suratjalan_service() {
    $.ajax({
        url: '/Transaksi/getBarangService',
        type: 'GET',    
    dataType: 'json',
        success: function(result) {
            // console.log(result);
            var select = $("#sj-service-namabarang");
            select.empty();
            select.append('<option value="">-- Pilih Barang --</option>');
            $.each(result, function(index, item) {
                // console.log(item);
                select.append('<option value="' + item.NAMA_BARANG + '">' + item.NAMA_BARANG + '</option>');
            });
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });

}

function preview_suratjalan_service() {
    var noSuratService = $("#no_suratservice").val();
    $.ajax({
        url: '/Transaksi/Ctrl_showSuratJalanService',
        type: 'POST',
        data: { no_suratservice: noSuratService },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            $("#title-no-surat").text("No. Surat Jalan: " + noSuratService);
            var dataList = Array.isArray(result) ? result : (result ? [result] : []);

            if (!dataList || dataList.length === 0) {
                alert("Data tidak ditemukan untuk nomor surat jalan ini!");
                // bersihkan tampilan preview
                $("#title-kpd-surat").text("Kepada: -");
                $("#title-tgl-surat").text("Tanggal: -");
                $('#tbl-preview-suratjalan-service').html('');
                return;
            }
            
            var rows = '';
            var firstItem = dataList[0];
            
            $.each(dataList, function(index, item) {
                rows += '<tr>' +
                    '<td>' + (item.SURAT_BARANG || '-') + '</td>' +
                    '<td>' + (item.SURAT_QTY || '-') + '</td>' +
                    '<td>' + (item.SURAT_SERIAL || '-') + '</td>' +
                    '<td>' + (item.SURAT_KETERANGAN || '-') + '</td>' +
                    '<td>' + (item.SURAT_KERUSAKAN || '-') + '</td>' +
                    '</tr>';
            });
            
            $("#title-kpd-surat").text("Kepada: " + (firstItem ? firstItem.SURAT_KEPADA : '-'));
            $("#title-tgl-surat").text("Tanggal: " + (firstItem ? firstItem.SURAT_TANGGAL : '-'));

            // target table body; if no tbody exists, append directly to table
            // var tbody = $('#tbl-preview-suratjalan-service tbody');
            // if (tbody.length === 0) {
            //     $('#tbl-preview-suratjalan-service').html(rows);
            // } else {
            //     tbody.html(rows);
            // }
            $('#tbl-preview-suratjalan-service').html(rows);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

$("#btn-tambah-suratjalan-service").click(function(event) {
        event.preventDefault();
        
        if ($("#sj-service-namabarang").val() === "") {
            alert("Harap masukan nama barang!");
            return;
        }
        $.ajax({
            type: "POST",
            url: '/Transaksi/saveSuratJalanService',
            data: $('#form-suratjalan-service').serialize(),
            dataType: "JSON",
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            success: function(response) {
               console.log(response);
               preview_suratjalan_service();
                if (response.status === 'success') {
                    $("#preview-sj-service").show();
                    alert('Data berhasil ditambahkan!');
                    // $('#sj-service-namabarang').val('');
                    $('#kelengkapan-suratjalan-service').val('');
                    $('#serialnumber-suratjalan-service').val('');
                    $('#kerusakan-suratjalan-service').val('');
                }  else {
                    alert('Gagal menambahkan data!');
                }

            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });
});


$("#btn-suratjalan-service-print").click(function(event) {
        event.preventDefault();
        // alert("oke");
        var noSuratService = $("#no_suratservice").val();
        if ($("#tbl-preview-suratjalan-service tr").length === 0) {
            alert("Lengkapi data terlebih dahulu!!");
            return;
        }
        window.open('/transaksi/suratjalan/printsurat/' + noSuratService, '_blank');
        setTimeout(function() {
            location.reload();
        }, 500);
});


           
