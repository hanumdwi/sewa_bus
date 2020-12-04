<?php

namespace App\Http\Controllers;

use App\schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class ScheduleController extends Controller
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
        $armada=DB::table('armada')->get();
        $sewa_bus_category=DB::table('sewa_bus_category')->get();
        $sewa_paket_wisata=DB::table('sewa_paket_wisata')->get();
        $schedule_armada=DB::table('schedule_armada')
        ->join('armada','schedule_armada.ID_ARMADA', '=', 'armada.ID_ARMADA')
        ->join('sewa_bus_category','schedule_armada.ID_SEWA_CATEGORY', '=', 'sewa_bus_category.ID_SEWA_CATEGORY')
        ->join('sewa_paket_wisata','schedule_armada.ID_SEWA_PAKET', '=', 'sewa_paket_wisata.ID_SEWA_PAKET')
        ->select('schedule_armada.ID_SCHEDULE','schedule_armada.TGL_SEWA',
        'schedule_armada.TGL_AKHIR_SEWA','armada.NAMA_ARMADA', 'sewa_paket_wisata.ID_SEWA_PAKET',
        'schedule_armada.STATUS_ARMADA','schedule_armada.JAM_SEWA','schedule_armada.JAM_AKHIR_SEWA','sewa_bus_category.ID_SEWA_CATEGORY')
        ->get();

        // $max = DB::table('sewa_bus')->max('ID_SEWA_BUS');
        // date_default_timezone_set('Asia/Jakarta');
        // $date=date("ymd",time());

        // $max=substr($max,6);
        // if($max>=1){
        //     $ID_SEWA_BUS=$date.str_pad($max+1,4,"0",STR_PAD_LEFT);
        // }
        // else{
        //     $ID_SEWA_BUS=$date.str_pad(1,4,"0",STR_PAD_LEFT);
        // }
        
        return view('scheduleindex', ['schedule_armada'=> $schedule_armada, 'sewa_bus_category' =>$sewa_bus_category,
        'armada'=>$armada,'sewa_paket_wisata'=>$sewa_paket_wisata]);
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
            DB::table('schedule_armada')->insert([
                'ID_SCHEDULE' => $request->ID_SCHEDULE,
                'TGL_SEWA' => $request->TGL_SEWA,
                'TGL_AKHIR_SEWA' => $request->TGL_AKHIR_SEWA,
                'LAMA_SEWA' => $request->LAMA_SEWA,
                'ID_ARMADA' => $request->ID_ARMADA,
                'ID_SEWA_CATEGORY' => $request->ID_SEWA_CATEGORY,
                'ID_SEWA_PAKET' => $request->ID_SEWA_PAKET,
                'HARGA_SEWA_BUS' => $request->HARGA_SEWA_BUS,
                'STATUS_SEWA' => 1,
                'JAM_SEWA' => $request->JAM_SEWA,
                'JAM_AKHIR_SEWA' => $request->JAM_AKHIR_SEWA
            ]);

        DB::commit();
        }
        Catch (\Exception $ex){
            DB::rollback();
            throw $ex;
        }
             return redirect('scheduleindex')->with('insert','data berhasil di tambah');
    }

    public function getAllSchedule()
    {
        $schedule_armada=DB::table('schedule_armada')
        ->select(
        DB::raw('(ID_ARMADA) as title'), 
        DB::raw('(TGL_SEWA) as start'), 
        DB::raw('(TGL_AKHIR_SEWA) as end'))
        ->get();

        //$data = array_values($sewa_bus);
        return response()->json($schedule_armada);
    }

    public function getScheduleById($id)
    {
        $schedule_armada=DB::table('schedule_armada')->where('ID_SCHEDULE','=',$id)
        ->select(
        DB::raw('(ID_ARMADA) as title'), 
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
