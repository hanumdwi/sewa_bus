<?php

namespace App\Http\Controllers;

use App\sewa_bus;
use Illuminate\Http\Request;
use DB;

class SewaBusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $customer=DB::table('customer')->get();
        $pengguna=DB::table('pengguna')->get();
        $sewa_bus=DB::table('sewa_bus')
        ->join('customer','sewa_bus.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
        ->join('pengguna','sewa_bus.ID_PENGGUNA', '=', 'pengguna.ID_PENGGUNA')
        ->select('sewa_bus.ID_SEWA_BUS','sewa_bus.TGL_SEWA_BUS',
        'sewa_bus.TGL_AKHIR_SEWA','sewa_bus.LAMA_SEWA','customer.NAMA_CUSTOMER',
        'sewa_bus.HARGA_SEWA_BUS','sewa_bus.STATUS_SEWA','sewa_bus.JAM_SEWA','sewa_bus.JAM_AKHIR_SEWA','sewa_bus.ID_PENGGUNA')
        ->get();

        $armada=DB::table('armada')->get();
        $detail_sewa_bus=DB::table('detail_sewa_bus')
        ->join('armada','detail_sewa_bus.ID_ARMADA', '=', 'armada.ID_ARMADA')
        ->get();


        $max = DB::table('sewa_bus')->max('ID_SEWA_BUS');
        date_default_timezone_set('Asia/Jakarta');
        $date=date("ymd",time());

        $max=substr($max,6);
        if($max>=1){
            $ID_SEWA_BUS=$date.str_pad($max+1,4,"0",STR_PAD_LEFT);
        }
        else{
            $ID_SEWA_BUS=$date.str_pad(1,4,"0",STR_PAD_LEFT);
        }
        
        return view('sewa_bus', ['sewa_bus' =>$sewa_bus,'ID_SEWA_BUS'=>$ID_SEWA_BUS,'customer'=>$customer,'pengguna'=>$pengguna],  
        ['detail_sewa_bus'=>$detail_sewa_bus,'armada'=>$armada]);
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
            DB::table('sewa_bus')->insert([
                'ID_SEWA_BUS' => $request->ID_SEWA_BUS,
                'TGL_SEWA_BUS' => $request->TGL_SEWA,
                'TGL_AKHIR_SEWA' => $request->TGL_AKHIR_SEWA,
                'LAMA_SEWA' => $request->LAMA_SEWA,
                'ID_CUSTOMER' => $request->ID_CUSTOMER,
                'ID_PENGGUNA' => $request->ID_PENGGUNA,
                'HARGA_SEWA_BUS' => $request->HARGA_SEWA_BUS,
                'STATUS_SEWA' => 1,
                'JAM_SEWA' => $request->JAM_SEWA,
                'JAM_AKHIR_SEWA' => $request->JAM_AKHIR_SEWA
            ]);

            DB::table('detail_sewa_bus')->insert([
                'ID_ARMADA' =>  $request->ID_ARMADA,
                'ID_SEWA_BUS' => $request->ID_SEWA_BUS
            ]);

        DB::commit();
        }
        Catch (\Exception $ex){
            DB::rollback();
            throw $ex;
        }
             return redirect('sewa_bus')->with('insert','data berhasil di tambah');
    }

    public function getAllSchedule()
    {
        $sewa_bus=DB::table('sewa_bus')
        ->select(
        DB::raw('(ID_CUSTOMER) as title'), 
        DB::raw('(TGL_SEWA_BUS) as start'), 
        DB::raw('(TGL_AKHIR_SEWA) as end'))
        ->get();

        //$data = array_values($sewa_bus);
        return response()->json($sewa_bus);
    }

    public function getScheduleById($id)
    {
        $sewa_bus=DB::table('sewa_bus')->where('ID_SEWA_BUS','=',$id)
        ->select(
        DB::raw('(ID_CUSTOMER) as title'), 
        DB::raw('(TGL_SEWA_BUS) as start'), 
        DB::raw('(TGL_AKHIR_SEWA) as end'))
        ->get();

        //$data = array_values($sewa_bus);
        return response()->json($sewa_bus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sewa_bus  $sewa_bus
     * @return \Illuminate\Http\Response
     */
    public function show(sewa_bus $sewa_bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sewa_bus  $sewa_bus
     * @return \Illuminate\Http\Response
     */
    public function edit(sewa_bus $sewa_bus)
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
    public function update(Request $request, sewa_bus $sewa_bus)
    {
        
    }

    public function update_switch(Request $request)
    {
        $sewa_bus=DB::table('sewa_bus')->where('ID_SEWA_BUS',$request->id)->value('STATUS_SEWA','=','1');
        if($sewa_bus){
            DB::table('sewa_bus')
                ->where('ID_SEWA_BUS',$request->id)
                ->update(['STATUS_SEWA'=>0]);
        }
        else{
            DB::table('sewa_bus')
                ->where('ID_SEWA_BUS',$request->id)
                ->update(['STATUS_SEWA'=>1]);
        }
        return redirect('sewa_busindex');
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
}
