<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table      = 'penjualan';
    protected $primaryKey = 'ID_PENJUALAN';
    protected $allowedFields = [
        'ID_PENJUALAN',
        'INV_PENJUALAN',
        'ID_BARANG',
        'ID_PELANGGAN',
        'ID_LOGIN',
        'TANGGAL_TRANSAKSI',
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

    public function AutonumIDPJ()
    {
        return $this->selectMAX('ID_PENJUALAN')->findAll();
        // $id = $this->selectMAX('ID_PENJUALAN')->findAll();
        // foreach ($id as $key) {
        //     $id_n = $key['ID_PENJUALAN'] + 1;
        // }
        // return $id_n;
    }

    public function GetListNota($invoice)
    {
        return $this->table('penjualan')->select('*')
            ->join('master_barang', 'master_barang.ID_BARANG = penjualan.ID_BARANG')
            ->join('pelanggan', 'pelanggan.ID_PELANGGAN = penjualan.ID_PELANGGAN')
            // ->join('login', 'login.ID_LOGIN = penjualan.ID_LOGIN')
            ->where('INV_PENJUALAN', $invoice)->findAll();
    }

    public function JumlahQTY($invoice)
    {
        return $this->table('penjualan')->selectSum('JUMLAH_BELI')
            ->where('INV_PENJUALAN', $invoice)->findAll();
    }

    public function JumlahSubtotal($invoice)
    {
        return $this->table('penjualan')->selectSum('SUBTOTAL')
            ->where('INV_PENJUALAN', $invoice)->findAll();
    }

    public function JumlahTotalHarga($invoice)
    {
        return $this->table('penjualan')->selectSum('TOTAL_HARGA')
            ->where('INV_PENJUALAN', $invoice)->findAll();
    }

    public function JumlahDP($invoice)
    {
        return $this->table('penjualan')->selectSum('DP')
            ->where('INV_PENJUALAN', $invoice)->findAll();
    }

    public function JumlahDiskon($invoice)
    {
        return $this->table('penjualan')->selectSum('DISKON')
            ->where('INV_PENJUALAN', $invoice)->findAll();
    }
    public function JumlahNett($invoice)
    {
        return $this->table('penjualan')->selectSum('TOTAL_NETT')
            ->where('INV_PENJUALAN', $invoice)->findAll();
    }
}
