<?php

namespace App\Models;

use CodeIgniter\Model;

class Service extends Model
{
    protected $table      = 'service';
    protected $primaryKey = 'IDSERVICE';
    protected $allowedFields = ['NOSURAT', 'TGL_INPUT', 'INVOICE_NOTA', 'REF_MP', 'TGL_BELI', 'NAMA', 'NOHP', 'BARANG', 'RETURN_QTY', 'KELENGKAPAN', 'KERUSAKAN', 'KETERANGAN'];


    // public function getNextInvoiceNota()
    // {
    //     $lastRecord = $this->selectMax('IDSERVICE')->first();
    //     $lastInvoice = (int)($lastRecord['IDSERVICE'] ?? 0);
    //     $nextInvoice = $lastInvoice + 1;
    //     return str_pad($nextInvoice, 4, '0', STR_PAD_LEFT);
    // }

    public function getNextInvoiceNota()
    {
        do {
            $number = mt_rand(100, 9999);
            $exists = $this->where('NOSURAT', $number)->first();
        } while ($exists !== null);

        return $number;
    }

    public function getFirstId()
    {
        return $this->selectMin('IDSERVICE')->first();
    }

    public function printSuratReturn(mixed $nomor)
    {
        return $this->select('*')->where('NOSURAT', $nomor)->findAll();
    }

    public function showSuratReturn(mixed $nomor)
    {
        return $this->select('*')->where('NOSURAT', $nomor)->findAll();
    }

    public function updateStatusReturn(mixed $nomor, array $data)
    {
        return $this->where('NOSURAT', $nomor)->set($data)->update();
    }
}
