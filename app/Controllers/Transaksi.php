<?php

namespace App\Controllers;

use App\Models\Pembelian;
use App\Models\Masterbarang;
use App\Models\Supplier;
use App\Models\InvPenjualan;
use App\Models\Customer;
use App\Models\Listpenjualan;
use App\Models\PenjualanModel;
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
	public function __construct()
	{
		$this->pembelian = new Pembelian();
		$this->masterbarang = new Masterbarang();
		$this->supplier = new Supplier();
		$this->inv_pj = new InvPenjualan();
		$this->customer = new Customer();
		$this->list_pj = new Listpenjualan();
		$this->penjualanID = new PenjualanModel();
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
		$nota_inv = $this->penjualanID->where('INV_PENJUALAN', $inv)->findAll();
		$data = [
			'tittle' => 'Print Nota ' . $inv,
			'viewnota' => $nota_inv,

		];
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
			$this->inv_pj->insert([
				'id_inv' => $this->request->getVar('id'),

			]);
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
	//  END CONTROLLER PENJUALAN======================================
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
