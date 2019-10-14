<?php

use App\Broadcasting\OnlineChannel;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('online', function ($user) {    
    
    if($user->halaman == "applet"){
        $cari = DB::table('applet')->where('status', 1)->where('operator', $user->username)->get();
        if (count($cari) > 0) {
            $user->job = DB::table('applet')->join('kartu_sam', 'applet.id_kartu_sam', 'kartu_sam.id_kartu_sam')->where('status', 1)->where('operator', $user->username)->first();
        } else {
            $user->job = '';
        }
    }elseif ($user->halaman =="preperso") {
        $cari = DB::table('preperso')->where('status', 1)->where('operator', $user->username)->get();

        if (count($cari) > 0) {
            $user->job = DB::table('preperso')->where('status', 1)->where('operator', $user->username)->first();
        } else {
            $user->job = '';
        }
    }elseif ($user->halaman == "record") {
        if($user->id_periode == ''){
            $user->job = '';
        }else{
            //$tabl = 'record'.$user->id_periode;
            $cari = DB::table('record')->where('status', 1)->where('operator', $user->username)->get();
            if (count($cari) > 0) {
                $user->job = DB::table('record')->where('status', 1)->where('operator', $user->username)->first();
            } else {
                $user->job = '';
            }
        }        
    }else{
        $user->job = '';
    }        
    
    return $user;    
});

// Broadcast::channel('online.{side}', OnlineChannel::class);
