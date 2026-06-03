document.addEventListener('DOMContentLoaded', function() {
    // Sembunyikan input saat halaman dimuat
    $("#input-invoice").attr("style", "display: none");
    $("#input-ref").attr("style", "display: none");
    $("#input-garansi").attr("style", "display: none");

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

// Fungsi AJAX untuk input data dari form#form-service menggunakan button#btn-service
document.getElementById('btn-service').addEventListener('click', function(e) {
    e.preventDefault();
Swal.fire({
    title: 'Konfirmasi',
    text: 'Apakah data sudah benar?',
    icon: 'info',
    showCancelButton: true,
    showDenyButton: true,
    confirmButtonText: 'Save + Print',
    denyButtonText: 'Save + Close',
    cancelButtonText: 'Batal',
    confirmButtonColor: '#3085d6',
    denyButtonColor: '#28a745',
    cancelButtonColor: '#d33'
}).then((result) => {
    if (result.isConfirmed) {
        // Aksi untuk Print
        window.print();
    } else if (result.isDenied) {
        // Aksi untuk Close
        Swal.fire('Disimpan', 'Data berhasil disimpan', 'success');
    } else if (result.dismiss === Swal.DismissReason.cancel) {
        // Aksi untuk Batal
        Swal.fire('Dibatalkan', 'Aksi dibatalkan', 'info');
    }
});

    // $('#ModalService').modal('show');
    // // Handle btn-close-modal click
    // document.getElementById('btn-close-modal').addEventListener('click', function() {
    //     saveFormData();
    // });

    // // Handle btn-print click
    // document.getElementById('btn-print').addEventListener('click', function() {
    //     saveFormData();
    //     printFormData();
    // });

    // // Function to save form data
    // function saveFormData() {
    //     const formData = $('#form-service').serialize();
    //     $.ajax({
    //         url: '/Transaksi/saveService',
    //         type: 'POST',
    //         data: formData,
    //         dataType: 'json',
    //         success: function(response) {
    //             alert('Data service berhasil disimpan!');
    //             $('#form-service')[0].reset();
    //             document.getElementById('jenis_service').dispatchEvent(new Event('change'));
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             alert('Error menyimpan data: ' + xhr.responseText);
    //         }
    //     });
    // }

    // // Function to print form data
    // function printFormData() {
    //     window.print();
    // }
});
