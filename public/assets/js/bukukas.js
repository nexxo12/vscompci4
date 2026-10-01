$("#jenis-transaksi-buku-kas").change(function() {
    var jenisTransaksi = $(this).val();
    if (jenisTransaksi === "pemasukan") {
        $("#rincian-form").show();
        $("#kategori-form").show();
        $("#pemasukan-form").show();
        $("#pengeluaran-form").hide();
    }
    else if (jenisTransaksi === "pengeluaran") {
        $("#rincian-form").show();
        $("#kategori-form").show();
        $("#pemasukan-form").hide();
        $("#pengeluaran-form").show();
    }   
    else {
        $("#rincian-form").hide();
        $("#kategori-form").hide();
        $("#pemasukan-form").hide();
        $("#pengeluaran-form").hide();
    }   
})


$("#btn-save-buku-kas").click(function(e){
    e.preventDefault();
    if ($("#jenis-transaksi-buku-kas").val() === "") {
        Swal.fire({
        title: 'Error!',
        text: 'Jenis transaksi harus dipilih.',
        icon: 'error',
        confirmButtonText: 'OK'
        });
        return;
    }
    if ($("#rincian-buku-kas").val() === "") {
        Swal.fire({
            title: 'Error!',
            text: 'Rincian kas harus diisi!',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }
    if ($("#kategori-buku-kas").val() === "") {
        Swal.fire({
            title: 'Error!',
            text: 'Kategori kas harus diisi!',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }
    var formData = $('#form-buku-kas').serialize();
    $.ajax({
        type: "POST",
        async: false,   
        url: '/Finance/save_buku_kas',
        data: formData,
        dataType: "JSON",
        success: function(result) {
            console.log(result);    
            if (result.status == 'success') {
                Swal.fire({
                    title: 'Berhasil!',
                    text: result.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                $('#form-buku-kas')[0].reset();
                $("#rincian-form").hide();
                $("#kategori-form").hide();
                $("#pemasukan-form").hide();
                $("#pengeluaran-form").hide();
                $('#datatable-buku-kas').DataTable().ajax.reload();
            }
        },
        error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
    });
})

$(document).ready(function() {
    $('#datatable-buku-kas').DataTable({
        processing: true,
        serverSide: true,
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

        buttons: [
            {
                extend: 'excelHtml5',
                text: '<span class="mdi mdi-file-excel-box"></span> Export',
                className: 'btn btn-success btn-sm mr-2',
            },
            {
                extend: 'pdfHtml5',
                text: '<span class="mdi mdi-file-pdf-box"></span> Export',
                className: 'btn btn-danger btn-sm',
            }
        ],

        ajax: '/Finance/viewdata_buku_kas',
        order: [[1, 'asc']],
        columns: [
            {
                data: 'no', orderable: false
            },
            {
                data: 'TANGGAL_KAS'
            },
            {
                data: 'RINCIAN_KAS'
            },
            {
                data: 'KATEGORI_KAS'
            },
            {
                data: 'PEMASUKAN_KAS'
            },
            {
                data: 'PENGELUARAN_KAS'
            },
            {
                data: 'SALDO',
                orderable: false,
                searchable: false
            }
        ]
    });
});

$(document).ready(function() {
        $('#kategori-buku-kas').select2({
            theme: 'bootstrap4',
            tags: true,           // FITUR UTAMA: Memungkinkan penambahan opsi baru
            placeholder: "Pilih Kategori",
            allowClear: true,     // Menambahkan tombol "x" untuk menghapus pilihan
            createTag: function (params) {
                var term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                // Mengembalikan teks yang diketik pengguna sebagai opsi baru
                return {
                    id: term,
                    text: term + ' (Tambah)', // Teks indikator saat menambah
                    newTag: true // menandai bahwa ini adalah tag baru
                }
            }
        });
});



