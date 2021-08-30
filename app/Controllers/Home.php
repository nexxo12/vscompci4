<?php

namespace App\Controllers;

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
