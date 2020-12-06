<?php

namespace App\Http\Controllers;

use App\galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
        if(!Session::get('login')){
            return redirect('login');
        }
        else{
        $galeri=DB::table('galeri')->get();
        $armada=DB::table('armada')->get();

        return view('gallery', ['galeri' =>$galeri], ['armada' =>$armada]);
    }
}

    public function indexfoto($id)
    {
        if(!Session::get('login')){
            return redirect('login');
        }
        else{
        $galeri=DB::table('galeri')->get();
        $armada=DB::table('armada')->get();

        return view('fotoarmada', ['galeri' =>$galeri], ['armada' =>$armada]);
    }
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

    public function update_switch(Request $request)
    {
        $galeri=DB::table('galeri')->where('ID_GALERI',$request->id)->value('STATUS_FOTO','=','1');
        if($galeri){
            DB::table('galeri')
                ->where('ID_GALERI',$request->id)
                ->update(['STATUS_FOTO'=>0]);
        }
        else{
            DB::table('galeri')
                ->where('ID_GALERI',$request->id)
                ->update(['STATUS_FOTO'=>1]);
        }
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
