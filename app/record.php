<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class record extends Model
{
	protected $primaryKey = 'id_record';
    protected $table='record';
    
    const CREATED_AT = 'jam_mulai';
    const UPDATED_AT = 'jam_selesai';
}
