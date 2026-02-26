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
use App\Models\Kategori;
use \Hermawan\DataTables\DataTable;


class Master extends BaseController
{
	protected $pembelian;
	protected $masterbarang;
	protected $supplier;
	protected $inv_pj;
	protected $customer;
	protected $list_pj;
	protected $penjualanID;
	protected $garansi;
	protected $kategori;
	public function __construct()
	{
		$this->pembelian = new Pembelian();
		$this->masterbarang = new Masterbarang();
		$this->supplier = new Supplier();
		$this->inv_pj = new InvPenjualan();
		$this->kategori = new Kategori();
		$this->customer = new Customer();
		$this->list_pj = new Listpenjualan();
		$this->penjualanID = new PenjualanModel();
		$this->garansi = new Garansi();
	}
	public function barang()
	{
		$data = [
			'tittle' => 'Master Barang - VSKomputer',
			'kategori' => $this->kategori->showkategori(),
		];
		return view('/master/masterBarang', $data);
	}

	public function save_masterbarang()
	{
		if ($this->request->isAJAX()) {
			$this->masterbarang->insert([
				'ID_BARANG' => $this->request->getVar('idbarang'),
				'ID_KATEGORI' => $this->request->getVar('kategori'),
				'NAMA_BARANG' => $this->request->getVar('namabarang'),
				'STOK' => 0,
			]);
			$result = ['status' => 'success'];
			return json_encode($result);
		}
	}

	public function refreshid_masterbarang()
	{
		if ($this->request->isAJAX()) {
			$result = $this->masterbarang->MasterBarangID();
			return json_encode($result);
		}
	}

	public function view_masterbarang()
	{
		$viewdata = $this->masterbarang->table('master_barang')->select('master_barang.ID_BARANG, kategori.KATEGORI, NAMA_BARANG, STOK, master_barang.SATUAN, master_barang.G_TOTAL,master_barang.HARGA_JUAL')->join('kategori', 'kategori.ID_KATEGORI = master_barang.ID_KATEGORI')->orderBy('master_barang.ID_BARANG', 'DESC');
		return DataTable::of($viewdata)->add('aksi', function ($row) {
			return '<a href="/master/edit_barang?id=' . $row->ID_BARANG . '" class="edit-barang"><button class="btn btn-warning btn-sm ti-pencil-alt " type="button" onclick="edit_barang()"></button></a>';
		})->add('delete', function ($row) {
			return '<a href="/master/delete?id=' . $row->ID_BARANG . '" class="delete-barang"><button class="btn btn-danger btn-sm ti-trash " type="button" onclick="delete_barang()"></button></a>';
		})->toJson(true);
	}

	public function edit_barang()
	{
		$idbarang = $this->request->getVar('id');
		$result = $this->masterbarang->showbarangbyid($idbarang);
		return json_encode($result);
	}

	public function save_edit_barang()
	{
		if ($this->request->isAJAX()) {
			$idbarang = $this->request->getVar('kode-barang-edit');
			$data = [
				'ID_BARANG' => $this->request->getVar('kode-barang-edit'),
				'ID_KATEGORI' => $this->request->getVar('kategori-barang-edit'),
				'NAMA_BARANG' => $this->request->getVar('nama-barang-edit'),
				'STOK' => $this->request->getVar('stok-barang-edit'),
				'HARGA_BELI_MASTER' => $this->request->getVar('harga-beli-terbaru-edit'),
				'HARGA_JUAL' => $this->request->getVar('harga-jual-rekomendasi-edit'),
				'G_TOTAL' => $this->request->getVar('stok-barang-edit') * $this->request->getVar('harga-beli-terbaru-edit'),
			];
			$this->masterbarang->update($idbarang, $data);
			$result = ['status' => 'success'];
			return json_encode($result);
		}
	}

	public function delete()
	{
		if ($this->request->isAJAX()) {
			$idbarang = $this->request->getVar('id');
			$this->masterbarang->delete($idbarang);
			$result = ['status' => 'success'];
			return json_encode($result);
		}
	}

	public function save_kategori()
	{
		if ($this->request->isAJAX()) {
			$this->kategori->insert([
				'KATEGORI' => $this->request->getVar('input-kategori'),
			]);
			$result = ['status' => 'success'];
			return json_encode($result);
		}
	}



	// ====================================================================

	public function customer()
	{
		$data = [
			'tittle' => 'Master Customer - VSKomputer'
		];
		return view('/master/masterCust', $data);
	}


	// ====================================================================

	public function supplier()
	{
		$data = [
			'tittle' => 'Master Supplier - VSKomputer'
		];
		return view('/master/masterSupplier', $data);
	}
}
