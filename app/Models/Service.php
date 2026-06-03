<?php

namespace App\Models;

use CodeIgniter\Model;

class Service extends Model
{
    protected $table      = 'service';
    protected $primaryKey = 'IDSERVICE';
    protected $allowedFields = ['NOSURAT', 'TGL_INPUT', 'INVOICE_NOTA', 'REF_MP', 'TGL_BELI', 'NAMA', 'NOHP', 'BARANG', 'KELENGKAPAN', 'KERUSAKAN', 'KETERANGAN'];


    public function getNextInvoiceNota()
    {
        $lastRecord = $this->selectMax('IDSERVICE')->first();
        $lastInvoice = (int)($lastRecord['IDSERVICE'] ?? 0);
        $nextInvoice = $lastInvoice + 1;
        return str_pad($nextInvoice, 4, '0', STR_PAD_LEFT);
    }

    public function getFirstId()
    {
        return $this->selectMin('IDSERVICE')->first();
    }
}
