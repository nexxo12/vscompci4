<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuKas extends Model
{
    protected $table      = 'buku_kas';
    protected $primaryKey = 'ID_KAS';
    protected $allowedFields = ['ID_LOGIN', 'TANGGAL_KAS', 'RINCIAN_KAS', 'KATEGORI_KAS', 'PEMASUKAN_KAS', 'PENGELUARAN_KAS'];
}
