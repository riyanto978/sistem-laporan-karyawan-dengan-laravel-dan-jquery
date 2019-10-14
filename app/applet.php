<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class applet extends Model
{
	protected $primaryKey = 'id_applet';
    protected $table='applet';
    
    const CREATED_AT = 'jam_mulai';
    const UPDATED_AT = 'jam_selesai';
}
