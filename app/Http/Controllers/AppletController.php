<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Datatables;
use Auth;
//use Hash;
use DB;
use App\pol;
use App\kartu_sam;
use App\applet;
use App\sam;
use App\user;

class AppletController extends Controller
{
   
   public function __construct()
   {
      $this->middleware('auth');
   }
   
   public function index()
   {
      
      $user = User::find(Auth::user()->id);
      $user->halaman = "applet";
      $user->update();
      
      $kartu_sam = kartu_sam::all();
      
      $pol = pol::join('periode','periode.id_periode','pol.id_periode')->where('stat', 1)->get();
      
      return view('applet.applet', compact('pol', 'kartu_sam','user'));
   }
   
   public function simpan_sementara(Request $request)
   {
      $operator = urldecode($request->operator);
      $cek = applet::where('operator', $operator)->where('status', 1)->count();
      
      if ($cek == 0) {
         $applet = new applet;
         $applet->id_pol = $request->id_pol;
         $applet->operator = $operator;
         $applet->line = $request->line;
         $applet->shift = $request->shift;
         $applet->isi = $request->isi;
         $applet->dead = 0;
         $applet->error = 0;
         $applet->lemah = 0;
         $applet->status = 1;
         $applet->id_kartu_sam = $request->sam;
         $applet->tip = $request->tipe_chip;
         $applet->save();
         echo "selamat mengerjakan";
      } else {
         echo "kerjakan yang sudah ada dahulu";
      }
   }
   
   public function tbl_laporan_sementara($operator)
   {
      $operator = urldecode($operator);
      $applet = DB::table('applet')
      ->join('pol', 'applet.id_pol', 'pol.id_pol')
      ->join('periode', 'pol.id_periode', 'periode.id_periode')
      ->where('operator', $operator)->where('status', 1)->get();
      
      $no = 1;
      return view('applet.tbl_sementara', compact('applet', 'no'));
   }
   
   public function tbl_laporan($operator, $tanggal)
   {
      $operator = urldecode($operator);
      $awal = $tanggal . " 07:00:01";
      $akhir = hari_tambah($tanggal) . " 07:00:00";
      
      
      $applet = DB::table('applet')
      ->join('pol', 'applet.id_pol', 'pol.id_pol')
      ->where('operator', $operator)->where('status', '<>', 1)
      ->whereBetween('jam_mulai', [$awal, $akhir])
      ->get();
      
      $no = 1;
      return view('applet.tbl_laporan', compact('applet', 'no'));
   }
   
   public function hapus($id)
   {
      $applet = applet::find($id);
      $applet->delete();
   }
   
   public function upload(Request $request)
   {
      $file = $request->file("upload");
      $files = $request->id_applet . '(SUCCESS).txt';
      if ($request->hasFile('upload') && $file->getClientOriginalName() == $files) {
         
         $applet = applet::find($request->id_applet);
         $lot = " # Lot 1 : " . $request->lot_1 .
         " # Lot 2 : " . $request->lot_2 .
         " # Lot 3 : " . $request->lot_3;
         $applet->lot = $lot;
         $applet->dead = $request->dead;
         
         $applet->status =  2;
         
         
         $nama_gambar = $file->getClientOriginalName();
         $lokasi = public_path('log/log_applet/'.$applet->operator);
         $file->move($lokasi, $nama_gambar);
         
         $file_path = public_path('log/log_applet/'.$applet->operator.'/'.$nama_gambar);
         foreach (file($file_path) as $g) {
            
            $data = explode(',', $g);
            if (sam::where('sam_uid', $data['4'])->count() == 0) {
               $sam = new sam;
               $sam->id_applet = $request->id_applet;
               $sam->sam = "";
               $sam->sam_uid = $data['4'];
               $sam->save();
            }
         }

         $sam = sam::where('id_applet', $request->id_applet)->count();
         if ($sam == 500) {
            $applet->update();
            echo json_encode(array(2));
         } else {
            $sam = sam::where('id_applet', $request->id_applet)->delete();
            echo json_encode(array(3));
         }                  
      } else {
         echo json_encode(array(1));
      }
   }
   
   public function update(Request $request, $id)
   {
      
      $applet = applet::find($id);
      $applet->dead = intval($request->val);
      $applet->update();
   }
   
   public function sam()
   {
      
      $user = User::find(Auth::user()->id);
      $user->halaman = "upload_sam";
      $user->update();
      return view('applet.sam', compact('user'));
   }
   
   public function prosessam(Request $request)
   {
      $applet = applet::where('id_applet', $request->iner)->get();
      
      if (count($applet) > 0) {
         $file = $request->file("upload");
         
         $nama_gambar = $file->getClientOriginalName();
         $lokasi = public_path('log/log_applet/'.$applet->operator);
         $file->move($lokasi, $nama_gambar);         
         
         $file_path = public_path('log/log_applet/'.$applet->operator.'/' . $nama_gambar);
         foreach (file($file_path) as $g) {
            $data = explode(',', $g);
            if (sam::where('sam_uid', $data['4'])->count() == 0) {
               $sam = new sam;
               $sam->id_applet = $request->iner;
               $sam->sam = "";
               $sam->sam_uid = $data['4'];
               $sam->save();
            }
         }
         echo " $request->iner sukses di upload";
      } else {
         echo "Job Pre Perso $request->iner Belum dibuat";
      }
   }
   
   public function track_applet()
   {
      $user = User::find(Auth::user()->id);
      $user->halaman = "track_applet";
      $user->update();
      return view('applet.track_applet',compact('user'));      
   }
   
   public function proses_track_applet($uid){
      $applet = DB::table('applet')
      ->join('pol', 'applet.id_pol', 'pol.id_pol')         
      ->join('sam','sam.id_applet','applet.id_applet')
      ->where('sam_uid','LIKE', '%'.$uid.'%')
      ->get();
      $no = 1;
      return view('applet.tbl_track', compact('applet', 'no'));
   }
   
   public function pengganti()
   {
      $user = User::find(Auth::user()->id);
      $user->halaman = "applet_pengganti";
      $user->update();
      return view('applet.applet_pengganti', compact('user'));
   }
   
   public function proses_pengganti(Request $request)
   {
      $applet = applet::find($request->id_laporan);
      $applet->status= 3;
      $applet->pengganti = 1;
      $applet->update();
   }
   
   public function listData()
   {        
      $applet = applet::join('pol','pol.id_pol','applet.id_pol')->join('periode','periode.id_periode','pol.id_periode')
      ->where('applet.pengganti', 1)->get();
      $no = 0;
      $data = array();
      foreach ($applet as $list) {
         $no++;
         $row = array();
         $row[] = $no;
         $row[] = $list->nama_periode;
         $row[] = $list->kode;
         $row[] = $list->tahun;
         $row[] = $list->id_applet;         
         $row[] = '<div class=""btn-group"><a onclick="deleteData(' . $list->id_applet . ')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';      
         $data[] = $row;
      }
      
      $output = array("data" => $data);
      return response()->json($output);
   }
   
   public function update_pengganti(Request $request, $id)
   {
      
      $applet = applet::find($id);
      $applet->status = 2;
      $applet->pengganti = 0;
      $applet->update();
   }
   
   
}
