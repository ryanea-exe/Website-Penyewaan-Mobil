<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = 'mobil';
    protected $fillable = ['foto', 'type', 'brand_id', 'warna', 'nomor_polisi', 'tahun_keluaran', 'status', 'harga_sewa'];

    public function brand()
    {
    	return $this->belongsTo(Brand::class);
    }
    /**
     * Method One To Many 
     */
    public function transaksi()
    {
    	return $this->hasMany(Transaksi::class);
    }
}
