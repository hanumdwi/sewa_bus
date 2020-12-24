<?php

namespace App\Http\Controllers;

use App\sewa_bus;
use App\sewa_paket_wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class DashboardController extends Controller
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
        $sewa_bus=DB::table('sewa_bus')
        ->join('customer','sewa_bus.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
        ->join('pengguna','sewa_bus.ID_PENGGUNA', '=', 'pengguna.ID_PENGGUNA')
        ->select('sewa_bus.ID_SEWA_BUS','sewa_bus.TGL_SEWA_BUS',
        'sewa_bus.TGL_AKHIR_SEWA','customer.NAMA_CUSTOMER', 'sewa_bus.DP_BUS',
        'sewa_bus.JAM_SEWA','sewa_bus.JAM_AKHIR_SEWA','pengguna.NAMA_PENGGUNA', 'sewa_bus.STATUS_SEWA',
        'sewa_bus.SISA_SEWA_BUS', 'sewa_bus.DP_BUS', 'sewa_bus.total_payment')
        ->get();

        $customer=DB::table('customer')->get();
        $pengguna=DB::table('pengguna')->get();
        $paket_wisata=DB::table('paket_wisata')->get();
        $sewa_paket_wisata=DB::table('sewa_paket_wisata')
        ->join('customer','sewa_paket_wisata.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
        ->join('pengguna','sewa_paket_wisata.ID_PENGGUNA', '=', 'pengguna.ID_PENGGUNA')
        ->join('paket_wisata','sewa_paket_wisata.ID_PAKET', '=', 'paket_wisata.ID_PAKET')
        ->select('sewa_paket_wisata.ID_SEWA_PAKET','sewa_paket_wisata.TGL_SEWA_PAKET',
        'sewa_paket_wisata.TGL_AKHIR_SEWA_PAKET','customer.NAMA_CUSTOMER', 'sewa_paket_wisata.DP_PAKET',
        'sewa_paket_wisata.SISA_SEWA_PAKET','sewa_paket_wisata.JAM_SEWA_PAKET',
        'sewa_paket_wisata.JAM_AKHIR_SEWA_PAKET','pengguna.NAMA_PENGGUNA','paket_wisata.NAMA_PAKET', 'sewa_paket_wisata.STATUS_PAKET_WISATA')
        ->get();

        
        $armada=DB::table('armada')
        ->join('category_armada', 'armada.ID_CATEGORY', '=', 'category_armada.ID_CATEGORY')
        ->leftjoin('schedule_armada', 'armada.ID_ARMADA', '=', 'schedule_armada.ID_ARMADA')
        ->select('armada.ID_ARMADA', 'armada.PLAT_NOMOR', 'category_armada.NAMA_CATEGORY')
        ->where('schedule_armada.STATUS_ARMADA', '=', 1)
        ->get();

        
        
            $pembayaran=DB::table('pembayaran')
            ->join('sewa_bus', 'pembayaran.ID_SEWA_BUS', 'sewa_bus.ID_SEWA_BUS')
            ->join('customer', 'sewa_bus.ID_CUSTOMER', 'customer.ID_CUSTOMER')
            ->select('pembayaran.*', 'customer.NAMA_CUSTOMER')
            ->get();

            return view('ecommerce-dashboard', ['sewa_bus' =>$sewa_bus,'customer'=>$customer,'pengguna'=>$pengguna,
            'sewa_paket_wisata' =>$sewa_paket_wisata,'paket_wisata'=>$paket_wisata, 'armada'=>$armada, 'pembayaran' =>$pembayaran]);
        }
    }
    public function update_switch(Request $request)
    {
        $pembayaran=DB::table('pembayaran')->where('id',$request->id)->value('STATUS_BAYAR','=','1');
        if($pembayaran){
            DB::table('pembayaran')
                ->where('id',$request->id)
                ->update(['STATUS_BAYAR'=>0]);
        }
        else{
            DB::table('pembayaran')
                ->where('id',$request->id)
                ->update(['STATUS_BAYAR'=>1]);
        }
        return redirect('ecommerce-dashboard');
    }
}
