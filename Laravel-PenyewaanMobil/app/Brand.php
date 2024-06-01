<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	protected $table = 'brand';
    protected $fillable = ['logo', 'brand'];

    /**
     * Method One To Many 
     */
    public function mobil()
    {
    	return $this->hasMany(Mobil::class);
    }
}
