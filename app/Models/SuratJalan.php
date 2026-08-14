<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratJalan extends Model
{
    protected $table      = 'surat_jalan';
    protected $primaryKey = 'ID_SURAT';
    protected $allowedFields = ['SURAT_NOMOR', 'SURAT_TYPE', 'SURAT_TANGGAL', 'SURAT_KEPADA', 'SURAT_ALAMAT', 'SURAT_BARANG', 'SURAT_QTY', 'SURAT_KETERANGAN', 'SURAT_SERIAL', 'SURAT_KERUSAKAN', 'SURAT_COLY', 'SURAT_STATUS'];


    public function RandomNumber()
    {
        do {
            $number = mt_rand(100, 999999);
            $exists = $this->where('SURAT_NOMOR', $number)->first();
        } while ($exists !== null);

        return $number;
    }

    public function RandomNumber2()
    {
        do {
            $number = mt_rand(100, 999999);
            $exists = $this->where('SURAT_NOMOR', $number)->first();
        } while ($exists !== null);

        return $number;
    }

    public function showSuratJalanService(mixed $nomor)
    {
        return $this->select('*')->where('SURAT_NOMOR', $nomor)->findAll();
    }

    public function printSuratJalanService(mixed $nomor)
    {
        return $this->select('*')->where('SURAT_NOMOR', $nomor)->findAll();
    }

    public function deleteSuratJalanService(mixed $nomor)
    {
        return $this->where('SURAT_NOMOR', $nomor)->delete();
    }

    public function updateSuratJalanService(mixed $nomor, array $data)
    {
        return $this->where('SURAT_NOMOR', $nomor)->set($data)->update();
    }
}
