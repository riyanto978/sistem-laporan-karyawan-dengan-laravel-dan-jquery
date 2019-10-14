<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\pol;
use Auth;
use Hash;
use Image;
use File;
use DB;

class UserController extends Controller
{
  public $dimensions;
  public $path;

  public function __construct()
  {
    $this->middleware('auth');
    $this->dimensions = ['150','300'];
    $this->path = public_path('foto');
  }
  
  public function index()
  {
    $user = User::find(Auth::user()->id);
    $user->halaman = "user";
    $user->update();
    
    return view('user.index',compact('user')); 
  }
  
  public function listData()
  {
    
    $user = User::orderBy('id', 'desc')->get();
    $no = 0;
    $data = array();
    foreach($user as $list){
      if($list->level==2){
        $level="user";
      }elseif($list->level==1){
        $level="Administrator";
      }else{
        $level="Packing";
      }
      
      $no ++;
      $row = array();
      $row[] = $no;
      $row[] = '<img src="public/foto/300/'.$list->foto.'" class="logo" width="100" height="100">';  
      
      $row[] = $list->name;
      $row[] = $list->username;
      $row[] = $level;
      $row[] = '<div class="btn-group">
      <a onclick="editForm('.$list->id.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
      <a onclick="deleteData('.$list->id.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
      $data[] = $row;
    }
    
    $output = array("data" => $data);
    return response()->json($output);
  }
  
  public function store(Request $request)
  {      
    
    $file = $request->file("foto");
    $nama_gambar = $request->username . date('YmdHis') . "." . $file->getClientOriginalExtension();
    $lokasi = public_path('foto');
        
    foreach ($this->dimensions as $row) {
      $canvas = Image::canvas($row,$row);
      $resizeImage  = Image::make($file)->resize($row, $row, function ($constraint) {
        $constraint->aspectRatio();
      });
      
      if (!File::isDirectory($this->path . '/' . $row)) {        
        File::makeDirectory($this->path . '/' . $row);
      }
      $canvas->insert($resizeImage, 'center');      
      $canvas->save($this->path . '/' . $row . '/' . $nama_gambar);
    }
    $file->move($lokasi, $nama_gambar);                             
    
    $user = new User;
    $user->name = $request['nama'];
    $user->username = $request['username'];
    $user->password = bcrypt($request['password']);
    $user->foto         = $nama_gambar; 
    $user->level = $request['level'];
    $user->save();  
    
    if($user){
      return "success";    
    }else{
      return "gagal";
    }
  }
  
  public function edit($id)
  {
    $user = User::find($id);
    echo json_encode($user);
  }
  
  public function update(Request $request, $id)
  {
    $user = User::find($id);
    $user->name = $request['nama'];
    $user->username = $request['username'];
    if(!empty($request['password'])) $user->password = bcrypt($request['password']);
    $user->level = $request['level'];
    if ($request->hasFile('foto')) {
      $file = $request->file("foto");
      $nama_gambar = $user->username.date('YmdHis').".".$file->getClientOriginalExtension();
      $lokasi = public_path('foto');

      foreach ($this->dimensions as $row) {
        $canvas = Image::canvas($row, $row);
        $resizeImage  = Image::make($file)->resize($row, $row, function ($constraint) {
          $constraint->aspectRatio();
        });
        
        if (!File::isDirectory($this->path . '/' . $row)) {
          File::makeDirectory($this->path . '/' . $row);
        }
        $canvas->insert($resizeImage, 'center');
        $canvas->save($this->path . '/' . $row . '/' . $nama_gambar);
      }
      $file->move($lokasi, $nama_gambar);
      $user->foto = $nama_gambar;
    }
    $user->update();
  }
  
  public function destroy($id)
  {
    $user = User::find($id);
    $user->delete();
  }
  
  public function profil()
  {
    $user = User::find(Auth::user()->id);
    $user->halaman = "change_profil";
    $user->update();
    
    return view('user.profil', compact('user')); 
  }
  
  public function changeProfil(Request $request, $id)
  {
    $msg = "succcess";
    $user = User::find($id);
    if(!empty($request['password'])){
      if(Hash::check($request['passwordlama'], $user->password)){
        $user->password = bcrypt($request['password']);
      }else{
        $msg = 'error';
      }
    } 
    
    if ($request->hasFile('foto')) {
      $file = $request->file('foto');
      $nama_gambar = $user->username . date('YmdHis') . "." . $file->getClientOriginalExtension();
      $lokasi = public_path('foto');

      foreach ($this->dimensions as $row) {
        $canvas = Image::canvas($row, $row);
        $resizeImage  = Image::make($file)->resize($row, $row, function ($constraint) {
          $constraint->aspectRatio();
        });

        if (!File::isDirectory($this->path . '/' . $row)) {
          File::makeDirectory($this->path . '/' . $row);
        }
        $canvas->insert($resizeImage, 'center');
        $canvas->save($this->path . '/' . $row . '/' . $nama_gambar);
      }

      $file->move($lokasi, $nama_gambar);
      $user->foto         = $nama_gambar;  
      
      $datagambar = $nama_gambar;
    }else{
      $datagambar = $user->foto; 
    }
    
    $user->update();
    echo json_encode(array('msg'=>$msg, 'url'=> asset('public/foto/'.$datagambar))); 
  }
  
  public function eksport()
  {
    $data = DB::table('user_pengguna')->get();    
    foreach($data as $item)
    {
      $user = new User;
        $user->name = $item->nama;
        $user->username = $item->nama_user;
        $user->password = bcrypt('ts');
        $user->foto = $item->foto;
        $user->level = 2;
      $user->save();
    }
  }

  public function count(){
    $data = count (file(public_path('F_00006.txt')));
      echo $data;
  }
}
