<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\preperso;
use App\applet;
use App\uid;
//use App\pol;
use App\user;

class PrepersoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($tipe)
    {
        if ($tipe == 1) {
            $side = "preperso";
        } else if ($tipe == 2) {
            $side = "preperso_only";
        } else {
            $side = "virgin";
        }

        $user = User::find(Auth::user()->id);
        $user->halaman = $side;
        $user->update();

        return view('preperso.preperso', compact('user', 'tipe'));
    }

    public function simpan_sementara(Request $request)
    {
        if ($request->applet == null) {
            $applet = new applet;
            $applet->id_pol = '1';
            $applet->operator = '1';
            $applet->line = '1';
            $applet->shift = '1';
            $applet->isi = '1';
            $applet->dead = 0;
            $applet->error = 0;
            $applet->lemah = 0;
            $applet->status = 1;
            $applet->id_kartu_sam = '1';
            $applet->tip = 'A';
            $applet->save();

            $id_applet = $applet->id_applet;

            $app = applet::find($id_applet);
            $app->delete();

            $old = null;
        } else {
            $id_applet = $request->applet;
            $old = $request->applet;
        }
        $operator = urldecode($request->operator);
        $cek = preperso::where('operator', $operator)->where('status', 1)->where('grup', $request->grup)->count();
        if ($cek == 0) {
            $preperso = new preperso;
            $preperso->id_preperso = $id_applet;
            $preperso->id_pol = $request->id_pol;
            $preperso->iner = '1';
            $preperso->id_proses = $request->id_proses;
            $preperso->operator = $operator;
            $preperso->line = $request->line;
            $preperso->id_pol = $request->id_pol;
            $preperso->shift = $request->shift;
            $preperso->isi = $request->isi;
            $preperso->dead = 0;
            $preperso->grup = $request->grup;
            $preperso->status = 1;
            $preperso->old = $old;
            $preperso->save();

            if ($request->applet <> null) {
                $applet = applet::find($request->applet);
                $applet->status = 3;
                $applet->update();
            }
            echo "selamat mengerjakan";
        } else {
            echo "kerjakan yang sudah ada dahulu";
        }
    }

    public function tbl_laporan_sementara($operator, $tipe)
    {

        $operator = urldecode($operator);
        $preperso = DB::table('preperso')
            ->join('pol', 'preperso.id_pol', 'pol.id_pol')
            ->select('pol.nama', 'pol.kode', 'pol.tahun', 'preperso.jam_mulai', 'preperso.line', 'preperso.id_preperso', 'preperso.old')
            ->where('preperso.operator', $operator)->where('preperso.status', 1)->where('grup', $tipe)->get();

        $arr = array();
        foreach ($preperso as $data) {
            $applet = applet::find($data->old);
            if ($applet != null) {
                $op = $applet->operator;
            } else {
                $op = '';
            }
            $row = [];
            $row['nama'] = $data->nama;
            $row['kode'] = $data->kode;
            $row['tahun'] = $data->tahun;
            $row['jam_mulai'] = $data->jam_mulai;
            $row['line'] = $data->line;
            $row['id_preperso'] = $data->id_preperso;
            $row['operator'] = $op;
            $arr[] = $row;
        }

        $no = 1;
        return view('preperso.tbl_sementara', compact('arr', 'no'));
    }

    public function tbl_laporan($operator, $tanggal, $tipe)
    {
        $operator = urldecode($operator);
        $awal = $tanggal . " 00:00:01";
        $akhir = $tanggal . " 23:59:59";

        $preperso = DB::table('preperso')
            ->join('pol', 'preperso.id_pol', 'pol.id_pol')
            ->where('grup', $tipe)
            ->where('operator', $operator)->where('status', '<>', 1)
            ->whereBetween('jam_mulai', [$awal, $akhir])
            ->get();

        $no = 1;
        
        return view('preperso.tbl_laporan', compact('preperso', 'no'));
    }

    public function hapus($id)
    {
        $preperso = preperso::find($id);

        if ($preperso->old <> null) {
            $applet = applet::find($id);
            $applet->status = 2;
            $applet->update();
            $uid = uid::where('id_preperso', $id);
            $uid->delete();
        }
        $preperso->delete();
    }

    public function upload(Request $request)
    {
        $file = $request->file("upload");
        $files = $request->id_preperso . '.txt';
        if ($request->hasFile('upload') && $file->getClientOriginalName() == $files) {

            $preperso = preperso::find($request->id_preperso);
            $preperso->status =  2;
            
            $nama_gambar = $file->getClientOriginalName();
            $lokasi = public_path('log/log_preperso/' . $preperso->operator);
            $file->move($lokasi, $nama_gambar);
            
            if ($preperso->grup == '3') {
                foreach (file(public_path('log/log_preperso/' . $preperso->operator . '/' . $nama_gambar)) as $g) {
                    $bagi = explode(" | ",$g );                    
                    //dd($uid);
                    if (uid::where('uid', str_replace(" ", "", $bagi[0]))->exists() == false) {
                        $uid = new uid;
                        $uid->id_preperso = $request->id_preperso;
                        $uid->uid = str_replace(" ", "", $bagi[0]);                        
                        $uid->save();
                    }
                }
            } else {
                foreach (file(public_path('log/log_preperso/' . $preperso->operator . '/' . $nama_gambar)) as $g) {
                    if (uid::where('uid', str_replace(" ", "", $g))->exists() == false) {
                        $uid = new uid;
                        $uid->id_preperso = $request->id_preperso;
                        $uid->uid = str_replace(" ", "", $g);                        
                        $uid->save();
                    }
                }
            }

            $uid = uid::where('id_preperso', $request->id_preperso)->count();
            if($uid == 500){
                $preperso->update();
                echo json_encode(array(2));
            }else{
                $uid = uid::where('id_preperso', $request->id_preperso)->delete();
                echo json_encode(array(3));    
            }
            
        } else {
            echo json_encode(array(1));
        }
    }

    public function update(Request $request, $id)
    {
        $preperso = preperso::find($id);
        $preperso[$request->kolom] = $request->val;
        $preperso->update();
    }

    public function list()
    {
        $list = DB::table('applet')
            ->join('pol', 'applet.id_pol', 'pol.id_pol')
            ->select('applet.tip', 'applet.id_applet', 'applet.id_pol', 'pol.nama', 'pol.kode', 'pol.jmlorder', 'pol.tahun')
            ->where('applet.status', 2)->get();
        return view('preperso.list_preperso', compact('list'));
    }

    public function pol()
    {
        $list = DB::table('pol')
            ->where('stat', 2)->get();
        return view('preperso.pol', compact('list'));
    }

    public function log()
    {
        $side = "log";
        $user = User::find(Auth::user()->id);
        $user->halaman = $side;
        $user->update();
        return view('preperso.log', compact('user'));
    }

    public function proseslog(Request $request)
    {
        $preperso = preperso::where('id_preperso', $request->iner)->get();
        
        if (count($preperso) > 0) {

            $delete = uid::where('id_preperso', $request->iner)->delete();       
            $preperso = preperso::find($request->iner);
            $file = $request->file("upload");
            //dd(count(file($file)));
            $nama_gambar = $file->getClientOriginalName();
            $lokasi = public_path('log/log_preperso/' . $preperso->operator);
            $file->move($lokasi, $nama_gambar);

            // foreach (file(public_path('log/log_preperso/' . $preperso->operator . '/' . $nama_gambar)) as $g) {
            //     if (uid::where('uid', $g)->count() == 0) {
            //         $uid = new uid;
            //         $uid->id_preperso = $request->iner;
            //         $uid->uid = $g;
            //         $uid->save();
            //     }
            // }

            if ($preperso->grup == '3') {
                foreach (file(public_path('log/log_preperso/' . $preperso->operator . '/' . $nama_gambar)) as $g) {
                    $bagi = explode(" | ", $g);
                    //dd($uid);
                    if (uid::where('uid', str_replace(" ", "", $bagi[0]))->exists() == false) {
                        $uid = new uid;
                        $uid->id_preperso = $request->iner;
                        $uid->uid = str_replace(" ", "", $bagi[0]);                        
                        $uid->save();
                    }
                }
            } else {
                foreach (file(public_path('log/log_preperso/' . $preperso->operator . '/' . $nama_gambar)) as $g) {
                    if (uid::where('uid', str_replace(" ", "", $g))->exists() == false) {
                        $uid = new uid;
                        $uid->id_preperso = $request->iner;
                        $uid->uid = str_replace(" ","",$g);                        
                        $uid->save();
                    }
                }
            }

            echo " $request->iner sukses di upload";
        } else {
            echo "Job Pre Perso $request->iner Belum dibuat";
        }
    }

    public function track_preperso()
    {
        $user = User::find(Auth::user()->id);
        $user->halaman = "track_preperso";
        $user->update();

        return view('preperso.track_preperso', compact('user'));
    }

    public function proses_track_preperso($uid)
    {
        $preperso = DB::table('preperso')
            ->join('pol', 'preperso.id_pol', 'pol.id_pol')
            ->join('uid', 'uid.id_preperso', 'preperso.id_preperso')
            ->where('uid', 'LIKE', '%' . $uid . '%')
            ->get();
        $no = 1;
        return view('preperso.tbl_track', compact('preperso', 'no'));
    }
}
