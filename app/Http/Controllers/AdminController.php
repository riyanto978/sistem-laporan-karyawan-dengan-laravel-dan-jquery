<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\periode;
use App\applet;
use App\record;
use App\preperso;
use App\uid;
use App\pol;
use App\user;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function monitoring()
    {
        $user = User::find(Auth::user()->id);
        $user->halaman = "monitoring";
        $user->update();
        return view('admin.monitoring',compact('user'));
    }
    
    public function resume_laporan($tanggal,$tanggal_akhir,$shift)
    {
        $awal = $tanggal.' 07:00:00';
        $akhir = hari_tambah($tanggal_akhir) . " 07:00:00";        
        $query = "select sum(dead) as dead,'applet' as proses,sum(applet.isi) as jumlah,pol.kode,pol.nama from applet INNER JOIN pol on applet.id_pol = pol.id_pol where shift ='$shift' and jam_mulai between '$awal' and '$akhir' and applet.status <> '1' group by pol.id_pol,applet.id_pol ";
        $query .=" UNION select sum(dead) as dead,'preperso' as proses,sum(preperso.isi) as jumlah,pol.kode,pol.nama from preperso INNER JOIN pol on preperso.id_pol = pol.id_pol where shift =' $shift' and jam_mulai between '$awal' and '$akhir' and preperso.status <> '1' group by pol.id_pol,preperso.id_pol ";
        $query .= " UNION select sum(dead) as dead,'record' as proses,sum(record.isi) as jumlah,pol.kode,pol.nama from record INNER JOIN pol on record.id_pol = pol.id_pol where shift =' $shift' and jam_mulai between '$awal' and '$akhir' and record.status <> '1' group by pol.id_pol,record.id_pol ";
        $cari = DB::select($query);
        
        return view('admin.resume',compact('cari','awal','akhir'));
        
    }
    
    public function bar_applet( $tanggal, $tanggal_akhir, $shift)
    {
        $awal = $tanggal . ' 07:00:00';
        $akhir = hari_tambah($tanggal_akhir) . " 07:00:00";        
        $query = "select operator ,sum(isi) as total,sum(dead) as reject from applet where jam_mulai between '$awal' and '$akhir' and  status<>'1'  and shift='$shift' group by operator order by total asc";
        $cari = DB::select($query);
        
        $a = [];
        $b = [];
        $c = [];
        
        foreach ($cari as $data) {
            $a[] = $data->operator;
            $b[] = $data->total;
            $c[] = $data->reject;
        }
        if (count($cari) > 0) {
            return view('admin.bar_applet',compact('a','b','c'));
        }
    }
    
    public function bar_preperso($tanggal, $tanggal_akhir, $shift)
    {
        $awal = $tanggal . ' 07:00:00';
        $akhir = hari_tambah($tanggal_akhir) . " 07:00:00";
        $query = "select operator ,sum(isi) as total,sum(dead) as reject from preperso where jam_mulai between '$awal' and '$akhir' and  status<>'1'  and shift='$shift' group by operator order by total asc";
        $cari = DB::select($query);
        
        $a = [];
        $b = [];
        $c = [];
        
        foreach ($cari as $data) {
            $a[] = $data->operator;
            $b[] = $data->total;
            $c[] = $data->reject;
        }
        
        if (count($cari) > 0) {
            return view('admin.bar_preperso', compact('a', 'b', 'c'));
        }
    }
    
    public function bar_record($tanggal, $tanggal_akhir, $shift)
    {
        $awal = $tanggal . ' 07:00:00';
        $akhir = hari_tambah($tanggal_akhir) . " 07:00:00";
        $query = "select operator ,sum(isi) as total,sum(dead) as reject from record where jam_mulai between '$awal' and '$akhir' and  status<>'1'  and shift='$shift' group by operator order by total asc";
        $cari = DB::select($query);
        
        $a = [];
        $b = [];
        $c = [];
        foreach ($cari as $data) {
            $a[] = $data->operator;
            $b[] = $data->total;
            $c[] = $data->reject;
        }
        
        if(count($cari) > 0){
            return view('admin.bar_record', compact('a', 'b', 'c'));
        }                
    }
    
    public function bandinglog()
    {
        $user = User::find(Auth::user()->id);
        $user->halaman = "banding_log";
        $user->update();
        return view('admin.banding_log',compact('user'));
    }
    
    public function logbanding($tipe, $iner)
    {        
        
        if ($tipe == 1) {
            $cari = DB::select("select preperso.line as line,preperso.jam_selesai as jam1, record.jam_selesai as jam2,preperso.operator as op1,record.operator as op2,preperso.id_preperso as id1,preperso.id_preperso as iner1,record.id_record as id2,record.iner as iner2 from preperso inner join record on preperso.id_preperso=record.old where preperso.id_preperso=?", [$iner]);
        } else {
            $cari = DB::select( "select preperso.line as line,preperso.jam_selesai as jam1, record.jam_selesai as jam2,preperso.operator as op1,record.operator as op2,preperso.id_preperso as id1,preperso.id_preperso as iner1,record.id_record as id2,record.iner as iner2 from preperso inner join record on preperso.id_preperso=record.old where record.id_record=?", [$iner]);
        }        
        
        if(count($cari) > 0){
            $list = $cari[0];
            
            $k = array();        
            
            $uid_preper = DB::select("select uid from uid where id_preperso=?", [$list->id1]);
            foreach ($uid_preper as $c) {
                $k[] = $c->uid;
            }
            
            if ($uid_preper <> null) {
                $uid = array_map('trim', $k);
            } else {
                $uid[] = $k;
            }
            
            
            $terminal_id = substr($list->iner2, 0, 1);
            $terminal_number = substr($list->iner2, 2);
            $record = array();
            $uid_record = DB::connection('mysql2')->select("select uid from tbl_uid where terminal_id=? and terminal_number=? order by tanggal", [$terminal_id, $terminal_number]);
            foreach ($uid_record as $b) {
                $record[] = $b->uid;
            }
            
            $result = array_diff($uid, $record);
            $result1 = array_diff($record, $uid);                                    
            // dd($result1);
            $op1 = $list->op1;
            $op2 = $list->op2;
            $jam1 = $list->jam1;
            $jam2 = $list->jam2;
            $line = $list->line;
            
            return view('admin.hasilbanding', compact('result', 'result1', 'list', 'uid', 'record', 'op1', 'op2', 'jam1', 'jam2', 'line'));
        } else {
            return "data tidak ditemukan";
        }
        
    }
    
    public function lihat_laporan($tipe,$tanggal,$tanggal_akhir,$operator)
    {
        $awal = $tanggal . ' 07:00:00';
        $akhir = hari_tambah($tanggal_akhir) . " 07:00:00";        
        $cari = DB::table($tipe)->join('pol',$tipe.'.id_pol','pol.id_pol')->join('periode','pol.id_periode','periode.id_periode')->whereBetween('jam_mulai',[$awal,$akhir])->where('operator',$operator)->get();
        $no = 1;
        return view('admin.tbl_laporan',compact('tipe','cari','no'));
    }
    
    public function rekapitulasi()
    {
        $user = User::find(Auth::user()->id);
        $user->halaman = "rekapitulasi";
        $user->update();
        
        $periode = periode::all();
        return view('admin.rekapitulasi',compact('user','periode'));
    }
    
    public function prosesrekapitulasi($id_periode)
    {
        $query = "select * from  
        (select pol.kode,sum(applet.isi) as applet,sum(applet.dead) as applet_dead from pol left join applet on applet.id_pol = pol.id_pol where pol.id_periode='$id_periode'  group by pol.id_pol) as B join
        (select pol.kode,sum(preperso.isi) as preperso,sum(preperso.dead) as preperso_dead from pol left join preperso on preperso.id_pol = pol.id_pol where pol.id_periode='$id_periode'  group by pol.id_pol) as A  on A.kode = B.kode join 
        (select pol.kode,sum(record.isi) as record,sum(record.dead) as record_dead from pol left join record on record.id_pol = pol.id_pol where pol.id_periode='$id_periode'  group by pol.id_pol) as C on A.kode = C.kode join 
        (select pol.kode,sum(pre_applet.isi) as pre_applet,sum(pre_applet.dead) as pre_applet_dead from pol left join pre_applet on pre_applet.id_pol = pol.id_pol where pol.id_periode='$id_periode'  group by pol.id_pol) as D  on A.kode = D.kode";
        
        $cari = DB::select($query);        
        
        
        return view('admin.hasilrekapitulasi',compact('cari'));
    }
    
    public function resume_sam()
    {
        $user = User::find(Auth::user()->id);
        $user->halaman = "resume_kartu_sam";
        $user->update();
        
        $query = "SELECT sum(applet.isi) as isi,kartu_sam.nama,pol.kode as kode,pol.nama as namapol,periode.nama_periode from applet INNER join kartu_sam on applet.id_kartu_sam = kartu_sam.id_kartu_sam INNER JOIN pol on applet.id_pol = pol.id_pol INNER join periode on periode.id_periode = pol.id_periode group by pol.id_pol";
        $cari = DB::select($query);   
        return view('admin.resume_sam',compact('user','cari'));
    }
    
    public function simpanlog(Request $request){
        
        $cari = record::find($request->id_record);
        $terminal_id = substr( $cari->iner, 0, 1);
        $terminal_number = substr( $cari->iner, 2);
        
        $periode = periode::find($cari->id_periode);

        $myfile = fopen(public_path('log/'.$periode->nama_periode.'/log_banding/') .$cari->iner.'.txt', "w");
        
        $uid_record = DB::connection('mysql2')->select("select uid,tanggal from tbl_uid where terminal_id=? and terminal_number=? order by tanggal", [$terminal_id, $terminal_number]);        
        //dd($uid_record);
        foreach ($uid_record as $b) {
            //fwrite($myfile, $b->uid. ' \n');
            fwrite($myfile, "$b->uid | $b->tanggal\n");
        }
        fclose($myfile);
        
        return "sukses";        
    }        
    
    public function track_job()
    {
        $user = User::find(Auth::user()->id);
        $user->halaman = "track_job";
        $user->update();
        
        return view('admin.track_job',compact('user'));
    }
    
    public function proses_track_job($iner,$tipe)
    {
        
        if($tipe == 2){
            // $applet = applet::find($iner);
            $preperso = preperso::where('old', $iner)->first();
            
            $query = "select applet.operator,pol.nama,pol.kode,pol.tahun,'applet' as proses,jam_mulai,jam_selesai,line,shift,id_applet as iner,shift,dead,applet.isi,lot from applet inner join pol on applet.id_pol = pol.id_pol where id_applet = '$iner'
            union
            select preperso.operator,pol.nama,pol.kode,pol.tahun,'preperso' as proses,jam_mulai,jam_selesai,line,shift,id_preperso as iner,shift,dead,preperso.isi,'' as lot from preperso inner join pol on preperso.id_pol = pol.id_pol where old = '$iner'
            union
            select record.operator,pol.nama,pol.kode,pol.tahun,'record' as proses,jam_mulai,jam_selesai,line,shift,iner,shift,dead,record.isi,'' as lot from record inner join pol on record.id_pol = pol.id_pol where old = '$preperso->id_preperso'
            ";
            
        }else if($tipe == 3){
            $preperso = preperso::find($iner);

            $query = "select applet.operator,pol.nama,pol.kode,pol.tahun,'applet' as proses,jam_mulai,jam_selesai,line,shift,id_applet as iner,shift,dead,applet.isi,lot from applet inner join pol on applet.id_pol = pol.id_pol where id_applet = '$preperso->old'
            union
            select preperso.operator,pol.nama,pol.kode,pol.tahun,'preperso' as proses,jam_mulai,jam_selesai,line,shift,id_preperso as iner,shift,dead,preperso.isi,'' as lot from preperso inner join pol on preperso.id_pol = pol.id_pol where id_preperso = '$iner'
            union
            select record.operator,pol.nama,pol.kode,pol.tahun,'record' as proses,jam_mulai,jam_selesai,line,shift,iner,shift,dead,record.isi,'' as lot from record inner join pol on record.id_pol = pol.id_pol where old = '$preperso->id_preperso'
            ";
        }else{
            $record = record::where('iner', $iner)->first();
            $preperso = preperso::find($record->old);

            $query = "select applet.operator,pol.nama,pol.kode,pol.tahun,'applet' as proses,jam_mulai,jam_selesai,line,shift,id_applet as iner,shift,dead,applet.isi,lot from applet inner join pol on applet.id_pol = pol.id_pol where id_applet = '$preperso->old'
            union
            select preperso.operator,pol.nama,pol.kode,pol.tahun,'preperso' as proses,jam_mulai,jam_selesai,line,shift,id_preperso as iner,shift,dead,preperso.isi,'' as lot from preperso inner join pol on preperso.id_pol = pol.id_pol where id_preperso = '$preperso->id_preperso'
            union
            select record.operator,pol.nama,pol.kode,pol.tahun,'record' as proses,jam_mulai,jam_selesai,line,shift,iner,shift,dead,record.isi,'' as lot from record inner join pol on record.id_pol = pol.id_pol where old = '$iner'
            ";
        }
        
        $cari = DB::select($query);
        $no = 1;
        return view('admin.tbl_track', compact('cari','no'));
        
    }
}
