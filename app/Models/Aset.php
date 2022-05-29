<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Aset extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mobil', 'tipe_mobil', 'jenis_transmisi',
        'volume_bahan_bakar', 'warna_mobil', 'kapasitas_mobil',
        'fasilitas_mobil', 'plat_nomor', 'no_stnk', 'kategori_aset',
        'tgl_service_akhir', 'status_ketersediaan', 'biaya_sewa',
        'id_mitra'
    ];

    public function getCreatedAtAttribute()
    {
        if(!is_null($this->attributes['created_at'])) {
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttribute()
    {
        if(!is_null($this->attributes['updated_at'])) {
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}
