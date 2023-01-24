<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembelian extends Model
{
    protected $table      = 'pembelian_barang';
    protected $primaryKey = 'ID_BELI';
    protected $allowedFields = ['ID_BELI', 'ID_SUPP', 'ID_BARANG', 'JUMLAH', 'NamaSUPP', 'SATUAN', 'HARGA_BELI', 'TGL_GARANSI', 'TGL_BELI'];


    public function AutoNumID()
    {
        $id = $this->selectCount('ID_BELI')->findAll();
        foreach ($id as $key) {
            $id_n = $key['ID_BELI'] + 1;
        }
        return $id_n;
    }

    public function showpembelian()
    {
        return $this->table('pembelian_barang')->select('*')
            ->join('master_barang', 'master_barang.ID_BARANG = pembelian_barang.ID_BARANG')
            ->join('supplier', 'supplier.ID_SUPP = pembelian_barang.ID_SUPP')->orderBy('ID_BELI', 'DESC')->findAll();
    }

    public function deletebuy($id)
    {
        return $this->where('ID_BELI', $id)->delete();
    }
}
