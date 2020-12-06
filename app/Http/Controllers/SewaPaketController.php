<?php

namespace App\Http\Controllers;

use App\sewa_paket_wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class SewaPaketController extends Controller
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
        $customer=DB::table('customer')->get();
        $pengguna=DB::table('pengguna')->get();
        $paket_wisata=DB::table('paket_wisata')->get();
        $sewa_paket_wisata=DB::table('sewa_paket_wisata')
        ->join('customer','sewa_paket_wisata.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
        ->join('pengguna','sewa_paket_wisata.ID_PENGGUNA', '=', 'pengguna.ID_PENGGUNA')
        ->join('paket_wisata','sewa_paket_wisata.ID_PAKET', '=', 'paket_wisata.ID_PAKET')
        ->select('sewa_paket_wisata.ID_SEWA_PAKET','sewa_paket_wisata.TGL_SEWA_PAKET',
        'sewa_paket_wisata.TGL_AKHIR_SEWA_PAKET','customer.NAMA_CUSTOMER', 'sewa_paket_wisata.DP_PAKET',
        'sewa_paket_wisata.HARGA_SEWA_PAKET','sewa_paket_wisata.JAM_SEWA_PAKET',
        'sewa_paket_wisata.JAM_AKHIR_SEWA_PAKET','pengguna.NAMA_PENGGUNA','paket_wisata.NAMA_PAKET')
        ->get();

        $max = DB::table('sewa_paket_wisata')->max('ID_SEWA_PAKET');
        date_default_timezone_set('Asia/Jakarta');
        $date=date("ymd",time());

        $max=substr($max,6);
        if($max>=1){
            $ID_SEWA_PAKET=$date.str_pad($max+1,4,"0",STR_PAD_LEFT);
        }
        else{
            $ID_SEWA_PAKET=$date.str_pad(1,4,"0",STR_PAD_LEFT);
        }
        
        return view('sewa_paket', ['sewa_paket_wisata' =>$sewa_paket_wisata,'ID_SEWA_PAKET'=>$ID_SEWA_PAKET,'customer'=>$customer,'pengguna'=>$pengguna,'paket_wisata'=>$paket_wisata]);
    }
}

    public function generateSewa(){

        $idsewa="INV2020110101";
        return $idsewa;
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
        DB::beginTransaction();
        try{
            DB::table('sewa_paket_wisata')->insert([
                'ID_SEWA_PAKET'         => $request->ID_SEWA_PAKET,
                'TGL_SEWA_PAKET'        => $request->TGL_SEWA_PAKET,
                'TGL_AKHIR_SEWA_PAKET'  => $request->TGL_AKHIR_SEWA_PAKET,
                'ID_PAKET'              => $request->ID_PAKET,
                'ID_CUSTOMER'           => $request->ID_CUSTOMER,
                'ID_PENGGUNA'           => $request->ID_PENGGUNA,
                // 'HARGA_SEWA_PAKET'      => $request->HARGA_SEWA_PAKET,
                'JAM_SEWA_PAKET'        => $request->JAM_SEWA_PAKET,
                'JAM_AKHIR_SEWA_PAKET'  => $request->JAM_AKHIR_SEWA_PAKET
                // 'DP_PAKET'              =>  $request->DP_PAKET
            ]);

        DB::commit();
        }
        Catch (\Exception $ex){
            DB::rollback();
            throw $ex;
        }
             return redirect('sewa_paket')->with('insert','data berhasil di tambah');
    }

    public function getAllSchedule()
    {
        $sewa_PAKET=DB::table('sewa_PAKET')
        ->select(
        DB::raw('(ID_CUSTOMER) as title'), 
        DB::raw('(TGL_SEWA_PAKET) as start'), 
        DB::raw('(TGL_AKHIR_SEWA) as end'))
        ->get();

        //$data = array_values($sewa_PAKET);
        return response()->json($sewa_PAKET);
    }

    public function getScheduleById($id)
    {
        $sewa_PAKET=DB::table('sewa_PAKET')->where('ID_SEWA_PAKET','=',$id)
        ->select(
        DB::raw('(ID_CUSTOMER) as title'), 
        DB::raw('(TGL_SEWA_PAKET) as start'), 
        DB::raw('(TGL_AKHIR_SEWA) as end'))
        ->get();

        //$data = array_values($sewa_PAKET);
        return response()->json($sewa_PAKET);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sewa_PAKET  $sewa_PAKET
     * @return \Illuminate\Http\Response
     */
    public function show(sewa_PAKET $sewa_PAKET)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sewa_PAKET  $sewa_PAKET
     * @return \Illuminate\Http\Response
     */
    public function edit(sewa_PAKET $sewa_PAKET)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sewa_bus  $sewa_bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('sewa_paket_wisata')->where('ID_SEWA_PAKET',$request->id)->update([
            'ID_SEWA_PAKET'         => $request->ID_SEWA_PAKET,
                'TGL_SEWA_PAKET'        => $request->TGL_SEWA_PAKET,
                'TGL_AKHIR_SEWA_PAKET'  => $request->TGL_AKHIR_SEWA_PAKET,
                'ID_PAKET'              => $request->ID_PAKET,
                'ID_CUSTOMER'           => $request->ID_CUSTOMER,
                'ID_PENGGUNA'           => $request->ID_PENGGUNA,
                // 'HARGA_SEWA_PAKET'      => $request->HARGA_SEWA_PAKET,
                'JAM_SEWA_PAKET'        => $request->JAM_SEWA_PAKET,
                'JAM_AKHIR_SEWA_PAKET'  => $request->JAM_AKHIR_SEWA_PAKET
                // 'DP_PAKET'              =>  $request->DP_PAKET
        ]);

        return redirect('sewa_paket');
    }

    public function update_switch(Request $request)
    {
        $sewa_paket_wisata=DB::table('sewa_paket_wisata')->where('ID_SEWA_PAKET',$request->id)->value('STATUS_SEWA','=','1');
        if($sewa_paket_wisata){
            DB::table('sewa_paket_wisata')
                ->where('ID_SEWA_PAKET',$request->id)
                ->update(['STATUS_SEWA'=>0]);
        }
        else{
            DB::table('sewa_paket_wisata')
                ->where('ID_SEWA_PAKET',$request->id)
                ->update(['STATUS_SEWA'=>1]);
        }
        return redirect('sewa_paket');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sewa_bus  $sewa_bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(sewa_bus $sewa_bus)
    {
        //
    }

    public function pdf_paket(Request $request)
    {
        $customer=DB::table('customer')->get();
        $pengguna=DB::table('pengguna')->get();
        $paket_wisata=DB::table('paket_wisata')->get();
        $sewa_paket_wisata=DB::table('sewa_paket_wisata')
        ->join('customer','sewa_paket_wisata.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
        ->join('pengguna','sewa_paket_wisata.ID_PENGGUNA', '=', 'pengguna.ID_PENGGUNA')
        ->join('paket_wisata','sewa_paket_wisata.ID_PAKET', '=', 'paket_wisata.ID_PAKET')
        ->select('sewa_paket_wisata.ID_SEWA_PAKET','sewa_paket_wisata.TGL_SEWA_PAKET',
        'sewa_paket_wisata.TGL_AKHIR_SEWA_PAKET','customer.NAMA_CUSTOMER', 'sewa_paket_wisata.DP_PAKET',
        'sewa_paket_wisata.HARGA_SEWA_PAKET','sewa_paket_wisata.JAM_SEWA_PAKET',
        'sewa_paket_wisata.JAM_AKHIR_SEWA_PAKET','pengguna.NAMA_PENGGUNA','paket_wisata.NAMA_PAKET')
        ->get();

        return view('invoicepaket', ['sewa_paket_wisata' =>$sewa_paket_wisata,
        'customer'=>$customer,'pengguna'=>$pengguna,'paket_wisata'=>$paket_wisata]);
    }
}
