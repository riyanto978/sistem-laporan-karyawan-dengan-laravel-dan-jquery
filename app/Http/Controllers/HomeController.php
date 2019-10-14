<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\user;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        return redirect('/monitoring');

        // $user = User::find(Auth::user()->id);
        //     $user->halaman = "periode";            
        // $user->update();
        
        // return view('periode.periode', compact('user'));
    }

    public function coba()
    {
        // $data = ltrim('0007777',0);
        // echo $data;
        // $myfile = fopen(public_path('log/log_banding').'/try.txt', "w");
        // $txt = "John Doe\n";
        // fwrite($myfile, $txt);
        // $txt = "Jane Doe\n";
        // fwrite($myfile, $txt);
        // fclose($myfile);
    }
    
}
