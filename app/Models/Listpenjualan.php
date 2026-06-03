<?php

namespace App\Models;

use CodeIgniter\Model;

class Listpenjualan extends Model
{
    protected $table      = 'list_penjualan';
    protected $primaryKey = 'ID_PENJUALAN';
    protected $allowedFields = [
        'ID_PENJUALAN',
        'INV_PENJUALAN',
        'ID_BARANG',
        'ID_PELANGGAN',
        'TANGGAL_TRANSAKSI',
        'NAMACUST',
        'ALAMAT',
        'REFMP',
        'CATATAN',
        'JUMLAH_BELI',
        'HARGA_AWAL',
        'HARGA_JL',
        'DP',
        'DISKON',
        'SUBTOTAL',
        'TOTAL_HARGA',
        'TOTAL_NETT',
        'LABA',
    ];

    public function showlistpenjualan()
    {
        return $this->table('list_penjualan')->select('*')
            ->join('master_barang', 'master_barang.ID_BARANG = list_penjualan.ID_BARANG')->findAll();
    }

    public function deletelist(mixed $id)
    {
        return $this->where('ID_PENJUALAN', $id)->delete();
    }

    public function TotalPJ(mixed $id)
    {
        return $this->selectSum('TOTAL_NETT')->where('INV_PENJUALAN', $id)->findAll();
    }

    // // public function TotalPJ($id)
    // // {
    // //     $this->selectSum('TOTAL_HARGA', 'total_col_harga')->where('INV_PENJUALAN', $id)->findAll();
    // //     $this->selectMAX('DP', 'total_col_dp')->where('INV_PENJUALAN', $id)->findAll();
    // //     $this->selectMAX('DISKON', 'total_col_diskon')->where('INV_PENJUALAN', $id)->findAll();
    // //     $query = $this->get();
    // //     return $query->getRow();
    // }

    public function Subtotal(mixed $id)
    {
        return $this->selectSum('SUBTOTAL')->where('INV_PENJUALAN', $id)->findAll();
    }

    public function GetCatatan(mixed $id)
    {
        return $this->selectMAX('CATATAN')->where('INV_PENJUALAN', $id)->findAll();
    }

    public function GetDP(mixed $id)
    {
        return $this->selectMAX('DP')->where('INV_PENJUALAN', $id)->findAll();
    }

    public function GetDiskon(mixed $id)
    {
        return $this->selectMAX('DISKON')->where('INV_PENJUALAN', $id)->findAll();
    }

    public function GetNamaCustomer(mixed $id)
    {
        return $this->select('*')->join('pelanggan', 'pelanggan.ID_PELANGGAN = list_penjualan.ID_PELANGGAN')->where('INV_PENJUALAN', $id)->findAll();
    }

    public function ClearListPenjualan()
    {
        return $this->truncate();
    }
}
