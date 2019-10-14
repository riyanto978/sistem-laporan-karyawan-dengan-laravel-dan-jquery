<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class preperso extends Model
{
	protected $primaryKey = 'id_preperso';
    protected $table='preperso';
    
    const CREATED_AT = 'jam_mulai';
    const UPDATED_AT = 'jam_selesai';
}
