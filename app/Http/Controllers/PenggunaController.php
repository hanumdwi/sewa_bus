<?php

namespace App\Http\Controllers;

use App\pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Session::get('login')){
            return redirect('login');
        }
        else{
        $pengguna=DB::table('pengguna')->get();



        return view('penggunaindex', ['pengguna' =>$pengguna]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createpengguna');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request->hasFile('file')) {

            $file = $request->file('file');
        
            $fileName = $file->getClientOriginalName();

        $pengguna = new Pengguna;
        $password = md5($request->password);

        
        $pengguna->NAMA_PENGGUNA         = $request->nama;
        $pengguna->EMAIL_PENGGUNA        = $request->email;
        $pengguna->USERNAME              = $request->email;
        $pengguna->TELEPHONE_PENGGUNA    = $request->telephone;
        $pengguna->ALAMAT_PENGGUNA       = $request->alamat;
        $pengguna->PASSWORD              = $request->password;
        $pengguna->JOB_STATUS            = $request->JOB_STATUS;
        $pengguna->FOTO                  = $fileName;
        $file->move(public_path().'/foto_user', $fileName);
        $pengguna->save();
        }

        return redirect('penggunaindex');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function recovery(Request $request)
    {
        return view ('recovery_pw');
    }

    public function profile($id)
    {
        $pengguna = DB::table('pengguna')
        ->where('ID_PENGGUNA',$id)
        ->get();

        return view('profile',['pengguna' => $pengguna]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // mengambil data customer berdasarkan id yang dipilih
		$pengguna = DB::table('pengguna')->where('ID_PENGGUNA',$id)->get();
		// passing data pengguna yang didapat ke view edit.blade.php
		return view('editpengguna',['pengguna' => $pengguna]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pengguna = Pengguna::find($request->id);

        $filename=$pengguna->FOTO;
        if($request->hasFile('FOTO')){
            $request->file('FOTO')->move('foto_user/',$request->file('FOTO')->getClientOriginalName());
            $filename=$request->file('FOTO')->getClientOriginalName();
        }

        $pengguna->update([
			'NAMA_PENGGUNA'         => $request->nama,
            'EMAIL_PENGGUNA'        => $request->email,
            'USERNAME'              => $request->email,
            'TELEPHONE_PENGGUNA'    => $request->telephone,
            'ALAMAT_PENGGUNA'       => $request->alamat,
            'PASSWORD'              => $request->password,
            'JOB_STATUS'            => $request->JOB_STATUS,
            'FOTO'                  => $filename
		]);
		// alihkan halaman ke halaman customer
		return redirect('penggunaindex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pengguna')->where('ID_PENGGUNA',$id)->delete();
		
		// alihkan halaman ke halaman pengguna
		return redirect('penggunaindex');
    }

    public function login(){
        return view('login');
    }

    public function postlogin(Request $request)
    {
        $EMAIL_PENGGUNA = $request->EMAIL_PENGGUNA;
        $PASSWORD       = $request->PASSWORD;

        // $data = Pengguna::where('EMAIL_PENGGUNA',$EMAIL_PENGGUNA)->first();
        $data = DB::table('pengguna')
        ->where('EMAIL_PENGGUNA', '=', $EMAIL_PENGGUNA)
        ->first();
        if($data){
            if($data->PASSWORD==$PASSWORD){
                $request->session()->put('coba2',$data->ID_PENGGUNA);
                Session::put('coba',$data->NAMA_PENGGUNA);
                Session::put('coba1',$data->JOB_STATUS);
                //Session::put('coba2','USR001');
                //Session::put('coba3', '//foto_user//'+$data->FOTO);
                    Session::put('login', TRUE);
                    if($data->JOB_STATUS == 'Admin'){
                        Session::put('admin', TRUE);
                    }
                    if($data->JOB_STATUS == 'Kasir'){
                        Session::put('kasir', TRUE);
                    }
                    return redirect('ecommerce-dashboard');
                   // return response()->json($data);
            }
            else{
                return redirect('login');
            }
        }
       dd($data);
    }

    public function logout(){
        Session::flush();
        return redirect('login');
    }
}
