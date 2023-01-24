<?php

namespace App\Controllers;

use App\Models\Pembelian;
use App\Models\Masterbarang;
use App\Models\Supplier;

class Transaksi extends BaseController
{

	protected $pembelian;
	protected $masterbarang;
	protected $supplier;
	public function __construct()
	{
		$this->pembelian = new Pembelian();
		$this->masterbarang = new Masterbarang();
		$this->supplier = new Supplier();
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


	public function penjualan()
	{
		$data = [
			'tittle' => 'Penjualan - VSKomputer'
		];
		return view('/transaksi/penjualan', $data);
	}

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
