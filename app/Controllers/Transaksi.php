<?php

namespace App\Controllers;

class Transaksi extends BaseController
{
	public function pembelian()
	{
		$data = [
			'tittle' => 'Pembelian - VSKomputer'
		];
		return view('/transaksi/pembelian', $data);
	}

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
