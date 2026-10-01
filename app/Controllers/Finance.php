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
	}

	// CONTROLLER PAGE FINANCE===================================
	public function add()
	{
		$data = [
			'tittle' => 'Tambah Karyawan - VSKomputer'
		];
		return view('/finance/add_karyawan', $data);
	}

	public function setting()
	{
		$data = [
			'tittle' => 'Setting Karyawan - VSKomputer'
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
			// var_dump($invoice);
			$data = [
				'TGL_TRX' => $this->request->getVar('tangal-laporan-edit'),
				'GRAND_TOTAL' => $this->request->getVar('gtotal-laporan-edit'),
				'inv_ol' => $this->request->getVar('keterangan-laporan-edit'),
				'ongkir' => $this->request->getVar('biayamin-laporan-edit'),
				'laba_ongkir' => $this->request->getVar('biayaplus-laporan-edit'),
				'potongan' => $this->request->getVar('biayaadm-laporan-edit'),
				'modal' => $this->request->getVar('modal-laporan-edit'),
				'laba_bersih' => $this->request->getVar('gtotal-laporan-edit') - $this->request->getVar('modal-laporan-edit') - $this->request->getVar('biayamin-laporan-edit') + $this->request->getVar('biayaplus-laporan-edit') - $this->request->getVar('biayaadm-laporan-edit'),
			];
			// var_dump($data);
			$this->inv_pj->update($invoice, $data);
			return $this->response->setJSON(['success' => true]);
		}
	}

	public function viewdata_invoice_penjualan()
	{
		$viewdata = $this->inv_pj->select('id_inv, TGL_TRX, inv_ol, GRAND_TOTAL, ongkir, laba_ongkir, potongan, modal, laba_bersih')->orderBy('TGL_TRX', 'DESC');
		return DataTable::of($viewdata)->addNumbering('no')->add('view', function ($row) {
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

		$viewdata = $this->bukukas->select('ID_KAS, TANGGAL_KAS, RINCIAN_KAS, KATEGORI_KAS, PEMASUKAN_KAS, PENGELUARAN_KAS, 
		(SELECT SUM(b.PEMASUKAN_KAS - b.PENGELUARAN_KAS) FROM buku_kas b WHERE b.ID_KAS <= buku_kas.ID_KAS) AS SALDO', false);
		return DataTable::of($viewdata)->addNumbering('no')
			->format('PEMASUKAN_KAS', function ($value) {
				return number_format($value, 0, ',', '.');
			})->format('PENGELUARAN_KAS', function ($value) {
				return number_format($value, 0, ',', '.');
			})->format('SALDO', function ($value) {
				$nilai = $value ? $value : 0;
				return number_format($nilai, 0, ',', '.');
			})
			->toJson(true);
	}
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
		$viewdata = $this->pembelian->table('pembelian_barang')->select('ID_BELI, NAMA_BARANG, supplier.NAMA, NamaSUPP, JUMLAH, pembelian_barang.SATUAN, HARGA_BELI, TGL_GARANSI, TGL_BELI, BUY_PAYMENT, BUY_TGL_TEMPO, BUY_TGL_PELUNASAN')
			->join('master_barang', 'master_barang.ID_BARANG = pembelian_barang.ID_BARANG')
			->join('supplier', 'supplier.ID_SUPP = pembelian_barang.ID_SUPP')->orderBy('TGL_BELI', 'DESC');
		return DataTable::of($viewdata)->filter(function ($builder, $request) {
			if (isset($request->start_date) && isset($request->end_date) && $request->start_date != '' && $request->end_date != '') {
				$startDate = $request->start_date;
				$endDate = $request->end_date;

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
	// END CONTROLLER PAGE LAPORAN PEMBELIAN===================================

	public function laba()
	{
		$data = [
			'tittle' => 'Laba Penjualan - VSKomputer'
		];
		return view('/finance/laba', $data);
	}
}
