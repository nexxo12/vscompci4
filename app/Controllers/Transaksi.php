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
use App\Models\Service;
use App\Models\SuratJalan;
use CodeIgniter\Exceptions\AlertError;
use \Hermawan\DataTables\DataTable;
use PhpParser\Node\Stmt\Echo_;

class Transaksi extends BaseController
{

	protected Pembelian $pembelian;
	protected Masterbarang $masterbarang;
	protected Supplier $supplier;
	protected InvPenjualan $inv_pj;
	protected Customer $customer;
	protected Listpenjualan $list_pj;
	protected PenjualanModel $penjualanID;
	protected Garansi $garansi;
	protected Service $service;
	protected SuratJalan $suratjalan;
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
		$this->service = new Service();
		$this->suratjalan = new SuratJalan();
	}

	// CONTROLLER PAGE PEMBELIAN===================================
	public function pembelian()
	{
		$data = [
			'tittle' => 'Pembelian - VSKomputer',
			'supplier' => $this->supplier->ShowSupplier(),
			'showpembelian' => $this->pembelian->showpembelian()
		];
		return view('/transaksi/pembelian', $data);
	}
	public function deletePembelian()
	{
		if ($this->request->isAJAX()) {
			$idpembelian = $this->request->getVar('id');
			$this->pembelian->delete($idpembelian);
			$result = ['status' => 'success', 'message' => 'Data Pembelian Berhasil Dihapus'];
			return json_encode($result);
		}
	}

	public function refreshid_Pembelian()
	{
		if ($this->request->isAJAX()) {
			$result = $this->pembelian->AutoNumID();
			return json_encode($result);
		}
	}

	public function getBarangPembelian()
	{
		if ($this->request->isAJAX()) {
			$result = $this->masterbarang->ShowBarang();
			return json_encode($result);
		}
	}

	public function showpembelianMonth()
	{
		$viewdata = $this->pembelian->table('pembelian_barang')->select('ID_BELI, NAMA_BARANG, supplier.NAMA, NamaSUPP, JUMLAH, pembelian_barang.SATUAN, HARGA_BELI, TGL_GARANSI, TGL_BELI, BUY_PAYMENT')
			->join('master_barang', 'master_barang.ID_BARANG = pembelian_barang.ID_BARANG')
			->join('supplier', 'supplier.ID_SUPP = pembelian_barang.ID_SUPP')->where('month(TGL_BELI)', date('m'))->where('year(TGL_BELI)', date('Y'))
			->orderBy('TGL_BELI', 'DESC');
		return DataTable::of($viewdata)->add('delete', function ($row) {
			return '<a href="/Transaksi/deletePembelian?id=' . $row->ID_BELI . '" class="delete-buy"><button class="btn btn-danger btn-sm mdi mdi-delete" type="button" onclick="deletePembelian()"></button></a>';
		})->toJson(true);
	}

	public function showpembelianAll()
	{
		$viewdata = $this->pembelian->table('pembelian_barang')->select('ID_BELI, NAMA_BARANG, supplier.NAMA, NamaSUPP, JUMLAH, pembelian_barang.SATUAN, HARGA_BELI, TGL_GARANSI, TGL_BELI, BUY_PAYMENT')
			->join('master_barang', 'master_barang.ID_BARANG = pembelian_barang.ID_BARANG')
			->join('supplier', 'supplier.ID_SUPP = pembelian_barang.ID_SUPP')->orderBy('TGL_BELI', 'DESC');
		return DataTable::of($viewdata)->add('delete', function ($row) {
			return '<a href="/Transaksi/deletePembelian?id=' . $row->ID_BELI . '" class="delete-buy"><button class="btn btn-danger btn-sm mdi mdi-delete" type="button" onclick="deletePembelian()"></button></a>';
		})->toJson(true);
	}

	public function getSupplierPembelian()
	{
		if ($this->request->isAJAX()) {
			$result = $this->supplier->ShowSupplier();
			return json_encode($result);
		}
	}

	public function savePembelian()
	{
		if ($this->request->isAJAX()) {
			$this->pembelian->insert([
				'ID_BELI' => $this->request->getVar('id_pembelian'),
				'ID_SUPP' => $this->request->getVar('id_supp'),
				'ID_BARANG' => $this->request->getVar('idbarang'),
				'ID_LOGIN' => $this->request->getVar('idlogin'),
				'JUMLAH' => $this->request->getVar('jumlah'),
				'NamaSUPP' => $this->request->getVar('nama_supp'),
				'SATUAN' => $this->request->getVar('satuan'),
				'HARGA_BELI' => $this->request->getVar('hargabeli'),
				'TGL_GARANSI' => $this->request->getVar('garansi_buy'),
				'TGL_BELI' => $this->request->getVar('tanggal_input'),
				'BUY_PAYMENT' => $this->request->getVar('buy-payment')
			]);
		}
		return json_encode(['status' => 'success', 'message' => 'Data Pembelian Berhasil Ditambahkan']);
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
			$this->inv_pj->insert([
				'id_inv' => $this->request->getVar('id'),
				'TGL_TRX' => $this->request->getVar('tanggal'),
				'BARANG' => $this->request->getVar('namabarang'),
				'GRAND_TOTAL' => $this->request->getVar('grandtotal'),
				'inv_ol' => $this->request->getVar('keterangan'),
				'modal' => $this->request->getVar('summodal'),
			]);
		}
		return json_encode(['status' => 'success']);
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
				'ID_LOGIN' => $this->request->getVar('idkasir'),
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
		$viewdata = $this->inv_pj->table('inv_penjualan')->select('id_inv, TGL_TRX, inv_ol')->orderBy('TGL_TRX', 'ASC');
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

	// CONTROLLER SERVICE & RETURN===================================
	public function serviceReturn()
	{
		$data = [
			'tittle' => 'Service & Return - VSKomputer',
			'nonota' => $this->service->getNextInvoiceNota(),
		];
		return view('/transaksi/return', $data);
	}

	public function saveService()
	{
		if ($this->request->isAJAX()) {
			$this->service->insert([
				'NOSURAT' => $this->request->getVar('no_surat'),
				'TGL_INPUT' => $this->request->getVar('tanggal'),
				'INVOICE_NOTA' => $this->request->getVar('invoice'),
				'REF_MP' => $this->request->getVar('ref'),
				'TGL_BELI' => $this->request->getVar('garansi'),
				'NAMA' => $this->request->getVar('diterima_dari'),
				'NOHP' => $this->request->getVar('no_hp'),
				'BARANG' => $this->request->getVar('namabarang'),
				'RETURN_QTY' => $this->request->getVar('qty_barang_return'),
				'KELENGKAPAN' => $this->request->getVar('kelengkapan'),
				'KERUSAKAN' => $this->request->getVar('kerusakan'),
				'KETERANGAN' => 'on process'
			]);
			return json_encode(['status' => 'success']);
		}
	}

	public function noNota()
	{
		if ($this->request->isAJAX()) {
			$result = $this->service->getNextInvoiceNota();
			return json_encode($result);
		}
	}

	public function TampilBarangReturn()
	{
		$viewdata = $this->inv_pj->table('inv_penjualan')->select('id_inv, TGL_TRX, inv_ol')->orderBy('TGL_TRX', 'DESC');
		return DataTable::of($viewdata)->add('tambah', function ($row) {
			return '<a href="/Transaksi/addreturn?invoice=' . $row->id_inv . '" class="add_return"><button class="btn btn-primary btn-sm mdi mdi-plus" type="button" onclick="tambahBarangReturn()"></button></a>';
		})->add('detail', function ($row) {
			return '<a href="/Transaksi/detailtransaksi?invoice=' . $row->id_inv . '" class="detail_return"><button class="btn btn-info btn-sm mdi mdi-eye" type="button" onclick="detailTransaksi()"></button></a>';
		})->toJson(true);
	}

	public function ListBarangReturn()
	{
		$viewdata = $this->service->table('service')->select('NOSURAT, TGL_INPUT, INVOICE_NOTA, NAMA, NOHP, KETERANGAN')->orderBy('TGL_INPUT', 'ASC')->groupBy('NOSURAT');
		return DataTable::of($viewdata)->add('view', function ($row) {
			return '<a href="/Transaksi/viewreturn?nota=' . $row->NOSURAT . '" class="view_return"><button class="btn btn-primary btn-sm mdi mdi-view-list" type="button" onclick="viewReturn()"></button></a>';
		})->add('edit', function ($row) {
			return '<a href="/Transaksi/editreturn?nota=' . $row->NOSURAT . '" class="edit_return"><button class="btn btn-warning btn-sm mdi mdi-pencil" type="button" onclick="editReturn()"></button></a>';
		})->add('print', function ($row) {
			return '<a href="/transaksi/return_service/print/' . $row->NOSURAT . '" class="print_return" target="_blank"><button class="btn btn-info btn-sm mdi mdi-printer" type="button" onclick=""></button></a>';
		})->add('delete', function ($row) {
			return '<a href="/Transaksi/deletereturn?nota=' . $row->NOSURAT . '" class="delete_return"><button class="btn btn-danger btn-sm mdi mdi-delete" type="button" onclick="deletelistReturn()"></button></a>';
		})->toJson(true);
	}

	public function save_editreturn()
	{
		if ($this->request->isAJAX()) {
			$nomor = $this->request->getVar('edit_return_id');
			$data = [
				'KETERANGAN' => $this->request->getVar('edit_return_status'),
			];
			$this->service->updateStatusReturn($nomor, $data);
			return json_encode(['status' => 'success']);
		}
	}

	public function deletereturn()
	{
		if ($this->request->isAJAX()) {
			$invoice = $this->request->getVar('nota');
			$result = $this->service->where('NOSURAT', $invoice)->delete();
			return json_encode($result);
		}
	}

	public function addreturn()
	{
		if ($this->request->isAJAX()) {
			$invoice = $this->request->getVar('invoice');
			$result = $this->inv_pj->show_edit_inv($invoice);
			return json_encode($result);
		}
	}

	public function detailtransaksi()
	{
		if ($this->request->isAJAX()) {
			$invoice = $this->request->getVar('invoice');
			$result = $this->penjualanID->GetListNota($invoice);
			return json_encode($result);
		}
	}

	public function printreturn(mixed $no) //FUNCTICON DI ROUTE
	{
		// $invnota = $this->request->getVar('inv');
		$invoice_surat = $this->service->printSuratReturn($no);
		$data = [
			'tittle' => 'Print Return ' . $no,
			'viewsuratreturn' => $invoice_surat,
		];
		// var_dump($data['viewnota']);
		return view('/transaksi/printreturn', $data);
	}

	public function showService()
	{
		if ($this->request->isAJAX()) {
			$nomor = $this->request->getVar('no_surat');
			$result = $this->service->showSuratReturn($nomor);
			return json_encode($result);
		}
	}
	// END CONTROLLER SERVICE & RETURN===================================


	public function garansi()
	{
		$data = [
			'tittle' => 'Garansi - VSKomputer'
		];
		return view('/transaksi/garansi', $data);
	}

	// CONTROLLER SURAT JALAN===================================
	public function suratJalan()
	{
		$data = [
			'tittle' => 'Surat Jalan - VSKomputer'
		];
		return view('/transaksi/surat_jalan', $data);
	}

	public function NoSuratJalanService()
	{
		if ($this->request->isAJAX()) {
			$result = $this->suratjalan->RandomNumber();
			return json_encode($result);
		}
	}

	public function NoSuratJalanPengiriman()
	{
		if ($this->request->isAJAX()) {
			$result = $this->suratjalan->RandomNumber();
			return json_encode($result);
		}
	}

	public function getBarangService()
	{
		if ($this->request->isAJAX()) {
			$result = $this->masterbarang->showCariBarang();
			return json_encode($result);
		}
	}

	public function saveSuratJalanService()
	{
		if ($this->request->isAJAX()) {
			$this->suratjalan->insert([
				'SURAT_NOMOR' => $this->request->getVar('no_suratservice'),
				'SURAT_TYPE' => 'Service',
				'SURAT_TANGGAL' => $this->request->getVar('tanggal-surat-service'),
				'SURAT_KEPADA' => $this->request->getVar('kepada-suratjalan-service'),
				'SURAT_BARANG' => $this->request->getVar('sj-service-namabarang'),
				'SURAT_QTY' => $this->request->getVar('sj-service-qty'),
				'SURAT_KETERANGAN' => $this->request->getVar('kelengkapan-suratjalan-service'),
				'SURAT_SERIAL' => $this->request->getVar('serialnumber-suratjalan-service'),
				'SURAT_KERUSAKAN' => $this->request->getVar('kerusakan-suratjalan-service'),
				'SURAT_STATUS' => 'Proses'
			]);
			return json_encode(['status' => 'success']);
		}
	}

	public function Ctrl_showSuratJalanService()
	{
		if ($this->request->isAJAX()) {
			$nomor = $this->request->getVar('no_suratservice');
			$result = $this->suratjalan->showSuratJalanService($nomor);
			return json_encode($result);
		}
	}

	public function printsurat(mixed $no) //FUNCTICON DI ROUTE
	{
		// $invnota = $this->request->getVar('inv');
		$nomor_surat = $this->suratjalan->printSuratJalanService($no);
		$data = [
			'tittle' => 'Print Surat Jalan ' . $no,
			'viewsuratjalan' => $nomor_surat,
		];
		// var_dump($data['viewnota']);
		return view('/transaksi/printsj', $data);
	}

	public function view_daftar_suratjalan()
	{
		$viewdata = $this->suratjalan->table('surat_jalan')->select('ID_SURAT, SURAT_NOMOR, SURAT_TANGGAL, SURAT_KEPADA, SURAT_BARANG, SURAT_KERUSAKAN, SURAT_STATUS')->orderBy('SURAT_TANGGAL', 'DSC')->groupBy('SURAT_NOMOR');
		return DataTable::of($viewdata)->add('edit', function ($row) {
			return '<a href="/Transaksi/edit?id=' . $row->SURAT_NOMOR . '" class="edit_SJ"><button class="btn btn-warning btn-sm ti-pencil-alt" type="button" onclick="edit_sj_service()"></button></a>';
		})->add('print', function ($row) {
			return '<a href="/Transaksi/printsurat/' . $row->SURAT_NOMOR . '" class="print_SJ" target="_blank"><button class="btn btn-info btn-sm ti-printer" type="button"></button></a>';
		})->add('delete', function ($row) {
			return '<a href="/Transaksi/delete?id=' . $row->SURAT_NOMOR . '" class="delete_SJ"><button class="btn btn-danger btn-sm ti-trash" type="button" onclick="delete_sj_service()"></button></a>';
		})->toJson(true);
	}

	public function delete()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$this->suratjalan->deleteSuratJalanService($id);
			$result = ['status' => 'success'];
			return json_encode($result);
		}
	}

	public function edit()
	{
		if ($this->request->isAJAX()) {
			$nomor = $this->request->getVar('id');
			$result = $this->suratjalan->showSuratJalanService($nomor);
			return json_encode($result);
		}
	}

	public function save_edit_suratjalan_service()
	{
		if ($this->request->isAJAX()) {
			$nomor = $this->request->getVar('edit_suratjalan_id');
			$data = [
				'SURAT_STATUS' => $this->request->getVar('edit_suratjalan_status'),
			];
			$this->suratjalan->updateSuratJalanService($nomor, $data);
			return json_encode(['status' => 'success']);
		}
	}

	// END CONTROLLER SURAT JALAN===================================
}
