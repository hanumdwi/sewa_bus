<?php

namespace App\Http\Controllers;

use App\sewa_bus;
use App\pengguna;
use App\customer;
use App\category;
use App\paket_wisata;
use App\sewa_bus_category;
use App\sewa_paket_wisata;
use App\Pricelist_Sewa_Armada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class SewaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if(!Session::get('login')){
            return redirect('login');
        }
        else{
        $sewa_bus= Sewa_Bus::find($id);
        $pengguna= Pengguna::find($sewa_bus->ID_PENGGUNA);
        $customer= customer::find($sewa_bus->ID_CUSTOMER);

        $sewa_bus_category= Sewa_Bus_Category::where('ID_SEWA_BUS','=',$sewa_bus->ID_SEWA_BUS);
        $pricelist_sewa_armada= Pricelist_Sewa_Armada::all();
        $category_armada= Category::all();


        return view('sewa_bus_detail', ['sewa_bus' =>$sewa_bus,'pengguna'=>$pengguna,'customer'=>$customer],
        ['sewa_bus_category'=>$sewa_bus_category,'pricelist_sewa_armada'=>$pricelist_sewa_armada, 'category_armada'=>$category_armada]);
    }
}

    public function indexpaket(Request $request, $id)
    {
        if(!Session::get('login')){
            return redirect('login');
        }
        else{
        $sewa_paket_wisata= Sewa_Paket_Wisata::find($id);
        $pengguna= Pengguna::find($sewa_paket_wisata->ID_PENGGUNA);
        $customer= Customer::find($sewa_paket_wisata->ID_CUSTOMER);
        
        $paket_wisata= Paket_Wisata::find($sewa_paket_wisata->ID_PAKET);



        return view('sewa_paket_detail', ['sewa_paket_wisata' =>$sewa_paket_wisata,'pengguna'=>$pengguna,
        'customer'=>$customer,'paket_wisata'=>$paket_wisata]);
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

    public function pdf()
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
        $category_armada = new Category;

        $category_armada->fill([
            'NAMA_CATEGORY'   => $request->namacategory
        ]);

        $category_armada->save();

        return redirect('category_armadaindex');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
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
        DB::table('category_armada')->where('ID_CATEGORY',$request->id)->update([
            'NAMA_CATEGORY'   => $request->namacategory
        ]);

        return redirect('category_armadaindex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('category_armada')->where('ID_CATEGORY',$id)->delete();
		
		// alihkan halaman ke halaman category
		return redirect('category_armadaindex');
    }
}
