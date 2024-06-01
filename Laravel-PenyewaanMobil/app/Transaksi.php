<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['id_transaksi', 'customer_id', 'mobil_id', 'tanggal_rental', 'tanggal_kembali', 'status', 'keterangan', 'pegawai_id'];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
    public function mobil()
    {
    	return $this->belongsTo(Mobil::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
