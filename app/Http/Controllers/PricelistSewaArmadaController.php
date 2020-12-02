<?php

namespace App\Http\Controllers;

use App\Pricelist_Sewa_Armada;
use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class PricelistSewaArmadaController extends Controller
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
        $category_armada = DB::table('category_armada')->get();
        $pricelist_sewa_armada=DB::table('pricelist_sewa_armada')
        ->join('category_armada','pricelist_sewa_armada.ID_CATEGORY', '=', 'category_armada.ID_CATEGORY')
        ->select('category_armada.NAMA_CATEGORY','pricelist_sewa_armada.ID_PRICELIST','pricelist_sewa_armada.TUJUAN_SEWA',
        'pricelist_sewa_armada.PRICELIST_SEWA')
        ->get();


        return view('pricelistsewaarmada', ['pricelist_sewa_armada' =>$pricelist_sewa_armada, 'category_armada' =>$category_armada]);
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
        $pricelist_sewa_armada = new Pricelist_Sewa_Armada;
        $category_armada = new Category;

        $pricelist_sewa_armada->fill([
            'ID_CATEGORY'       => $request->ID_CATEGORY,
            'TUJUAN_SEWA'       => $request->tujuansewa,
            'PRICELIST_SEWA'    => $request->hargasewa,
        ]);

        $pricelist_sewa_armada->save();

        return redirect('pricelistsewaarmada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pricelist_Sewa_Armada  $pricelist_Sewa_Armada
     * @return \Illuminate\Http\Response
     */
    public function show(Pricelist_Sewa_Armada $pricelist_Sewa_Armada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pricelist_Sewa_Armada  $pricelist_Sewa_Armada
     * @return \Illuminate\Http\Response
     */
    public function edit(Pricelist_Sewa_Armada $pricelist_Sewa_Armada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pricelist_Sewa_Armada  $pricelist_Sewa_Armada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('pricelist_sewa_armada')->where('ID_PRICELIST',$request->id)->update([
            'ID_CATEGORY'       => $request->ID_CATEGORY,
            'TUJUAN_SEWA'       => $request->tujuansewa,
            'PRICELIST_SEWA'    => $request->hargasewa,
        ]);

        return redirect('pricelistsewaarmada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pricelist_Sewa_Armada  $pricelist_Sewa_Armada
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pricelist_sewa_armada')->where('ID_PRICELIST',$id)->delete();
		
		// alihkan halaman ke halaman category
		return redirect('pricelistsewaarmada');
    }
}
