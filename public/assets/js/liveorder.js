$(document).ready(function() {
   let lastTotal = null;
    let lastId = null;
    let newHighlightId = null;
    let soundEnabled = true;
    let selectedVoice = null;
    
    function muatSuaraIndonesia() {
        if (!('speechSynthesis' in window)) return;
        const voices = window.speechSynthesis.getVoices();
        selectedVoice = voices.find(v => v.lang === 'id-ID' || v.lang === 'id_ID') || null;
    }

    if ('speechSynthesis' in window) {
        muatSuaraIndonesia();
        window.speechSynthesis.onvoiceschanged = muatSuaraIndonesia;
    }

    function ucapkanNotifOrder(teks = 'Order baru masuk, tolong segera cek dan proses') {
        if (!soundEnabled || !('speechSynthesis' in window)) return;

        // Bersihkan antrean suara lama agar speechSynthesis tidak macet di Chrome/Edge
        window.speechSynthesis.cancel();

        const ucapan = new SpeechSynthesisUtterance(teks);
        ucapan.lang = 'id-ID';
        if (selectedVoice) {
            ucapan.voice = selectedVoice;
        }
        ucapan.rate = 1.05;  // Kecepatan bicara normal-sedikit cepat
        ucapan.pitch = 1.0;  // Nada normal
        ucapan.volume = 1.0; // Volume penuh

        window.speechSynthesis.speak(ucapan);
    }

    //Buka kunci izin suara browser pada interaksi pertama apa pun di halaman
    $(document).one('click keydown touchstart', function() {
        if (soundEnabled && 'speechSynthesis' in window) {
            const unlock = new SpeechSynthesisUtterance('');
            unlock.volume = 0;
            window.speechSynthesis.speak(unlock);
        }
    });
    // 4. Tombol kontrol tes suara & mute/unmute
    $('#btn-toggle-sound').on('click', function() {
        soundEnabled = !soundEnabled;
        if (soundEnabled) {
            $(this).removeClass('btn-outline-secondary').addClass('btn-success')
                   .html('<i class="fa fa-volume-up mr-1"></i> Suara Aktif');
            ucapkanNotifOrder('Suara notifikasi order aktif');
        } else {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
            }
            $(this).removeClass('btn-success').addClass('btn-outline-secondary')
                   .html('<i class="fa fa-volume-off mr-1"></i> Suara Mati');
        }
    });

    const PRINTED_STORAGE_KEY = 'vsk_live_printed_orders';
    let printedOrders = JSON.parse(localStorage.getItem(PRINTED_STORAGE_KEY) || '[]');

    function tandaiSudahDicetak(idInv) {
        if (!idInv) return;
        idInv = String(idInv);
        if (!printedOrders.includes(idInv)) {
        printedOrders.push(idInv);
        localStorage.setItem(PRINTED_STORAGE_KEY, JSON.stringify(printedOrders));
    }
}

    // Inisialisasi DataTables (menggunakan GET agar tidak terblokir CSRF CI4)
    let tableOrder = $('#tbl-live-order').DataTable({
        processing: false,
        serverSide: true,
        autoWidth: false,
        ordering: false, // Biarkan urutan mengikuti ORDER BY nota terbaru dari Controller
        ajax: {
            url: '/transaksi/viewdata_order',
            type: 'GET',
            data: function(d) {
                d.tanggal = $('#filter_tanggal_order').val();
            }
        },
        columns: [
            { data: 'id_inv' },
            { data: 'TGL_TRX' },
            { data: 'BARANG' },
            { data: 'inv_ol' },
            {
                data: 'GRAND_TOTAL',
                render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
            },
            {
              data: 'id_inv', // Gunakan id_inv sebagai acuan pengecekan status cetak
                searchable: false,
                render: function(data, type, row) {
                let idInv = String(row.id_inv || '');
                if (printedOrders.includes(idInv)) {
                    return '<span class="badge badge-success status-cetak-badge">Sudah dicetak / dicek</span>';
                }
                    return '<span class="badge badge-warning status-cetak-badge">Belum di cetak / dicek</span>';
                }
            },
            { data: 'print', searchable: false }
        ],
        createdRow: function(row, data) {
            if (newHighlightId && data.id_inv === newHighlightId) {
                $(row).addClass('table-success');
                setTimeout(() => $(row).removeClass('table-success'), 8000);
            }
        }
    });

    // 3. Event saat tombol Print diklik (jangan pakai e.preventDefault agar tab print tetap terbuka)
    $(document).on('click', '.btn-print-order', function() {
        let idInv = $(this).data('id');

        // Simpan status ke daftar sementara browser
        tandaiSudahDicetak(idInv);

        // Ubah tampilan badge di baris tersebut secara instan
        $(this).closest('tr').find('.status-cetak-badge')
        .removeClass('badge-warning')
        .addClass('badge-success')
        .text('Sudah dicetak / dicek');
    });

    // Jika tanggal diganti manual oleh user, reset pemantau & muat ulang tabel
    $('#filter_tanggal_order').on('change', function() {
        lastTotal = null;
        lastId = null;
        tableOrder.ajax.reload();
        pantauOrderBaru();
    });

    window.addEventListener('offline', function() {
    $('#live-dot')
        .addClass('offline')
        .attr('title', 'Jaringan terputus (Offline)');
    });

    window.addEventListener('online', function() {
    pantauOrderBaru(); // Langsung cek ke server begitu internet kembali nyala
    });

    // Fungsi Live Polling setiap 3 detik
    function pantauOrderBaru() {
        let tglAktif = $('#filter_tanggal_order').val();

        $.ajax({
            url: '/transaksi/cek_order_terbaru',
            type: 'GET',
            data: { tanggal: tglAktif, _: Date.now() },
            dataType: 'json',
            cache: false,
            timeout: 5000, // Anggap terputus jika server tidak merespons > 5 detik
            success: function(res) {
                $('#live-dot')
                .removeClass('offline')
                .attr('title', 'Live Monitoring Aktif');

                // Simpan kondisi awal saat halaman pertama kali dibuka
                if (lastTotal === null) {
                    lastTotal = res.total;
                    lastId = res.last_id;
                    return;
                }

                // Jika jumlah data bertambah ATAU ID nota terakhir berubah
                if (res.total !== lastTotal || res.last_id !== lastId) {
                    let adaOrderMasuk = (res.total > lastTotal) || (res.last_id !== '' && res.last_id !== lastId);

                    lastTotal = res.total;
                    lastId = res.last_id;

                    if (adaOrderMasuk) {
                        newHighlightId = res.last_id;

                        // Ambil 4 digit nomor belakang nota untuk dibacakan (misal: VSC211126-3553 -> 3553)
                        let nomorUrut = res.last_id.includes('-') ? res.last_id.split('-').pop() : res.last_id;
                        ucapkanNotifOrder('Order baru masuk, nomor ' + nomorUrut + ', tolong segera cek dan proses');
                    }

                    // Reload tabel secara live tanpa refresh halaman
                    tableOrder.ajax.reload(null, false);
                }
            },
            error: function() {
                $('#live-dot')
                    .addClass('offline')
                    .attr('title', 'Jaringan terputus (Offline)');
            }
        });
    }

    pantauOrderBaru();
    setInterval(pantauOrderBaru, 3000);
});

