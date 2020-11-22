@extends('layouts.app')

@section('head')
    <!-- Fullcalendar -->
    <link rel="stylesheet" href="{{ url('vendors/fullcalendar/fullcalendar.min.css') }}" type="text/css">

    <!-- Clockpicker -->
    <link rel="stylesheet" href="{{ url('vendors/clockpicker/bootstrap-clockpicker.min.css') }}" type="text/css">

    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}" type="text/css">
@endsection

@section('content')


    <div class="page-header">
        <div class="page-title">
            <h3>Sewa Bus</h3>
            <div>
                <button class="btn btn-primary" data-toggle="modal"
                        data-target="#createEventModal">
                    <i class="ti-plus mr-2"></i> Create Sewa
                </button>
            </div>
        </div>
    </div>
    
    <div class="row app-block mb-4">
        <div class="col-md-3 app-sidebar">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-2">Bus</h6>
                    <p class="text-muted">Drag and drop your event</p>
                    <div class="list-group mb-3" id="external-events">
                    @foreach($armada as $ar)
                        <div class="list-group-item px-0 fc-event">
                            <i class="fa fa-circle text-success" data-icon="car"></i>
                            {{$ar->NAMA_ARMADA}}
                        </div>
                    @endforeach
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="drop-remove" checked="">
                        <label class="custom-control-label" for="drop-remove">Remove after drop</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 app-content">
            <div class="app-content-overlay"></div>
            <div class="card app-content-body">
                <div class="card-body">
                    <a href="#" class="app-sidebar-menu-button btn btn-outline-light mb-3">
                        <i data-feather="menu"></i>
                    </a>
                    <div id="calendar-demo"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- begin::Create Event Modal -->
    <div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Sewa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                
                <div class="modal-body" >
                
                    <form autocomplete="off" action="sewa_busstore" method="post">
                    @csrf
                    <input id="finish" type="hidden" name="finish" value="false">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Id Sewa</label>
                            <div class="col-sm-9">
                                <input id="ID_SEWA_BUS" type="text" class="form-control" name="ID_SEWA_BUS" value="{{ $ID_SEWA_BUS }}" readonly="">
                                
                            </div>
                        </div>
                    
                        <div class="form-group row">
                        
                            <label class="col-sm-3 col-form-label">Nama Customer</label>
                            <div class="col-sm-9">
                            <select name="ID_CUSTOMER" class="form-control" id="ID_CUSTOMER">
                                        @foreach($customer as $cus)
                                       
                                        <option value="{{$cus->ID_CUSTOMER}}">{{$cus->NAMA_CUSTOMER}}</option>
                                       
                                        @endforeach                 
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Armada</label>
                            <div class="col-sm-9">
                            <select name="ID_ARMADA" class="form-control" id="ID_ARMADA">
                                        @foreach($armada as $ar)
                                       
                                        <option value="{{$ar->ID_ARMADA}}">{{$ar->NAMA_ARMADA}}</option>
                                       
                                        @endforeach                 
                                </select>
                            </div>
                        </div>
                        <div class="form-group row row-sm">
                            <label class="col-sm-3 col-form-label">Start Sewa</label>
                            <div class="col-sm-5">
                                <input id="tglsewa" type="text" name="tglsewa"
                                       class="form-control create-event-datepicker"
                                       placeholder="Date">
                            </div>
                            <div class="col-sm-4">
                                <input id="jamsewa" name="jamsewa" type="text" class="form-control create-event-demo"
                                       placeholder="Time">
                            </div>
                        </div>
                        <div class="form-group row row-sm">
                            <label class="col-sm-3 col-form-label">Selesai Sewa</label>
                            <div class="col-sm-5">
                                <input id="tglakhirsewa" type="text" name="tglakhirsewa"
                                class="form-control create-event-datepicker"
                                       placeholder="Date">
                            </div>
                            <div class="col-sm-4">
                                <input id="jamakhirsewa" type="text" name="jamakhirsewa"
                                class="form-control create-event-demo"
                                       placeholder="Time">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Lama Sewa</label>
                            <div class="col-sm-9">
                                <div class="avatar-group">
                                    <input id="lamasewa" type="text" name="lamasewa"
                                    class="form-control" placeholder="Lama Sewa">
                                </div>
                                <!-- <button type="button" class="btn btn-outline-light btn-sm btn-floating">
                                    <i class="ti-plus"></i>
                                </button> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Harga Sewa</label>
                            <div class="col-sm-9">
                                <input id="hargasewabus" type="text" name="hargasewabus"
                                class="form-control">
                                <!-- <textarea id="event-desc" class="form-control" rows="6"></textarea> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <button type="submit" id="btn-save" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="viewEventModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sewa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                
                <div class="modal-body">
                @foreach($sewa_bus as $sb)
                    <form autocomplete="off" action="sewa_busupdate" method="post">
                    @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Id Sewa</label>
                            <div class="col-sm-9">
                                <input id="ID_SEWA_BUS" type="text" class="form-control" name="ID_SEWA_BUS" value="{{ $ID_SEWA_BUS }}" readonly="">
                                
                            </div>
                        </div>
                    
                        <div class="form-group row">
                        
                            <label class="col-sm-3 col-form-label">Nama Customer</label>
                            <div class="col-sm-9">
                            <select name="ID_CUSTOMER" class="form-control" id="ID_CUSTOMER" value="{{ $cus->NAMA_CUSTOMER }}">
                                        @foreach($customer as $cus)
                                       
                                        <option value="{{$cus->ID_CUSTOMER}}">{{$cus->NAMA_CUSTOMER}}</option>
                                       
                                        @endforeach                 
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Armada</label>
                            <div class="col-sm-9">
                            <select name="ID_ARMADA" class="form-control" id="ID_ARMADA" value="{{ $ar->NAMA_ARMADA }}">
                                        @foreach($armada as $ar)
                                       
                                        <option value="{{$ar->ID_ARMADA}}">{{$ar->NAMA_ARMADA}}</option>
                                       
                                        @endforeach                 
                                </select>
                            </div>
                        </div>
                        <div class="form-group row row-sm">
                            <label class="col-sm-3 col-form-label">Start Sewa</label>
                            <div class="col-sm-5">
                                <input id="tglsewa" type="text"
                                       class="form-control create-event-datepicker"
                                       placeholder="Date" value="{{ $sb->TGL_SEWA_BUS }}">
                            </div>
                            <div class="col-sm-4">
                                <input id="jamsewa" type="text" class="form-control create-event-demo"
                                       placeholder="Time" value="{{ $sb->JAM_SEWA }}">
                            </div>
                        </div>
                        <div class="form-group row row-sm">
                            <label class="col-sm-3 col-form-label">Selesai Sewa</label>
                            <div class="col-sm-5">
                                <input id="tglakhirsewa" type="text" class="form-control create-event-datepicker"
                                       placeholder="Date" value="{{ $sb->TGL_AKHIR_SEWA }}">
                            </div>
                            <div class="col-sm-4">
                                <input id="jamakhirsewa" type="text" class="form-control create-event-demo"
                                       placeholder="Time" value="{{ $sb->JAM_AKHIR_SEWA }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Lama Sewa</label>
                            <div class="col-sm-9">
                                <div class="avatar-group">
                                    <input id="lamasewa" type="text" class="form-control" 
                                    placeholder="Lama Sewa" value="{{ $sb->LAMA_SEWA }}">
                                </div>
                                <!-- <button type="button" class="btn btn-outline-light btn-sm btn-floating">
                                    <i class="ti-plus"></i>
                                </button> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Harga Sewa</label>
                            <div class="col-sm-9">
                                <input id="hargasewabus" type="text" class="form-control" value="{{ $sb->HARGA_SEWA_BUS }}">
                                <!-- <textarea id="event-desc" class="form-control" rows="6"></textarea> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                            <form class="post0" method="post" action="updateswitch">
                                @csrf
                                    <input type="hidden" name="id" value="{{$sb->ID_SEWA_BUS}}">
                                        @if($ar -> STATUS == 1)
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" checked id="switch{{$sb->ID_SEWA_BUS}}">
                                                <label class="custom-control-label" for="switch{{$sb->ID_SEWA_BUS}}">Berlangsung</label>
                                            </div>
                                        @else 
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch{{$sb->ID_SEWA_BUS}}">
                                                <label class="custom-control-label" for="switch{{$sb->ID_SEWA_BUS}}">Selesai</label>
                                            </div>
                                        @endif
                            </form>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                           <button type="submit" id="btn-save" class="btn btn-primary">Update</button>
                              
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
    <!-- end::Create Event Modal -->

    <!-- begin::Event Info Modal -->
    <div class="modal fade" id="viewEventModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span class="event-icon mr-2"></span>
                        <span class="event-title">Modal Title</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="event-body"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end::Event Info Modal -->

@endsection

@section('script')
<script>

    console.log('x : ')
        const x = document.getElementsByClassName('post0');
            for(let i=0;i<x.length;i++){
                x[i].addEventListener('click',function(){
                    x[i].submit();
                    });
                }

</script>
<!-- Fullcalendar -->
<script src="{{ url('vendors/fullcalendar/moment.min.js') }}"></script>
<script src="{{ url('vendors/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ url('assets/js/examples/fullcalendar.js') }}"></script>

<!-- Clockpicker -->
<script src="{{ url('vendors/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ url('assets/js/examples/clockpicker.js') }}"></script>

<!-- Datepicker -->
<script src="{{ url('vendors/datepicker/daterangepicker.js') }}"></script>
<script src="{{ url('assets/js/examples/datepicker.js') }}"></script>

<script src="{{ url('assets/js/examples/pages/calendar.js') }}"></script>
@endsection
