<?php

namespace App\Http\Controllers;

use App\galeri;
use Illuminate\Http\Request;
use DB;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeri=DB::table('galeri')->get();


        return view('galeriindex', ['galeri' =>$galeri]);
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
        $galeri = new Galeri;

        $galeri->fill([
            'FOTO_ARMADA'       => $request->fotoarmada,
            'DESKRIPSI_FOTO'    => $request->deskripsifoto,
            'STATUS_FOTO'       => $request->statusfoto
        ]);

        $galeri->save();

        return redirect('galeriindex');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(galeri $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('galeri')->where('ID_GALERI',$request->id)->update([
            'FOTO_ARMADA'       => $request->fotoarmada,
            'DESKRIPSI_FOTO'    => $request->deskripsifoto,
            'STATUS_FOTO'       => $request->statusfoto
        ]);

        return redirect('galeriindex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('galeri')->where('ID_GALERI',$id)->delete();
		
		// alihkan halaman ke halaman galeri
		return redirect('galeriindex');
    }
}
