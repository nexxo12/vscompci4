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
	public function index()
	{
		$data = [
			'tittle' => 'Dashboard - VSKomputer'
		];
		return view('index', $data);
	}
}
