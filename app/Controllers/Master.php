<?php

namespace App\Controllers;

class Master extends BaseController
{
	public function barang()
	{
		$data = [
			'tittle' => 'Master Barang - VSKomputer'
		];
		return view('/master/masterBarang', $data);
	}

	public function customer()
	{
		$data = [
			'tittle' => 'Master Customer - VSKomputer'
		];
		return view('/master/masterCust', $data);
	}

	public function supplier()
	{
		$data = [
			'tittle' => 'Master Supplier - VSKomputer'
		];
		return view('/master/masterSupplier', $data);
	}
}
