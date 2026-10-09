<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuKas extends Model
{
    protected $table      = 'buku_kas';
    protected $primaryKey = 'ID_KAS';
    protected $allowedFields = ['ID_LOGIN', 'TANGGAL_KAS', 'RINCIAN_KAS', 'KATEGORI_KAS', 'PEMASUKAN_KAS', 'PENGELUARAN_KAS'];


    public function bebanOperasonal()
    {
        return $this->table('buku_kas')->selectSum('PENGELUARAN_KAS')
            ->where('KATEGORI_KAS', 'Beban Operasional')->where('month(TANGGAL_KAS)', date('m'))->where('year(TANGGAL_KAS)', date('Y'))->findAll();
    }

    public function bebanGaji()
    {
        return $this->table('buku_kas')->selectSum('PENGELUARAN_KAS')
            ->where('KATEGORI_KAS', 'Beban Gaji')->where('month(TANGGAL_KAS)', date('m'))->where('year(TANGGAL_KAS)', date('Y'))->findAll();
    }

    public function bebanPerlengkapan()
    {
        return $this->table('buku_kas')->selectSum('PENGELUARAN_KAS')
            ->where('KATEGORI_KAS', 'Beban Perlengkapan')->where('month(TANGGAL_KAS)', date('m'))->where('year(TANGGAL_KAS)', date('Y'))->findAll();
    }

    public function bebanUtilitas()
    {
        return $this->table('buku_kas')->selectSum('PENGELUARAN_KAS')
            ->where('KATEGORI_KAS', 'Beban Utilitas')->where('month(TANGGAL_KAS)', date('m'))->where('year(TANGGAL_KAS)', date('Y'))->findAll();
    }

    public function showBebanOperasional()
    {
        return $this->table('buku_kas')->select('*')
            ->where('KATEGORI_KAS', 'Beban Operasional')->where('month(TANGGAL_KAS)', date('m'))->where('year(TANGGAL_KAS)', date('Y'))->findAll();
    }

    public function showBebanUtilitas()
    {
        return $this->table('buku_kas')->select('*')
            ->where('KATEGORI_KAS', 'Beban Utilitas')->where('month(TANGGAL_KAS)', date('m'))->where('year(TANGGAL_KAS)', date('Y'))->findAll();
    }
    public function showBebanGaji()
    {
        return $this->table('buku_kas')->select('*')
            ->where('KATEGORI_KAS', 'Beban Gaji')->where('month(TANGGAL_KAS)', date('m'))->where('year(TANGGAL_KAS)', date('Y'))->findAll();
    }
    public function showBebanPerlengkapan()
    {
        return $this->table('buku_kas')->select('*')
            ->where('KATEGORI_KAS', 'Beban Perlengkapan')->where('month(TANGGAL_KAS)', date('m'))->where('year(TANGGAL_KAS)', date('Y'))->findAll();
    }
}
