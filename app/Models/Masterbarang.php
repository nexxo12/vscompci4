<?php

namespace App\Models;

use CodeIgniter\Model;

class Masterbarang extends Model
{
    protected $table      = 'master_barang';
    protected $allowedFields = ['ID_BARANG', 'ID_KATEGORI', 'NAMA_BARANG', 'STOK', 'SATUAN', 'HARGA_BELI_MASTER', 'HARGA_JUAL', 'G_TOTAL'];


    public function ShowBarang()
    {
        return $this->select('*')->orderBy('NAMA_BARANG', 'ASC')->findAll();
    }

    // public function showCariBarang()
    // {
    //     return $this->select('ID_BARANG, NAMA_BARANG, STOK, HARGA_BELI')->findAll();
    // }

    public function showCariBarang()
    {
        return $this->select('*')->findAll();
    }

    public function showbarangbyid($idbarang)
    {
        return $this->select('*')->join('pembelian_barang', 'pembelian_barang.ID_BARANG = master_barang.ID_BARANG')->where('master_barang.ID_BARANG', $idbarang)->orderBy('pembelian_barang.TGL_BELI', 'ASC')->findAll();
    }

    // public function showbarangbyid($idbarang)
    // {
    //     return $this->select('master_barang.ID_BARANG, master_barang.STOK, MAX(pembelian_barang.HARGA_BELI) as HARGA_BELI')
    //         ->join('pembelian_barang', 'pembelian_barang.ID_BARANG = master_barang.ID_BARANG')
    //         ->where('master_barang.ID_BARANG', $idbarang)
    //         ->groupBy('master_barang.ID_BARANG')
    //         ->findAll();
    // }
}
