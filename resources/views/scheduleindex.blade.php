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
            <h3>Schedule Armada</h3>
            <div>
                <!-- <button class="btn btn-primary" data-toggle="modal"
                        data-target="#createEventModal">
                    <i class="ti-plus mr-2"></i> Create Schedule
                </button> -->
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
                
                    <form autocomplete="off" action="scheduleupdate" method="post">
                    @csrf

                        <div class="form-group row">
                        
                        <label class="col-sm-3 col-form-label">Sewa Category Armada</label>
                        <div class="col-sm-9">
                        <select name="ID_SEWA_CATEGORY" class="form-control" id="ID_SEWA_CATEGORY">
                                    @foreach($sewa_bus_category as $sbc)
                                   
                                    <option value="{{$sbc->ID_SEWA_CATEGORY}}">{{$sbc->NAMA_SEWA_CATEGORY}}</option>
                                   
                                    @endforeach                 
                            </select>
                        </div>
                    </div>

                        <div class="form-group row">
                        
                            <label class="col-sm-3 col-form-label">Sewa Paket</label>
                            <div class="col-sm-9">
                            <select name="ID_SEWA_PAKET" class="form-control" id="ID_SEWA_PAKET">
                                        @foreach($sewa_paket_wisata as $spw)
                                       
                                        <option value="{{$spw->ID_SEWA_PAKET}}">{{$spw->NAMA_SEWA_PAKET}}</option>
                                       
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
                                <input id="TGL_SEWA" type="text" name="TGL_SEWA"
                                       class="form-control create-event-datepicker"
                                       placeholder="Date" value="{{ old('TGL_SEWA_BUS') }}">
                            </div>
                            <div class="col-sm-4">
                                <input id="JAM_SEWA" name="JAM_SEWA" type="text" class="form-control create-event-demo"
                                       placeholder="Time" value="{{ old('JAM_SEWA') }}">
                            </div>
                        </div>
                        <div class="form-group row row-sm">
                            <label class="col-sm-3 col-form-label">Selesai Sewa</label>
                            <div class="col-sm-5">
                                <input id="TGL_AKHIR_SEWA" type="text" name="TGL_AKHIR_SEWA"
                                class="form-control create-event-datepicker"
                                       placeholder="Date" value="{{ old('TGL_AKHIR_SEWA') }}">
                            </div>
                            <div class="col-sm-4">
                                <input id="JAM_AKHIR_SEWA" type="text" name="JAM_AKHIR_SEWA"
                                class="form-control create-event-demo"
                                       placeholder="Time" value="{{ old('JAM_AKHIR_SEWA') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Harga Sewa</label>
                            <div class="col-sm-9">
                                <input id="HARGA_SEWA_BUS" type="text" name="HARGA_SEWA_BUS"
                                class="form-control" value="{{ old('HARGA_SEWA_BUS') }}">
                                <!-- <textarea id="event-desc" class="form-control" rows="6"></textarea> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                            <form class="post0" method="post" action="updateswitch">
                                @csrf
                                    <input type="hidden" name="id" value="{{ old('ID_SEWA_BUS') }}">
                                        @if('STATUS_SEWA' == 1)
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" checked id="switch{{ old('ID_SEWA_BUS') }}">
                                                <label class="custom-control-label" for="switch{{ old('ID_SEWA_BUS') }}">Berlangsung</label>
                                            </div>
                                        @else 
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch{{ old('ID_SEWA_BUS') }}">
                                                <label class="custom-control-label" for="switch{{ old('ID_SEWA_BUS') }}">Selesai</label>
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
