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
use CodeIgniter\Exceptions\AlertError;
use \Hermawan\DataTables\DataTable;

class Finance extends BaseController
{
	protected $pembelian;
	protected $masterbarang;
	protected $supplier;
	protected $inv_pj;
	protected $customer;
	protected $list_pj;
	protected $penjualanID;
	protected $garansi;
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

	public function edit_invoice()
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
		$viewdata = $this->inv_pj->select('id_inv, TGL_TRX, inv_ol, GRAND_TOTAL, ongkir, laba_ongkir, potongan, modal, laba_bersih');
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


	public function laporanbl()
	{
		$data = [
			'tittle' => 'Laporan Pembelian - VSKomputer'
		];
		return view('/finance/laporan_bl', $data);
	}

	public function laba()
	{
		$data = [
			'tittle' => 'Laba Penjualan - VSKomputer'
		];
		return view('/finance/laba', $data);
	}
}
