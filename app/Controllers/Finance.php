<?php

namespace App\Controllers;

use App\Models\Pembelian;
use App\Models\Masterbarang;
use App\Models\Supplier;
use App\Models\InvPenjualan;
use App\Models\Customer;
use App\Models\Listpenjualan;
use App\Models\PenjualanModel;
use App\Models\Garansi;
use App\Models\BukuKas;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\GajiKaryawan;
use CodeIgniter\Exceptions\AlertError;
use \Hermawan\DataTables\DataTable;

class Finance extends BaseController
{
	protected Pembelian $pembelian;
	protected Masterbarang $masterbarang;
	protected Supplier $supplier;
	protected InvPenjualan $inv_pj;
	protected Customer $customer;
	protected Listpenjualan $list_pj;
	protected PenjualanModel $penjualanID;
	protected Garansi $garansi;
	protected BukuKas $bukukas;
	protected Karyawan $karyawan;
	protected Jabatan $jabatan;
	protected GajiKaryawan $gajikaryawan;
	public function __construct()
	{
		$this->pembelian = new Pembelian();
		$this->masterbarang = new Masterbarang();
		$this->supplier = new Supplier();
		$this->inv_pj = new InvPenjualan();
		$this->customer = new Customer();
		$this->list_pj = new Listpenjualan();
		$this->penjualanID = new PenjualanModel();
		$this->garansi = new Garansi();
		$this->bukukas = new BukuKas();
		$this->karyawan = new Karyawan();
		$this->jabatan = new Jabatan();
		$this->gajikaryawan = new GajiKaryawan();
	}

	// CONTROLLER PAGE FINANCE===================================
	// CONTROLLER PAGE FINANCE > KARYAWAN===================================
	public function index()
	{
		$data = [
			'tittle' => 'Karyawan - VSKomputer'
		];
		return view('/finance/karyawan', $data);
	}

	public function setting()
	{
		$data = [
			'tittle' => 'Setting Karyawan - VSKomputer',
			'jabatan' => $this->jabatan->showjabatan()
		];
		return view('/finance/setting_karyawan', $data);
	}

	public function gaji()
	{
		$data = [
			'tittle' => 'Gaji Karyawan - VSKomputer'
		];
		return view('/finance/gaji', $data);
	}

	public function addnewKaryawan()
	{
		if ($this->request->isAJAX()) {
			$data = [
				'id_jabatan' => $this->request->getVar('kategori-jabatan-karyawan'),
				'nik_karyawan' => $this->request->getVar('nik-karyawan'),
				'nama_karyawan' => ucwords($this->request->getVar('nama-karyawan')),
				'email_karyawan' => $this->request->getVar('email-karyawan'),
				'hp_karyawan' => $this->request->getVar('hp-karyawan'),
				'ttl_karyawan' => $this->request->getVar('tl-karyawan'),
				'jenkel_karyawan' => $this->request->getVar('jenkel-karyawan'),
				'alamat_karyawan' => ucwords($this->request->getVar('alamat-karyawan')),
				'tglmasuk_karyawan' => $this->request->getVar('tanggal-masuk-karyawan'),
				'status_karyawan' => $this->request->getVar('status-karyawan')
			];
			$this->karyawan->insert($data);
			return json_encode(['status' => 'success', 'message' => 'Data Buku Kas Berhasil Ditambahkan']);
		}
	}

	public function addnewJabatan()
	{
		if ($this->request->isAJAX()) {
			$data = [
				'departement_jabatan' => ucwords($this->request->getVar('dept-jabatan')),
				'nama_jabatan' => ucwords($this->request->getVar('nama-jabatan')),
				'gaji_jabatan' => $this->request->getVar('gaji-jabatan'),
			];
			$this->jabatan->insert($data);
			return json_encode(['status' => 'success', 'message' => 'Data Buku Kas Berhasil Ditambahkan']);
		}
	}

