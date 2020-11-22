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
        $armada=DB::table('armada')->get();
        $customer=DB::table('customer')->get();
        $sewa_bus=DB::table('sewa_bus')
        ->join('armada','sewa_bus.ID_ARMADA', '=', 'armada.ID_ARMADA')
        ->join('customer','sewa_bus.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
        ->select('sewa_bus.ID_SEWA_BUS','sewa_bus.TGL_SEWA_BUS',
        'sewa_bus.TGL_AKHIR_SEWA','sewa_bus.LAMA_SEWA','customer.NAMA_CUSTOMER','armada.NAMA_ARMADA',
        'sewa_bus.HARGA_SEWA_BUS','sewa_bus.FINISH','sewa_bus.JAM_SEWA','sewa_bus.JAM_AKHIR_SEWA')
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
        $action=false;
        return view('sewa_bus', ['sewa_bus' =>$sewa_bus,'armada' =>$armada, 'customer' =>$customer,'ID_SEWA_BUS'=>$ID_SEWA_BUS,'action'=>$action]);
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
                'TGL_SEWA_BUS' => $request->tglsewa,
                'TGL_AKHIR_SEWA' => $request->tglakhirsewa,
                'LAMA_SEWA' => $request->lamasewa,
                'ID_CUSTOMER' => $request->ID_CUSTOMER,
                'ID_ARMADA' => $request->ID_ARMADA,
                'HARGA_SEWA_BUS' => $request->hargasewabus,
                'FINISH' => 1,
                'JAM_SEWA' => $request->jamsewa,
                'JAM_AKHIR_SEWA' => $request->jamakhirsewa
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
        $sewa_bus=DB::table('sewa_bus')->where('ID_SEWA_BUS',$request->id)->value('status','=','1');
        if($sewa_bus){
            DB::table('sewa_bus')
                ->where('ID_SEWA_BUS',$request->id)
                ->update(['status'=>0]);
        }
        else{
            DB::table('sewa_bus')
                ->where('ID_SEWA_BUS',$request->id)
                ->update(['status'=>1]);
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
