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
use PhpParser\Node\Stmt\Echo_;

class Transaksi extends BaseController
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

	// CONTROLLER PAGE PEMBELIAN===================================
	public function pembelian()
	{
		$data = [
			'tittle' => 'Pembelian - VSKomputer',
			'autonum' => $this->pembelian->AutoNumID(),
			'showbarang' => $this->masterbarang->ShowBarang(),
			'supplier' => $this->supplier->ShowSupplier(),
			'showpembelian' => $this->pembelian->showpembelian()
		];
		return view('/transaksi/pembelian', $data);
	}
	public function deletePembelian($id)
	{
		$this->pembelian->delete($id);
		return redirect()->to('/transaksi/pembelian');
		// $id = $this->request->getVar('id');
		// $hapus = $this->pembelian->deletebuy($id);
		// if ($hapus) {
		// 	return redirect()->to('transaksi/pembelian');
		// }
	}
	public function savePembelian()
	{
		$this->pembelian->insert([
			'ID_BELI' => $this->request->getVar('id_pembelian'),
			'ID_SUPP' => $this->request->getVar('id-supp'),
			'ID_BARANG' => $this->request->getVar('idbarang'),
			'JUMLAH' => $this->request->getVar('jumlah'),
			'NamaSUPP' => $this->request->getVar('nama_supp'),
			'SATUAN' => $this->request->getVar('satuan'),
			'HARGA_BELI' => $this->request->getVar('hargabeli'),
			'TGL_GARANSI' => $this->request->getVar('garansi_buy'),
			'TGL_BELI' => $this->request->getVar('tanggal_input'),
		]);
		session()->setFlashData('pesan', 'Data Pembelian Berhasil Ditambahkan');
		return redirect()->to('/transaksi/pembelian');
	}
	//  END CONTROLLER PEMBELIAN======================================

	// CONTROLLER PAGE PENJUALAN===================================
	public function penjualan()
	{
		$data = [
			'tittle' => 'Penjualan - VSKomputer',
			'autonumPJ' => $this->inv_pj->invoicepj(),
			'showbarang' => $this->masterbarang->ShowBarang(),
			'showcustomer' => $this->customer->showcustomer()
		];
		return view('/transaksi/penjualan', $data);
	}

	public function showstok()
	{
		if ($this->request->isAJAX()) {
			$result = $this->masterbarang->showCariBarang();
			return json_encode($result);
			// $db = \Config\Database::connect();
			// $builder = $db->table('master_barang')->select('ID_BARANG, NAMA_BARANG, STOK, HARGA_JUAL');
			// return DataTable::of($builder)->toJson();
		}
	}

	public function addbarang()
	{
		$idbarang = $this->request->getVar('id');
		$result = $this->masterbarang->showbarangbyid($idbarang);
		return json_encode($result);
	}

	public function printnota($inv) //FUNCTICON DI ROUTE
	{
		// $invnota = $this->request->getVar('inv');
		$nota_inv = $this->penjualanID->GetListNota($inv);
		$sum_qty = $this->penjualanID->JumlahQTY($inv);
		$sum_subtotal = $this->penjualanID->JumlahSubtotal($inv);
		$sum_totalharga = $this->penjualanID->JumlahTotalHarga($inv);
		$sum_dp = $this->penjualanID->JumlahDP($inv);
		$sum_diskon = $this->penjualanID->JumlahDiskon($inv);
		$sum_nett = $this->penjualanID->JumlahNett($inv);
		$data = [
			'tittle' => 'Print Nota ' . $inv,
			'viewnota' => $nota_inv,
			'sum_qty' => $sum_qty,
			'sum_subtotal' => $sum_subtotal,
			'sum_totalharga' => $sum_totalharga,
			'sum_dp' => $sum_dp,
			'sum_diskon' => $sum_diskon,
			'sum_nett' => $sum_nett

		];
		// var_dump($data['viewnota']);
		return view('/transaksi/print', $data);
	}

	public function showlistbarang()
	{
		if ($this->request->isAJAX()) {
			$result = $this->list_pj->showlistpenjualan();
			return json_encode($result);
			// $db = \Config\Database::connect();
			// $builder = $db->table('list_penjualan')->select('ID_BARANG, HARGA_JL, JUMLAH_BELI, TOTAL_HARGA');
			// return DataTable::of($builder)->addNumbering()->toJson();
		}
	}
	public function refreshidpj()
	{
		if ($this->request->isAJAX()) {
			$result = $this->penjualanID->AutonumIDPJ();
			return json_encode($result);
		}
	}

	public function TotalHarga()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$result = $this->list_pj->TotalPJ($id);
			return json_encode($result);
		}
	}

	public function Subtotal()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$result = $this->list_pj->Subtotal($id);
			return json_encode($result);
		}
	}

	public function GetCatatan()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$result = $this->list_pj->GetCatatan($id);
			return json_encode($result);
		}
	}

	public function GetSumModal()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$result = $this->penjualanID->JumlahHargaAwal($id);
			return json_encode($result);
		}
	}

	public function GetDP()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$result = $this->list_pj->GetDP($id);
			return json_encode($result);
		}
	}

	public function GetDiskon()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$result = $this->list_pj->GetDiskon($id);
			return json_encode($result);
		}
	}

	public function InserttoinvPJ()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$existing = $this->inv_pj->where('id_inv', $id)->first();
			if ($existing) {
				echo '<script>alert("Tambah barang pada! ' . $id . ' Sukses Diupdate");</script>';
				// $data = [
				// 	'id_inv'   => $this->request->getVar('id'),
				// ];
				// $this->inv_pj->replace($data);
			} else {
				$this->inv_pj->insert([
					'id_inv' => $this->request->getVar('id'),
					'TGL_TRX' => $this->request->getVar('tanggal'),
					'BARANG' => $this->request->getVar('namabarang'),
					'GRAND_TOTAL' => $this->request->getVar('grandtotal'),
					'inv_ol' => $this->request->getVar('keterangan'),
					'modal' => $this->request->getVar('summodal'),
				]);
			}
		}
	}

	public function GetNamaCustomer()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$result = $this->list_pj->GetNamaCustomer($id);
			return json_encode($result);
		}
	}


	public function addcart()
	{
		if ($this->request->isAJAX()) {
			$this->list_pj->insert([
				'ID_PENJUALAN' => $this->request->getVar('idpenjualan'),
				'INV_PENJUALAN' => $this->request->getVar('invoice'),
				'ID_BARANG' => $this->request->getVar('idbarang'),
				'ID_PELANGGAN' => $this->request->getVar('typecustomer'),
				'TANGGAL_TRANSAKSI' => $this->request->getVar('tanggal'),
				'NAMACUST' => $this->request->getVar('namacustomer'),
				'ALAMAT' => $this->request->getVar('alamat'),
				'REFMP' => $this->request->getVar('refinv_mp'),
				'CATATAN' => $this->request->getVar('catatan'),
				'JUMLAH_BELI' => $this->request->getVar('qty'),
				'HARGA_AWAL' => $this->request->getVar('modalbarang'),
				'HARGA_JL' => $this->request->getVar('harga'),
				'DP' => $this->request->getVar('input-dp'),
				'DISKON' => $this->request->getVar('input-diskon'),
				'SUBTOTAL' => $this->request->getVar('harga') * $this->request->getVar('qty'),
				'TOTAL_HARGA' => $this->request->getVar('harga') * $this->request->getVar('qty') - $this->request->getVar('input-diskon'),
				'TOTAL_NETT' => $this->request->getVar('harga') * $this->request->getVar('qty') - $this->request->getVar('input-dp') - $this->request->getVar('input-diskon'),
				'LABA' => $this->request->getVar('harga') * $this->request->getVar('qty') - $this->request->getVar('input-diskon') - $this->request->getVar('modalbarang') * $this->request->getVar('qty')

			]);
			// return redirect()->to('index');
		}
	}

	public function ClearListPenjualan()
	{
		if ($this->request->isAJAX()) {
			$result = $this->list_pj->ClearListPenjualan();
			return json_encode($result);
		}
	}

	public function deletecart()
	{
		$id = $this->request->getVar('id');
		$result = $this->list_pj->deletelist($id);
		return json_encode($result);
	}

	public function delete_barang()
	{
		$id = $this->request->getVar('id');
		$result = [
			'delete' => $this->penjualanID->deletelist($id),
			'delete_garansi' => $this->garansi->delete_garansi($id)
		];
		return json_encode($result);
	}
	//  END CONTROLLER PENJUALAN======================================
	// CONTROLLER GARANSI===================================

	public function viewdata_garansi()
	{
		$viewdata = $this->inv_pj->table('inv_penjualan')->select('id_inv, TGL_TRX, inv_ol');
		// $viewdata = $this->garansi->table('garansi')->select('id_inv, TGL_TRX, garansi.TGL_HABIS, garansi.STATUS')->join('inv_penjualan', 'garansi.INV_PENJUALAN = inv_penjualan.id_inv');
		return DataTable::of($viewdata)->add('edit', function ($row) {
			return '<a href="/transaksi/garansi_detail?invoice=' . $row->id_inv . '" class="view-garansi"><button class="btn btn-warning btn-sm ti-pencil-alt " type="button" onclick="show_garansi()"></button></a>';
		})->toJson(true);
	}

	public function garansi_detail()
	{
		if ($this->request->isAJAX()) {
			$invoice = $this->request->getVar('invoice');
			$result = $this->garansi->show_garansi($invoice);
			return json_encode($result);
		}
		// var_dump($invoice);
	}

	public function update_garansi()
	{
		$tgl_habis = $this->request->getVar('tgl_habis');
		$inv_penjualan = $this->request->getVar('inv_penjualan');
		$id_penjualan = $this->request->getVar('id_penjualan');
		// var_dump(count($tgl_habis));
		$data = [];
		for ($i = 0; $i < count($tgl_habis); $i++) {
			$data[] = [
				'ID_PENJUALAN' => $id_penjualan[$i],
				'INV_PENJUALAN' => $inv_penjualan[$i],
				'TGL_HABIS' => $tgl_habis[$i],
				// 'STATUS' => $this->request->getVar('status')[$i],
			];
		}
		if (!empty($data)) {
			$this->garansi->updateBatch($data, 'ID_PENJUALAN');
		}

		return json_encode(['status' => 'success']);
	}

	// END CONTROLLER GARANSI======================================
	public function serviceReturn()
	{
		$data = [
			'tittle' => 'Service & Return - VSKomputer'
		];
		return view('/transaksi/return', $data);
	}

	public function garansi()
	{
		$data = [
			'tittle' => 'Garansi - VSKomputer'
		];
		return view('/transaksi/garansi', $data);
	}
}
