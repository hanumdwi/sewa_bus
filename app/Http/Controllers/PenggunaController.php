<?php

namespace App\Http\Controllers;

use App\pengguna;
use Illuminate\Http\Request;
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
        $pengguna=DB::table('pengguna')->get();



        return view('penggunaindex', ['pengguna' =>$pengguna]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // DB::table('customer')->insert([
        //     'NAMA_CUSTOMER'   => $request->nama,
        //     'EMAIL'           => $request->email,
        //     'TELEPHONE'       => $request->telephone,
        //     'ALAMAT'          => $request->alamat
        //      ]);
     
        // return redirect('customerindex');
        $pengguna = new Pengguna;

        $pengguna->fill([
            'NAMA_PENGGUNA'         => $request->nama,
            'EMAIL_PENGGUNA'        => $request->email,
            'USERNAME'              => $request->email,
            'TELEPHONE_PENGGUNA'    => $request->telephone,
            'ALAMAT_PENGGUNA'       => $request->alamat,
            'PASSWORD'              => $request->password,
            'JOB_STATUS'            => $request->jobstatus
        ]);

        $pengguna->save();

        return redirect('penggunaindex');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
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
		return view('penggunaindex',['pengguna' => $pengguna]);
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
        DB::table('pengguna')->where('ID_PENGGUNA',$request->id)->update([
			'NAMA_PENGGUNA'         => $request->nama,
            'EMAIL_PENGGUNA'        => $request->email,
            'USERNAME'              => $request->email,
            'TELEPHONE_PENGGUNA'    => $request->telephone,
            'ALAMAT_PENGGUNA'       => $request->alamat,
            'PASSWORD'              => $request->password,
            'JOB_STATUS'            => $request->jobstatus
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
}
