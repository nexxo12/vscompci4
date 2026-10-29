const btnTambah = document.getElementById('btn-add-karyawan');
const btnClose = document.getElementById('btn-hide-karyawan');
const formKaryawan = document.getElementById('form-add-karyawan');

const btnTambahJabatan = document.getElementById('btn-add-jabatan');
const btnCloseJabatan = document.getElementById('btn-hide-jabatan');
const formJabatan = document.getElementById('form-add-jabatan');

const btnTambahDataKaryawan = document.getElementById('btn-add-datakaryawan');
const btnCloseDataKaryawan = document.getElementById('btn-hide-datakaryawan');
const tableKaryawan = document.getElementById('data-karyawan');

const btnTambahDataJabatan = document.getElementById('btn-add-datajabatan');
const btnCloseDataJabatan = document.getElementById('btn-hide-datajabatan');
const tableJabatan = document.getElementById('data-jabatan');

// scipt tombol show hide data karyawan
btnTambahDataKaryawan.addEventListener('click', function() {
    tableKaryawan.style.display = 'block'; // Tampilkan form
    btnTambahDataKaryawan.style.display = 'none';      // Sembunyikan tombol Tambah
    btnCloseDataKaryawan.style.display = 'inline-block'; // Tampilkan tombol Close
});

btnCloseDataKaryawan.addEventListener('click', function() {
    tableKaryawan.style.display = 'none';      // Sembunyikan form
    btnTambahDataKaryawan.style.display = 'inline-block'; // Tampilkan tombol Tambah
    btnCloseDataKaryawan.style.display = 'none';         // Sembunyikan tombol Close
});
// scipt tombol show hide data karyawan

// scipt tombol show hide data jabatan
btnTambahDataJabatan.addEventListener('click', function() {
    tableJabatan.style.display = 'block'; // Tampilkan form
    btnTambahDataJabatan.style.display = 'none';      // Sembunyikan tombol Tambah
    btnCloseDataJabatan.style.display = 'inline-block'; // Tampilkan tombol Close
});

btnCloseDataJabatan.addEventListener('click', function() {
    tableJabatan.style.display = 'none';      // Sembunyikan form
    btnTambahDataJabatan.style.display = 'inline-block'; // Tampilkan tombol Tambah
    btnCloseDataJabatan.style.display = 'none';         // Sembunyikan tombol Close
});
// scipt tombol show hide data jabatan

// Fungsi ketika tombol "Tambah" diklik
btnTambah.addEventListener('click', function() {
    formKaryawan.style.display = 'block'; // Tampilkan form
    btnTambah.style.display = 'none';      // Sembunyikan tombol Tambah
    btnClose.style.display = 'inline-block'; // Tampilkan tombol Close
});

// Fungsi ketika tombol "Close" diklik
btnClose.addEventListener('click', function() {
    formKaryawan.style.display = 'none';      // Sembunyikan form
    btnTambah.style.display = 'inline-block'; // Tampilkan tombol Tambah
    btnClose.style.display = 'none';         // Sembunyikan tombol Close
});

btnTambahJabatan.addEventListener('click', function() {
    formJabatan.style.display = 'block'; // Tampilkan form
    btnTambahJabatan.style.display = 'none';      // Sembunyikan tombol Tambah
    btnCloseJabatan.style.display = 'inline-block'; // Tampilkan tombol Close
});

// Fungsi ketika tombol "Close" diklik
btnCloseJabatan.addEventListener('click', function() {
    formJabatan.style.display = 'none';      // Sembunyikan form
    btnTambahJabatan.style.display = 'inline-block'; // Tampilkan tombol Tambah
    btnCloseJabatan.style.display = 'none';         // Sembunyikan tombol Close
});


$("#btn-save-add-karyawan").click(function(e) {
    e.preventDefault();
     $.ajax({
            type: "POST",
            async: false,
            url: '/finance/addnewKaryawan',
            data: $('#form-add-karyawan').serialize(),
            dataType: "JSON",
            success: function(result) {
                // console.log(result);
                if (result.status === 'success') {
                    Swal.fire('Berhasil!', 'Data karyawan berhasil disimpan!', 'success');
                    $('#form-add-karyawan')[0].reset();
                    formKaryawan.style.display = 'none'; 
                    btnTambah.style.display = 'inline-block';
                    btnClose.style.display = 'none';  
                } else {
                    alert('Gagal mengupdate data!');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });


});

function delete_karyawan() {
        $(".delete-karyawan").click(function(e) {
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
                            $('#tbl-setting-karyawan').DataTable().ajax.reload(); // Reload DataTable
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

$("#btn-save-add-jabatan").click(function(e) {
    e.preventDefault();
    let dept = $('#dept-jabatan').val().trim();
    let jabatan = $('#nama-jabatan').val().trim();
    let gaji = $('#gaji-jabatan').val().trim();
    if (dept === '' || jabatan === '' || gaji === '') {
        Swal.fire('Gagal!', 'Mohon isi semua data!', 'warning');
    }
    else{
        $.ajax({
            type: "POST",
            async: false,
            url: '/finance/addnewJabatan',
            data: $('#form-add-jabatan').serialize(),
            dataType: "JSON",
            success: function(result) {
                // console.log(result);
                if (result.status === 'success') {
                    Swal.fire('Berhasil!', 'Data jabatan berhasil disimpan!', 'success');
                    $('#form-add-jabatan')[0].reset();
                    formJabatan.style.display = 'none'; 
                    btnTambahJabatan.style.display = 'inline-block';
                    btnCloseJabatan.style.display = 'none';  
                } else {
                    alert('Gagal mengupdate data!');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
            }
        });
    }
   
});

$(document).ready(function() {
    const tblkaryawan = $('#tbl-setting-karyawan').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/finance/showdatakaryawan',
            type: 'POST',
            columnDefs: [{
                    // targets: [5,6], // Target kolom indeks
                    // render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
                },
                {
                    render: function(data, type, row) {
                        return row.aksi + ' ' + row.delete; // Gabungkan tombol edit dan delete
                    },
                    targets: 11 // Target kolom indeks
                }
            
            ],
            columns: [{
                    data: 'nama_karyawan',
                },
                {
                    data: 'departement_jabatan'
                },
                {
                    data: 'nama_jabatan'
                },
                {
                    data: 'nik_karyawan'
                },
                {
                    data: 'email_karyawan'
                },
                {
                    data: 'hp_karyawan',
                },
                {
                    data: 'ttl_karyawan',
                },
                {
                    data: 'jenkel_karyawan',
                },
                {
                    data: 'alamat_karyawan',
                },
                {
                    data: 'tglmasuk_karyawan',
                },
                {
                    data: 'status_karyawan',
                },
                {
                    data: 'aksi',
                },

            ]
        });
});

$(document).ready(function() {
    const tbljabatan = $('#tbl-setting-jabatan').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/finance/showdatajabatan',
            type: 'POST',
            columnDefs: [{
                    targets: [2], // Target kolom indeks
                    render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
                },
                {
                    render: function(data, type, row) {
                        return row.delete + ' ' + row.edit; // Gabungkan tombol edit dan delete
                    },
                    targets: 3 // Target kolom indeks
                }
            
            ],
            columns: [{
                    data: 'departement_jabatan',
                },
                {
                    data: 'nama_jabatan'
                },
                {
                    data: 'gaji_jabatan'
                },
                {
                    data: 'delete',
                },
            ]
        });
});
