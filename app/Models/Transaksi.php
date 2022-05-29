<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_ktp', 'no_sim', 'tgl_transaksi', 
        'tgl_mulai_sewa', 'tgl_selesai_sewa', 'metode_pembayaran', 
        'total_biaya_sewa', 'ekstensi_biaya', 'status_transaksi',
        'status_verifikasi', 'rating_driver', 'jenis_transaksi',
        'id_customer', 'id_driver', 'id_pegawai', 'id_aset',
        'id_promo'
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
