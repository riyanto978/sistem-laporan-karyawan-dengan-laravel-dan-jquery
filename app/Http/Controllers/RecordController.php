<?php

namespace App\Http\Controllers;

use App\periode;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\preperso;
use App\record;
//use App\uid;
//use App\pol;
use App\user;
//use App\periode;


class RecordController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($tipe)
    {

        

        if($tipe == 1){
            $side = "record";            
        }else if(($tipe == 2)){
            $side = "record_only";            
        }else{
            $side = "record_virgin";            
        }
        $user = User::find(Auth::user()->id);
        $user->halaman = $side;

        $user->update();
        $data['line'] = '';
        if ($tipe == 'edit') {
            return view('record.edit', compact('tipe', 'user'));
        }
        return view('record.record', compact('user','tipe','data'));
    }
    
    public function simpan_sementara(Request $request)
    {
        // $tabl = 'record'.$request->id_periode;
        if($request->preper == null){
            $old = "";
        }else{
            $old = $request->preper;
        }

        $operator = urldecode($request->operator);
        $cek = DB::table('record')->where('operator', $operator)->where('group_record', $request->group_record)->where('status', 1)->count();        
        
        $exist = DB::table('record')->where('id_periode', $request->id_periode)
        ->where('iner', $request->line . '-' . $request->iner)->count();
        if ($cek == 0 && $exist == 0) {
            $record = new record;            
            $record->id_pol = $request->id_pol;
            $record->iner = $request->line.'-'.$request->iner;
            $record->id_proses = $request->id_proses;
            $record->operator = $operator;
            $record->line = $request->line;            
            $record->shift = $request->shift;
            $record->isi = $request->isi;
            $record->group_record = $request->group_record;
            $record->dead = 0;
            $record->error = 0;
            $record->virgin = 0;
            $record->status = 1;
            $record->old = $old;
            $record->id_periode = $request->id_periode;
            $record->save();            

            $user = User::find(Auth::user()->id);
            $user->id_periode = $request->id_periode;
            $user->update();

            if( $request->preper <> null){
                $preperso = preperso::find($request->preper);
                $preperso->status=3;
                $preperso->update();
            }
            echo "selamat mengerjakan";
        } else {
            echo "kerjakan yang sudah ada dahulu atau Job Sudah di Kerjakan";
        }
    }
    
    public function tbl_laporan_sementara($operator, $tipe)
    {
        $operator = urldecode($operator);
        $record = DB::table('record')
        ->join('pol', 'record.id_pol', 'pol.id_pol')
        ->join('periode','pol.id_periode','periode.id_periode')        
        ->where('operator', $operator)->where('record.status', 1)
        ->where('group_record', $tipe)
        ->get();        
        $no = 1;
        return view('record.tbl_sementara', compact('record', 'no','tipe'));
    }
    
    public function tbl_laporan($operator, $tanggal, $tipe)
    {
        $operator = urldecode($operator);
        $awal = $tanggal . " 07:00:01";
        $akhir = hari_tambah($tanggal) . " 07:00:00";
        
        $record = DB::table('record')
        ->join('pol', 'record.id_pol', 'pol.id_pol')
        ->join('periode', 'pol.id_periode', 'periode.id_periode')    
        ->where('operator', $operator)->where('status', '<>', 1)
        ->where('group_record', $tipe)
        ->whereBetween('jam_mulai', [$awal, $akhir])
        ->get();
        // $periode = periode::all();
        // $query = '';
        // $total = count($periode);
        // $nama = Auth::user()->username;
        // $no = 0;

        // foreach ($periode as $data) {
        //     $no++;
        //     $query .= "SELECT * FROM record" . $data->id_periode . " INNER JOIN  pol on record" . $data->id_periode . ".id_pol = pol.id_pol where operator = '" . $nama . "'  And jam_mulai Between '".$awal."' and '".$akhir. "' AND status <> 1";
        //     if ($no < $total) {
        //         $query .= ' UNION ';
        //     }
        // }
        
        // $record = DB::select($query);

        $no = 1;
        return view('record.tbl_laporan', compact('record', 'no', 'tipe'));
    }

    public function edit($operator, $tanggal)
    {
        $operator = urldecode($operator);
        $awal = $tanggal . " 07:00:01";
        $akhir = hari_tambah($tanggal) . " 07:00:00";

        $record = DB::table('record')
            ->join('pol', 'record.id_pol', 'pol.id_pol')
            ->join('periode', 'pol.id_periode', 'periode.id_periode')
            ->where('operator', $operator)->where('status', '<>', 1)
            ->where('group_record', 3)
            ->whereBetween('jam_mulai', [$awal, $akhir])
            ->get();
        $no = 1;
        return view('record.edit_jam', compact('record', 'no'));
    }
    
    public function hapus($id)
    {

        $record = record::find($id);           
        if ($record->old <> null) {
            $preperso = preperso::find($record->old);
            $preperso->status = 2;
            $preperso->update();
        }
        $record->delete();
        
        
    }
    
    public function upload(Request $request)
    {                        
        if ($request->hasFile('upload')) {
            $file = $request->file("upload");
            //$cari = record::find($request->id_record);
            // $files = $cari->line.'-'.$cari->iner . '.txt';
            //$nama_file = explode('_',$file->getClientOriginalName());
            //$dbase = explode('-', $cari->iner);
            // $nomor = int($cek[1]);
            // dd(ltrim($cek[1],0));
            
            if(count(file($file)) == 500){            
            // if(strtoupper($dbase[0]) == strtoupper($nama_file[0]) && $dbase[1].'.txt' == ltrim($nama_file[1],0)){            
                $record = record::find($request->id_record);                                                
                $record->status =  2;
                $record->dead = $request->input('dead', 0);
                $record->error = $request->input('error', 0);
                $record->virgin = $request->input('virgin', 0);
                $record->lot = $request->input('lot', '');
                $periode = periode::find($record->id_periode);
                $nama_gambar = $file->getClientOriginalName();
                $lokasi = public_path('log/'. $periode->nama_periode.'/log_record/'.$record->operator);
                $file->move($lokasi, $nama_gambar);           
                $record->update();    
            
                echo json_encode(array(2));
            }else{
                echo json_encode(array(1));
            }
            // }else{
            //     echo json_encode(array(1));    
            // }
        } else {
            echo json_encode(array(1));
        }
    }
    
    public function update(Request $request, $id)
    {
        $record = record::find($id);
        $record[$request->kolom] = $request->val;
        $record->update();

        // if($request->kolom == 'jam_mulai'){
        //     $val = "concat(date(jam_mulai), ' $request->val')";
        // }elseif($request->kolom == 'jam_selesai'){
        //     $val = "concat(date(jam_selesai), ' $request->val')";
        // }else{
        //     $val = $request->val;
        // }
        //dd($val);
        //DB::update("update record set $request->kolom  = $val where id_record = $id");
    }
    
    public function list($tipe){
        
        $list = DB::table('preperso')
            ->join('pol', 'preperso.id_pol', 'pol.id_pol')            
            ->join('periode', 'pol.id_periode','periode.id_periode')
            ->select( 'preperso.id_preperso', 'preperso.id_pol', 'pol.nama', 'pol.kode', 'pol.jmlorder', 'pol.tahun','periode.id_periode','periode.nama_periode')
            ->when($tipe == 3, function ($query) use ($tipe) {
                return $query->where('grup', $tipe);
            })
            ->when($tipe < 3, function ($query) use ($tipe) {
                return $query->where('grup','<>' , 3);
            })
            ->where('preperso.status', 2)->get();        
        return view('record.list_record',compact('list'));
    }
    
    public function pol()
    {        
        $list = DB::table('pol')                
        ->where('stat', 3
        )->get();
        return view('preperso.pol', compact('list'));
    }

    public function line($line,$id_periode){
        // $tabl = 'record'.$id_periode;
        
        $record = DB::table('record')->where('line',$line)->where('id_periode',$id_periode)->orderBy('id_record','desc')->first();
       if($record){
            $a = $record->iner;
            $b = substr($a, 2) + 1;
            $d[] = $b;
       }else{
            $d[] = 1;
       }
        
        echo json_encode($d);   
    }
}

