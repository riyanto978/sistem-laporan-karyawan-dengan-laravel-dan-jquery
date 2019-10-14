<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\periode;
use Datatables;
use URL;
use DB;
use App\lot;
use App\user;
use Auth;

class PeriodeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $user->halaman = "periode";
        $user->update();
        return view('periode.periode',compact('user')); 
    }
    
    public function listData()
    {        
        $periode = DB::select("select * from periode  order By id_periode desc");
        $no = 0;
        $data = array();
        foreach($periode as $list){            
            $no ++;
            $row = array();
            $row[] = $no;                   
            $row[] = $list->nama_periode;
            $row[] = $list->jmlorder;      
            $row[] = $list->created_at;
            $row[] = '<div class=""btn-group"><a onclick="deleteData('.$list->id_periode.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
            <a onclick="editForm('.$list->id_periode.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a></div>';
            $data[] = $row;       
        }
        
        $output = array("data" => $data);
        return response()->json($output);
    }    
    
    public function store(Request $request)
    {      
        $periode = new periode;    
        $periode->nama_periode = $request->nama;
        $periode->jmlorder = $request->jmlorder;    
        $periode->save();
        
        //$this->buat_database($periode);
    }
    
    public function edit($id)
    {
        $periode = periode::find($id);
        echo json_encode($periode);
    }
    
    public function update(Request $request, $id)
    {
        $periode = periode::find($id);
        $periode->nama_periode = $request->nama;
        $periode->jmlorder = $request->jmlorder;    
        $periode->update();
    }
    
    public function destroy($id)
    {
        $periode = periode::find($id);        
        $periode->delete();
    }
    
    public function buat_database($periode)   {
        
        $create = 'CREATE TABLE IF NOT EXISTS record'.$periode->id_periode.' (
            `id_record` int(11) NOT NULL,
            `id_pol` int(5) NOT NULL,
            `iner` varchar(10) DEFAULT NULL,
            `id_proses` int(11) NOT NULL,
            `operator` varchar(20) NOT NULL,
            `line` varchar(10) NOT NULL,
            `jam_mulai` datetime NOT NULL,
            `jam_selesai` datetime NOT NULL,
            `shift` int(1) NOT NULL,
            `isi` int(3) NOT NULL,
            `dead` int(3) DEFAULT NULL,
            `error` int(3) DEFAULT NULL,
            `lemah` int(3) DEFAULT NULL,
            `grup` varchar(20) DEFAULT NULL,
            `status` int(11) DEFAULT NULL,
            `old` int(11) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
            
            $alter1 = 'ALTER TABLE record'.$periode->id_periode.'
            ADD PRIMARY KEY (`id_record`),
            ADD UNIQUE KEY `iner` (`iner`),
            MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT';
            $alter2 = 'ALTER TABLE record'.$periode->id_periode.'ADD `id_periode` INT(10) NULL AFTER `old`';        
            DB::statement($create);
            DB::statement($alter1);
            DB::statement($alter2);
        }
    }
    