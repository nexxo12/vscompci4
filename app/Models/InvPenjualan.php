<?php

namespace App\Models;

use CodeIgniter\Model;

class InvPenjualan extends Model
{
    protected $table      = 'inv_penjualan';
    protected $primaryKey = 'id_inv';
    protected $allowedFields = ['id_inv', 'TGL_TRX', 'BARANG', 'GRAND_TOTAL', 'inv_ol', 'ongkir', 'laba_ongkir', 'potongan', 'cashback'];


    public function invoicepj()
    {
        $id = $this->selectCount('id_inv')->findAll();
        foreach ($id as $key) {
            $id_n = $key['id_inv'] + 1;
        }
        return $id_n;
    }
}