	public function showdatakaryawan()
	{
		$viewdata = $this->karyawan->table('karyawan')->select('id_karyawan, nik_karyawan, nama_karyawan, email_karyawan, 
		hp_karyawan, ttl_karyawan, jenkel_karyawan, alamat_karyawan, tglmasuk_karyawan, status_karyawan, departement_jabatan, nama_jabatan')->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan')->orderBy('karyawan.id_jabatan', 'DESC');
		return DataTable::of($viewdata)->add('aksi', function ($row) {
			return '<a href="/finance/edit_karyawan?id=' . $row->id_karyawan . '" class="edit-karyawan"><button class="btn btn-warning btn-sm ti-pencil-alt " type="button" onclick=""></button></a>';
		})->add('delete', function ($row) {
			return '<a href="/finance/delete_karyawan?id=' . $row->id_karyawan . '" class="delete-karyawan"><button class="btn btn-danger btn-sm ti-trash " type="button" onclick="delete_karyawan()"></button></a>';
		})->toJson(true);
	}

	public function delete_karyawan()
	{
		if ($this->request->isAJAX()) {
			$idkaryawan = $this->request->getVar('id');
			$this->karyawan->delete($idkaryawan);
			$result = ['status' => 'success'];
			return json_encode($result);
		}
	}

	public function showdatajabatan()
	{
		$viewdata = $this->jabatan->table('jabatan')->select('id_jabatan, departement_jabatan, nama_jabatan, gaji_jabatan');
		return DataTable::of($viewdata)->add('delete', function ($row) {
			return '<a href="/finance/delete_jabatan?id=' . $row->id_jabatan . '" class="delete-jabatan"><button class="btn btn-danger btn-sm ti-trash " type="button" onclick=""></button></a>';
		})->add('edit', function ($row) {
			return '<a href="/finance/edit_jabatan?id=' . $row->id_jabatan . '" class="edit-jabatan"><button class="btn btn-warning btn-sm ti-pencil-alt" type="button" onclick=""></button></a>';
		})->toJson(true);
	}
	// END CONTROLLER PAGE FINANCE > KARYAWAN===================================
	// CONTROLLER PAGE FINANCE / PENJUALAN===================================
	public function laporan_penjualan()
	{
		$data = [
			'tittle' => 'Laporan Penjualan - VSKomputer'
		];
		return view('/finance/laporan_pj', $data);
	}

	public function view_invoice()
	{
		$invoice = $this->request->getVar('invoice');
		$result_listnota = $this->penjualanID->GetListNota($invoice);
		$result_qty = $this->penjualanID->JumlahQTY($invoice);
		$result_hargaawal = $this->penjualanID->JumlahHargaAwal($invoice);
		$result_hargajual = $this->penjualanID->JumlahHargaJual($invoice);

		$result = [
			'listnota' => $result_listnota,
			'qty' => $result_qty,
			'hargaawal' => $result_hargaawal,
			'hargajual' => $result_hargajual,
		];
		return json_encode($result);
	}

	public function edit_invoice() //pertimbangkan perlu diganti short by invoice dari db penjualan (on proses)
	{
		$invoice = $this->request->getVar('invoice');
		$result = $this->inv_pj->show_edit_inv($invoice);
		return json_encode($result);
	}

	public function saveinfoinvoice()
	{
		if ($this->request->isAJAX()) {
			$invoice = $this->request->getVar('invoice');
			$tgl_trx = $this->request->getVar('tangal-laporan-edit');
			$tgl_tempo = $this->request->getVar('jatuh-tempo-laporan-edit');
			$status_text = 'Pencairan Dana Pending';
			if (!empty($tgl_trx) && !empty($tgl_tempo)) {
				$date_trx = new \DateTime($tgl_trx);
				$date_tempo = new \DateTime($tgl_tempo);

				// Menghilangkan komponen jam/menit/detik agar murni membandingkan tanggalnya saja
				$date_trx->setTime(0, 0, 0);
				$date_tempo->setTime(0, 0, 0);

				if ($date_trx < $date_tempo) {
					$status_text = 'Pending';
				} elseif ($date_trx > $date_tempo) {
					$status_text = 'Terlambat';
				} else {
					$status_text = 'Selesai';
				}
			}
			// var_dump($invoice);
			$data = [
				'TGL_TRX' => $this->request->getVar('tangal-laporan-edit'),
				'GRAND_TOTAL' => $this->request->getVar('gtotal-laporan-edit'),
				'BARANG' => $this->request->getVar('customer-laporan-edit'),
				'inv_ol' => $this->request->getVar('keterangan-laporan-edit'),
				'ongkir' => $this->request->getVar('biayamin-laporan-edit'),
				'laba_ongkir' => $this->request->getVar('biayaplus-laporan-edit'),
				'potongan' => $this->request->getVar('biayaadm-laporan-edit'),
				'modal' => $this->request->getVar('modal-laporan-edit'),
				'laba_bersih' => $this->request->getVar('gtotal-laporan-edit') - $this->request->getVar('modal-laporan-edit') - $this->request->getVar('biayamin-laporan-edit') + $this->request->getVar('biayaplus-laporan-edit') - $this->request->getVar('biayaadm-laporan-edit'),
				'INV_JATUH_TEMPO' => $this->request->getVar('jatuh-tempo-laporan-edit'),
				'INV_STATUS' => $status_text
			];
			// var_dump($data);
			$this->inv_pj->update($invoice, $data);
			return $this->response->setJSON(['success' => true]);
		}
	}

