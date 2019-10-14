<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pol;
use Datatables;
use App\periode;
use App\resume_proses;
use Auth;
use Hash;
use URL;
use DB;
use App\lot;
use App\user;

class PolController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $user = User::find(Auth::user()->id);
    $user->halaman = "pol";
    $user->update();

    $periode = periode::all();
    return view('pol.pol', compact('periode', 'user'));
  }

  public function listData()
  {
    $url = url::to('/');
    // $pol = pol::where('tipe','1')->orderBy('id_pol', 'desc')->get();
    $pol = DB::select("select *,pol.nama as namapol,periode.nama_periode as per from pol Inner join periode on pol.id_periode = periode.id_periode order By id_pol desc");
    $no = 0;
    $data = array();
    foreach ($pol as $list) {
      if ($list->stat == '0') {
        $status = 'selesai';
      } else if ($list->stat == '1') {
        $status = 'Applet dahulu';
      } else if ($list->stat == '2') {
        $status = 'Preperso dahulu';
      } else if ($list->stat == '3') {
        $status = 'Record saja';
      }

      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $list->kode;
      $row[] = $list->tahun;
      $row[] = $list->namapol;
      $row[] = $list->jmlorder;
      $row[] = $status;
      $row[] = $list->tipe_chip;
      $row[] = $list->per;
      $row[] = '<div class=""btn-group"><a onclick="deleteData(' . $list->id_pol . ')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
      <a onclick="editForm(' . $list->id_pol . ')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a></div>';
      $data[] = $row;
    }

    $output = array("data" => $data);
    return response()->json($output);
  }

  public function store(Request $request)
  {
    $cek = pol::where('id_periode', $request->id_periode)->where('kode', $request->kode)->exists();
    if ($cek == false) {
      $pol = new pol;
      $pol->kode = $request->kode;
      $pol->tahun = $request->tahun;
      $pol->nama = $request->nama;
      $pol->jmlorder = $request->jmlorder;
      $pol->stat = $request->stat;
      $pol->isi = 500;
      $pol->tipe_chip = $request->tipe_chip;
      $pol->id_periode = $request->id_periode;
      $pol->save();
      return response()->json('tersimpan');
    } else {
      return response()->json('');
    }
  }

  public function edit($id)
  {
    $pol = pol::find($id);
    echo json_encode($pol);
  }

  public function update(Request $request, $id)
  {

    $pol = pol::find($id);
    $pol->kode = $request->kode;
    $pol->tahun = $request->tahun;
    $pol->nama = $request->nama;
    $pol->jmlorder = $request->jmlorder;
    $pol->stat = $request->stat;
    $pol->tipe_chip = $request->tipe_chip;
    $pol->id_periode = $request->id_periode;    
    $pol->update();
    return response()->json('tersimpan');
  }

  public function destroy($id)
  {
    $pol = pol::find($id);
    $pol->delete();
  }

  public function buat_database()
  {
    $create = 'CREATE TABLE IF NOT EXISTS `record1` (
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

    $alter = 'ALTER TABLE `record1`
      ADD PRIMARY KEY (`id_record`),
      ADD UNIQUE KEY `iner` (`iner`),
      MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT';

    DB::statement($alter);
  }
}
