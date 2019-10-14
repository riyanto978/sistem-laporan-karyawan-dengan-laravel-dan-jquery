<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\user;
use App\notifikasi;
use App\Events\send_notifikasi;
use App\Events\MessageSent;

class NotifikasiController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $user->halaman = "notifikasi";
        $user->update();
        
        return view('notifikasi.notifikasi', compact('user'));
    }
    
    public function listData()
    {    
        $notifikasi = notifikasi::all();
        $no = 0;
        $data = array();
        foreach($notifikasi as $list){            
            $no ++;
            $row = array();
            $row[] = $no;       
            $row[] = $list->pesan;
            $row[] = "<div class='bg-$list->warna'> $list->warna</div>";
            $row[] = $list->sampai;
            $row[] = ambil_tanggal($list->created_at);
            $row[] = '<div class=""btn-group"><a onclick="deleteData('.$list->id_notifikasi.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
            <a onclick="editForm('.$list->id_notifikasi.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a></div>';
            $row[] = "<a class='btn btn-success' onclick='broadcast(".$list->id_notifikasi.")'>broadcast</a>";
            $data[] = $row;       
        }
        
        $output = array("data" => $data);
        return response()->json($output);
    }
    
    public function store(Request $request)
    {      
        $notifikasi = new notifikasi;
        $notifikasi->pesan = $request->pesan;
        $notifikasi->warna = $request->warna;                
        $notifikasi->save();
        
    }
    
    public function edit($id)
    {
        $notifikasi = notifikasi::find($id);
        echo json_encode($notifikasi);
    }
    
    public function update(Request $request, $id)
    {
        $notifikasi = notifikasi::find($id);
        $notifikasi->pesan = $request->pesan;
        $notifikasi->warna = $request->warna;        
        $notifikasi->update();
    }
    
    public function destroy($id)
    {
        $notifikasi = notifikasi::find($id);        
        $notifikasi->delete();
    }

    public function ambil_notifikasi()
    {
        $now = date('Y-m-d H:i:s');        
        $notifikasi = notifikasi::where('sampai','>',$now)->first();
        if($notifikasi){
            $detik = strtotime($notifikasi->sampai) - strtotime($now);
        }else{
            $detik = 0;
        }
        return response()->json(['notifikasi' => $notifikasi,'detik' => $detik*1000]);
    }

    public function broadcast(Request $request, $id)
    {
        if($request->waktu == 0){
            $sampai = 'null';
        }else{
            $sampai = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . "+ $request->waktu minutes"));
        }        
        $notifikasi = notifikasi::find($id);
        $notifikasi->pesan = $request->pesan;
        $notifikasi->warna = $request->warna;
        $notifikasi->sampai = $sampai;
        $notifikasi->update();

        $now = date('Y-m-d H:i:s');
        $notifikasi = notifikasi::where('sampai', '>', $now)->first();

        if ($notifikasi) {
            $detik = strtotime($notifikasi->sampai) - strtotime($now);
        } else {
            $detik = 0;
        }
        //broadcast(new send_notifikasi($notifikasi,$detik*1000));
        return response()->json(['notifikasi' => $notifikasi, 'detik' => $detik * 1000]);
    }
    
    public function coba(){
        $notifikasi = notifikasi::first();        
        broadcast(new MessageSent($notifikasi));
    }
    
}