	public function viewdata_invoice_penjualan()
	{
		$request = \Config\Services::request();

		$viewdata = $this->inv_pj->select('id_inv, TGL_TRX, BARANG, inv_ol, GRAND_TOTAL, ongkir, laba_ongkir, potongan, modal, 
		laba_bersih, INV_JATUH_TEMPO, INV_STATUS')->orderBy('TGL_TRX', 'DESC');
		return DataTable::of($viewdata)->filter(function ($builder) use ($request) {
			$startDate = $request->getGet('pj_start_date');
			$endDate = $request->getGet('pj_end_date');

			if (!empty($startDate) && !empty($endDate)) {
				$builder->where('TGL_TRX >=', $startDate)
					->where('TGL_TRX <=', $endDate);
			}
		})->add('view', function ($row) {
			return '<a href="/finance/view_invoice?invoice=' . $row->id_inv . '" class="view-invoice"><button class="btn btn-primary btn-sm ti-list " type="button" onclick="view_inv()"></button></a>';
		})->add('action', function ($row) {
			return '<a href="/finance/edit_invoice?invoice=' . $row->id_inv . '" class="edit-invoice"><button class="btn btn-primary btn-sm ti-pencil-alt " type="button" onclick="edit_invoice()"></button></a>';
		})->add('print', function ($row) {
			return '<a href="/transaksi/penjualan/print/' . $row->id_inv . '" target="_blank" class="btn btn-success btn-sm ti-printer"></a>';
		})->add('delete', function ($row) {
			return '<a href="/laporan/penjualan/delete-invoice/' . $row->id_inv . '" class="" ><button class="btn btn-danger btn-sm ti-trash" type="button" onclick="return confirm(\'Yakin hapus data?\')"></button></a>';
		})->toJson(true);
	}

	public function deleteInvoicePenjualan($id)
	{
		$this->inv_pj->delete($id);
		$this->penjualanID->where('INV_PENJUALAN', $id)->delete();
		$this->garansi->where('INV_PENJUALAN', $id)->delete();
		return redirect()->to('/laporan/penjualan');
		// $id = $this->request->getVar('id');
		// $hapus = $this->pembelian->deletebuy($id);
		// if ($hapus) {
		// 	return redirect()->to('transaksi/pembelian');
		// }
	}
	// END CONTROLLER PAGE FINANCE / PENJUALAN===================================

	// CONTROLLER PAGE BUKU KAS===================================
	public function buku_kas()
	{
		$data = [
			'tittle' => 'Buku Kas - VSKomputer'
		];
		return view('/finance/buku_kas', $data);
	}

	public function save_buku_kas()
	{
		$saldo = 0;
		$jenis_transaksi = $this->request->getVar('jenis-transaksi-buku-kas');
		$pemasukan = ($jenis_transaksi == 'pemasukan') ? $this->request->getVar('pemasukan-buku-kas') : 0;
		$pengeluaran = ($jenis_transaksi == 'pengeluaran') ? $this->request->getVar('pengeluaran-buku-kas') : 0;

		if ($this->request->isAJAX()) {
			$data = [
				'ID_LOGIN' => $this->request->getVar('id-login-buku-kas'),
				'TANGGAL_KAS' => $this->request->getVar('tgl-buku-kas'),
				'RINCIAN_KAS' => ucwords($this->request->getVar('rincian-buku-kas')),
				'KATEGORI_KAS' => ucwords($this->request->getVar('kategori-buku-kas')),
				'PEMASUKAN_KAS' => $pemasukan,
				'PENGELUARAN_KAS' => $pengeluaran,
			];
			$this->bukukas->insert($data);
			return json_encode(['status' => 'success', 'message' => 'Data Buku Kas Berhasil Ditambahkan']);
		}
	}

	public function viewdata_buku_kas()
	{
		$builder = $this->bukukas->builder();

		// SOLUSI: Tambahkan '' AS SALDO agar properti SALDO terdaftar resmi di objek baris data library
		$builder->select("ID_KAS, TANGGAL_KAS, RINCIAN_KAS, KATEGORI_KAS, PEMASUKAN_KAS, PENGELUARAN_KAS, '' AS SALDO");

		$dataTable = DataTable::of($builder)
			->addNumbering('no')
			->edit('SALDO', function ($row) {
				// Hitung nilai saldo berjalan dinamis per baris data
				$db = \Config\Database::connect();
				$query = $db->query("SELECT SUM(b.PEMASUKAN_KAS - b.PENGELUARAN_KAS) AS total FROM buku_kas b WHERE b.ID_KAS <= ?", [$row->ID_KAS]);
				$result = $query->getRow();

				$nilai = $result->total ?? 0;
				return number_format($nilai, 0, ',', '.');
			})
			->format('PEMASUKAN_KAS', function ($value) {
				return number_format($value, 0, ',', '.');
			})
			->format('PENGELUARAN_KAS', function ($value) {
				return number_format($value, 0, ',', '.');
			});

		return $dataTable->toJson(true);
	}

	// public function viewdata_buku_kas()
	// {

	// 	$viewdata = $this->bukukas->select('ID_KAS, TANGGAL_KAS, RINCIAN_KAS, KATEGORI_KAS, PEMASUKAN_KAS, PENGELUARAN_KAS, 
	// 	(SELECT SUM(b.PEMASUKAN_KAS - b.PENGELUARAN_KAS) FROM buku_kas b WHERE b.ID_KAS <= buku_kas.ID_KAS) AS SALDO', false);

	// 	$search = $this->request->getPost('search');
	// 	$dataTable =  DataTable::of($viewdata)
	// 		->format('PEMASUKAN_KAS', function ($value) {
	// 			return number_format($value, 0, ',', '.');
	// 		})->format('PENGELUARAN_KAS', function ($value) {
	// 			return number_format($value, 0, ',', '.');
	// 		})->format('SALDO', function ($value) {
	// 			$nilai = $value ? $value : 0;
	// 			return number_format($nilai, 0, ',', '.');
	// 		});

	// 	if (isset($search['value']) && $search['value'] !== "") {
	// 		$dataTable->postQuery(function ($builder) {
	// 			// Mengosongkan batasan LIMIT yang otomatis dibuat oleh library
	// 			$builder->limit(null, null);
	// 		});
	// 	}
	// 	return $dataTable->toJson(true);
	// }
	// End CONTROLLER PAGE BUKU KAS===================================

	// CONTROLLER PAGE LAPORAN PEMBELIAN===================================
	public function laporanbl()
	{
		$data = [
			'tittle' => 'Laporan Pembelian - VSKomputer'
		];
		return view('/finance/laporan_bl', $data);
	}

	public function showpembelianAll()
	{
		// 1. Ambil instance request aktif dari CodeIgniter 4
		$request = \Config\Services::request();

		$viewdata = $this->pembelian->table('pembelian_barang')->select('ID_BELI, NAMA_BARANG, supplier.NAMA, NamaSUPP, JUMLAH, pembelian_barang.SATUAN, HARGA_BELI, TGL_GARANSI, TGL_BELI, BUY_PAYMENT, BUY_TGL_TEMPO, BUY_TGL_PELUNASAN')
			->join('master_barang', 'master_barang.ID_BARANG = pembelian_barang.ID_BARANG')
			->join('supplier', 'supplier.ID_SUPP = pembelian_barang.ID_SUPP')->orderBy('TGL_BELI', 'DESC');

		return DataTable::of($viewdata)->filter(function ($builder) use ($request) {
			$startDate = $request->getGet('start_date');
			$endDate = $request->getGet('end_date');

			if (!empty($startDate) && !empty($endDate)) {
				$builder->where('TGL_BELI >=', $startDate)
					->where('TGL_BELI <=', $endDate);
			}
		})->add('delete', function ($row) {
			return '<a href="/Transaksi/deletePembelian?id=' . $row->ID_BELI . '" class="delete-buy"><button class="btn btn-danger btn-sm mdi mdi-delete" type="button" onclick="deletePembelian()"></button></a>';
		})->add('edit', function ($row) {
			return '<a href="/Finance/viewPembelian?id=' . $row->ID_BELI . '" class="edit-buy"><button class="btn btn-warning btn-sm mdi mdi-pencil" type="button" onclick="editPembelian()"></button></a>';
		})->toJson(true);
	}

	public function viewPembelian()
	{
		if ($this->request->isAJAX()) {
			$idpembelian = $this->request->getVar('id');
			$result = $this->pembelian->showpembelianbyID($idpembelian);
			return json_encode($result);
		}
	}

	public function saveeditpembelian()
	{
		if ($this->request->isAJAX()) {
			$idpembelian = $this->request->getVar('input-id-pembelian');
			$data = [
				// 'ID_BELI' => $this->request->getVar('input-id-pembelian'),
				'BUY_PAYMENT' => $this->request->getVar('buy-payment'),
				'BUY_TGL_TEMPO' => $this->request->getVar('tgl-tempo-edit'),
				'BUY_TGL_PELUNASAN' => $this->request->getVar('tgl-pelunasan-edit')
			];
			$this->pembelian->update($idpembelian, $data);
			$result = ['status' => 'success'];
			return json_encode($result);
		}
	}
	// END CONTROLLER PAGE LAPORAN PEMBELIAN===================================

	public function laba()
	{
		$labaPaid = $this->inv_pj->JumlahLababyMonthSelesai()[0]['laba_bersih'];
		$totalBeban = $this->bukukas->bebanOperasonal()[0]['PENGELUARAN_KAS'] + $this->bukukas->bebanGaji()[0]['PENGELUARAN_KAS'] + $this->bukukas->bebanPerlengkapan()[0]['PENGELUARAN_KAS'] + $this->bukukas->bebanUtilitas()[0]['PENGELUARAN_KAS'];
		$hasilSebelumPajak = $labaPaid - $totalBeban;
		$data = [
			'tittle' => 'Laba Penjualan - VSKomputer',
			'LabaPaid' => $this->inv_pj->JumlahLababyMonthSelesai(),
			'LabaPending' => $this->inv_pj->JumlahLababyMonthPending(),
			'JumlahLabaBulanIni' => $this->inv_pj->JumlahLababyMonth(),
			'BebanOperasional' => $this->bukukas->bebanOperasonal(),
			'BebanGaji' => $this->bukukas->bebanGaji(),
			'BebanPerlengkapan' => $this->bukukas->bebanPerlengkapan(),
			'BebanUtilitas' => $this->bukukas->bebanUtilitas(),
			'TotalBeban' => $totalBeban,
			'HasilSebelumPajak' => $hasilSebelumPajak,
			'PajakPaymentCash' => $this->inv_pj->PajakPaymentCash(),
			'showBebanOperasional' => $this->bukukas->showBebanOperasional(),
			'showBebanGaji' => $this->bukukas->showBebanGaji(),
			'showBebanPerlengkapan' => $this->bukukas->showBebanPerlengkapan(),
			'showBebanUtilitas' => $this->bukukas->showBebanUtilitas(),
			'TotalLabaCASH' => $this->inv_pj->TotalLabaCASH(),
			'TotalLabaTokopedia' => $this->inv_pj->TotalLabaTokopedia(),
			'TotalLabaShopee' => $this->inv_pj->TotalLabaShopee(),
			'TotalLabaCashPaid' => $this->inv_pj->TotalLabaCashPaid(),
			'TotalLabaTokopediaPaid' => $this->inv_pj->TotalLabaTokopediaPaid(),
			'TotalLabaShopeePaid' => $this->inv_pj->TotalLabaShopeePaid(),
			'TotalLabaCashPending' => $this->inv_pj->TotalLabaCashPending(),
			'TotalLabaTokopediaPending' => $this->inv_pj->TotalLabaTokopediaPending(),
			'TotalLabaShopeePending' => $this->inv_pj->TotalLabaShopeePending()
		];
		return view('/finance/laba', $data);
	}
}
