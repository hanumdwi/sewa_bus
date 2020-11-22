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
        $sewa_bus = DB::table('sewa_bus')->get();
        $armada = DB::table('armada')
        ->join('category_armada','armada.ID_CATEGORY', '=', 'category_armada.ID_CATEGORY')
        ->select('category_armada.NAMA_CATEGORY','armada.ID_ARMADA','armada.NAMA_ARMADA', 'armada.PLAT_NOMOR', 'armada.KAPASITAS', 'armada.FASILITAS','armada.HARGA','armada.STATUS')
        ->get();

        return view ('armadaindex',['armada' =>$armada,'category_armada' =>$category_armada], ['sewa_bus'=>$sewa_bus]);
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
            'ID_CATEGORY'     => $request->ID_CATEGORY,
            'NAMA_ARMADA'     => $request->namaarmada,
            'PLAT_NOMOR'      => $request->platnomor,
            'KAPASITAS'       => $request->kapasitas,
            'FASILITAS'       => $request->fasilitas,
            'HARGA'           => $request->harga,
            'STATUS'          => $request->status
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
			'ID_CATEGORY'     => $request->ID_CATEGORY,
            'NAMA_ARMADA'     => $request->namaarmada,
            'PLAT_NOMOR'      => $request->platnomor,
            'KAPASITAS'       => $request->kapasitas,
            'FASILITAS'       => $request->fasilitas,
            'HARGA'           => $request->harga,
            'STATUS'          => $request->status
		]);
		// alihkan halaman ke halaman armada
		return redirect('armadaindex');
    }

    public function update_switch(Request $request)
    {
        $armada=DB::table('armada')->where('ID_ARMADA',$request->id)->value('status','=','1');
        if($armada){
            DB::table('armada')
                ->where('ID_ARMADA',$request->id)
                ->update(['status'=>0]);
        }
        else{
            DB::table('armada')
                ->where('ID_ARMADA',$request->id)
                ->update(['status'=>1]);
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
