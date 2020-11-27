<?php

namespace App\Http\Controllers;

use App\armada;
use App\category;
use Illuminate\Http\Request;
use DB;

class ArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_armada = DB::table('category_armada')->get();
        $schedule_armada = DB::table('schedule_armada')->get();
        $galeri = DB::table('galeri')->get();
        $armada = DB::table('armada')
        ->join('category_armada','armada.ID_CATEGORY', '=', 'category_armada.ID_CATEGORY')
        ->join('galeri','armada.ID_GALERI', '=', 'galeri.ID_GALERI')
        ->select('category_armada.NAMA_CATEGORY','armada.ID_ARMADA','armada.NAMA_ARMADA', 'galeri.FOTO_ARMADA',
        'armada.PLAT_NOMOR', 'armada.KAPASITAS', 'armada.FASILITAS_ARMADA','armada.HARGA','armada.STATUS_ARMADA')
        ->get();

        return view ('armadaindex',['armada' =>$armada,'category_armada' =>$category_armada, 'galeri' =>$galeri], ['schedule_armada'=>$schedule_armada]);
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
        $armada = new Armada;
        $category_armada = new Category;

        $armada->fill([
            'ID_CATEGORY'           => $request->ID_CATEGORY,
            'NAMA_ARMADA'           => $request->namaarmada,
            'ID_GALERI'             => $request->fotoarmada,
            'PLAT_NOMOR'            => $request->platnomor,
            'KAPASITAS'             => $request->kapasitas,
            'FASILITAS_ARMADA'      => $request->fasilitas,
            'HARGA'                 => $request->harga,
            'STATUS_ARMADA'         => $request->status
        ]);

        $armada->save();

        return redirect('armadaindex');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\armada  $armada
     * @return \Illuminate\Http\Response
     */
    public function show(armada $armada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\armada  $armada
     * @return \Illuminate\Http\Response
     */
    public function edit(armada $armada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\armada  $armada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('armada')->where('ID_ARMADA',$request->id)->update([
			'ID_CATEGORY'           => $request->ID_CATEGORY,
            'NAMA_ARMADA'           => $request->namaarmada,
            'ID_GALERI'             => $request->fotoarmada,
            'PLAT_NOMOR'            => $request->platnomor,
            'KAPASITAS'             => $request->kapasitas,
            'FASILITAS_ARMADA'      => $request->fasilitas,
            'HARGA'                 => $request->harga
		]);
		// alihkan halaman ke halaman armada
		return redirect('armadaindex');
    }

    public function update_switch(Request $request)
    {
        $armada=DB::table('armada')->where('ID_ARMADA',$request->id)->value('STATUS_ARMADA','=','1');
        if($armada){
            DB::table('armada')
                ->where('ID_ARMADA',$request->id)
                ->update(['STATUS_ARMADA'=>0]);
        }
        else{
            DB::table('armada')
                ->where('ID_ARMADA',$request->id)
                ->update(['STATUS_ARMADA'=>1]);
        }
        return redirect('armadaindex');
    }

    /**
     * 
     * Remove the specified resource from storage.
     *
     * @param  \App\armada  $armada
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('armada')->where('ID_ARMADA',$id)->delete();
		
		// alihkan halaman ke halaman armada
		return redirect('armadaindex');
    }
}
