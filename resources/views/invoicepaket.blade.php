@extends('layouts.app')

@section('content')

@if(\Session::has('kasir') || \Session::has('admin'))
    <div class="page-header">
        <div class="page-title">
            <h3>Invoice</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="invoice">
                        <div class="d-md-flex justify-content-between align-items-center">
                            <img src="{{ url('assets/media/image/logo/mdc.png') }}" alt="logo">
                            <h3 class="text-xs-left m-b-0">#INV-{{$sewa_paket_wisata->ID_SEWA_PAKET}}</h3>
                        </div>
                        <hr class="m-t-b-50">
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <b>PT. Medina Dzikra Cemerlang Trans</b><br>
                                    JL. Suwoko No. 43 A Lamongan - Jawa Timur<br>
                                    Telp : (0322) 3101285
                                </p>
                                <p>
                                <b>{{$pengguna->NAMA_PENGGUNA}},</b><br>{{$sewa_paket_wisata->TGL_SEWA_PAKET}}   -   {{$sewa_paket_wisata->TGL_AKHIR_SEWA_PAKET}}
                                <br>{{$sewa_paket_wisata->JAM_SEWA_PAKET}}       -      {{$sewa_paket_wisata->JAM_AKHIR_SEWA_PAKET}}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-right">
                                    <b>Invoice to</b>
                                </p>
                                <p class="text-right"> {{$customer->NAMA_CUSTOMER}},<br> {{$customer->TELEPHONE}},<br> {{$customer->ALAMAT}}.
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table my-4">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Unit Cost</th>
                                    <th class="text-right">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-right">
                                    <td class="text-left">1</td>
                                    <td class="text-left">Brochure Design</td>
                                    <td>2</td>
                                    <td>$20</td>
                                    <td>$40</td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <p>Sub - Total amount: $12,348</p>
                            <p>vat (10%) : $138</p>
                            <h4 class="font-weight-800">Total : $13,986</h4>
                        </div>
                        <p class="text-center small text-muted  m-t-50">
                            <span class="row">
                                <span class="col-md-6 offset-3">
                                    Invoice of PT. MDC Trans
                                </span>
                            </span>
                        </p>
                    </div>
                    <div class="text-right d-print-none">
                        <hr class="my-5">
                        <a href="#" class="btn btn-primary">Send Invoice</a>
                        <a href="javascript:window.print()" class="btn btn-success m-l-5">
                            <i class="ti-printer mr-2"></i> Print
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif
@endsection
