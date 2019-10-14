<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kartu_sam;
use Datatables;
use Auth;

use Hash;
use DB;
use App\user;

class KartuSamController extends Controller
{

  public function __construct()
    {
        $this->middleware('auth');
    }

   public function index()
   {
      $user = User::find(Auth::user()->id);
      $user->halaman = "kartu_sam";
      $user->update();

      return view('kartu_sam.kartu_sam',compact('user')); 
   }

   public function listData()
   {          
     $kartu_sam = DB::select("select * from kartu_sam ");
     $no = 0;
     $data = array();
     foreach($kartu_sam as $list){       
      $applet = DB::select("select pol.kode,nama,sum(applet.isi) as total from pol inner join applet on pol.id_pol = applet.id_pol where id_kartu_sam=? group by pol.id_pol",[$list->id_kartu_sam]);
      
      $sam = '';
      foreach ($applet as $cari) {
        $sam .= $cari->kode.' - '.$cari->nama.' '.$cari->total.'<br>';
      }

       $no ++;
       $row = array();
       $row[] = $no;              
       $row[] = $list->nama;
       $row[] = $list->isi;      
       $row[] = $sam ;
       $row[] = $list->created_at;
       $row[] = '<div class=""btn-group"><a onclick="deleteData('.$list->id_kartu_sam.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
       <a onclick="editForm('.$list->id_kartu_sam.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a></div>';
       $data[] = $row;       
     }

       $output = array("data" => $data);
     return response()->json($output);
   }   

   public function store(Request $request)
   {      
        $kartu_sam = new kartu_sam;          
          $kartu_sam->nama = $request->nama;
          $kartu_sam->isi = $request->isi;          
        $kartu_sam->save();
      
   }

   public function edit($id)
   {
     $kartu_sam = kartu_sam::find($id);
     echo json_encode($kartu_sam);
   }

   public function update(Request $request, $id)
   {
      $kartu_sam = kartu_sam::find($id);
           $kartu_sam->nama = $request->nama;
          $kartu_sam->isi = $request->isi;  
        $kartu_sam->update();
   }

   public function destroy($id)
   {
      $kartu_sam = kartu_sam::find($id);        
      $kartu_sam->delete();
   }

   
}
