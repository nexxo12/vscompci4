<?php

namespace App\Controllers;

class Finance extends BaseController
{
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

	public function laporanpj()
	{
		$data = [
			'tittle' => 'Laporan Penjualan - VSKomputer'
		];
		return view('/finance/laporan_pj', $data);
	}

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
