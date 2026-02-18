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

class Home extends BaseController
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
	public function index()
	{
		$data = [
			'tittle' => 'Dashboard - VSKomputer',
			'totalpenjualan' => $this->penjualanID->JumlahPenjualanbyDate(),
			'totallaba' => $this->penjualanID->JumlahLababyDate(),
			'totalhargaawal' => $this->penjualanID->JumlahHargaAwalbyDate(),
			'totalpotongan' => $this->inv_pj->JumlahPotonganbyDate(),
			'totalbiayamin' => $this->inv_pj->JumlahBiayaMinbyDate(),
			'totalbiayaplus' => $this->inv_pj->JumlahBiayaPlusbyDate(),
			'totalpembelian' => $this->pembelian->JumlahPembelianbyDate(),
			'totalbarang' => $this->masterbarang->countAllResults(),
			'totalcustomer' => $this->customer->countAllResults(),
			'totalsupplier' => $this->supplier->countAllResults(),
			'totalinvoice' => $this->inv_pj->countAllResults(),

		];
		return view('index', $data);
	}
}
