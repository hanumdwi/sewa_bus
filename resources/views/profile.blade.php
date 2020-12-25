@extends('layouts.app')

@section('content')

@foreach($pengguna as $png)
@endforeach

    <div class="row">
        <div class="col-md-12">

            <div class="profile-container" style="background: url({{ url('assets/media/image/aih1.png') }})">
                <div class="profile-bar">
                    <div class="d-flex align-items-center">
                        <figure class="avatar mr-3">
                            <img src="{{ url('foto_user/'.$png->FOTO) }}" width="350px" height="197px"
                                 class="rounded-circle" alt="">
                        </figure>
                        <div>
                            <h4 class="mb-1">{{Session::get('coba')}}</h4>
                            <small class="opacity-7">{{Session::get('coba1')}}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow-none border">
                                <img src="{{ url('foto_user/'.$png->FOTO) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <!-- <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and
                                        make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                   
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between mb-2">
                                <p class="text-muted mb-0">User</p>
                            </div>
                            <h2>{{$png->ID_PENGGUNA}}</h2>
                            <div><label>&nbsp;</label></div>
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Id User</th>
                                    <th>Nama User</th>
                                    <th>Username</th>
                                    <th>Email User</th>
                                    <th>Telephone User</th>
                                    <th>Alamat User</th>
                                    <th>Password</th>
                                    <th>Job Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach($pengguna as $png)
                                    <!-- <tr class="table-light"> -->
                                    <td>{{ $png -> ID_PENGGUNA }}</td>
                                    <td>{{ $png -> NAMA_PENGGUNA }}</td>
                                    <td>{{ $png -> USERNAME }}</td>
                                    <td>{{ $png -> EMAIL_PENGGUNA }}</td>
                                    <td>{{ $png -> TELEPHONE_PENGGUNA }}</td>
                                    <td>{{ $png -> ALAMAT_PENGGUNA }}</td>
                                    <td>{{ $png -> PASSWORD }}</td>
                                    <td>{{ $png -> JOB_STATUS }}</td>
                                    </tr>
                                    @endforeach
                                    <!-- </tr> -->
                                    </tbody>
                                    <!-- <tfoot>
                                <tr>
                                    <th>Id User</th>
                                    <th>Nama User</th>
                                    <th>Username</th>
                                    <th>Email User</th>
                                    <th>Telephone User</th>
                                    <th>Alamat User</th>
                                    <th>Password</th>
                                    <th>Job Status</th>
                                </tr>
                                </tfoot> -->
                            </table>
                            <div><label>&nbsp;</label></div>
                            <div><label>&nbsp;</label></div>
                            <h2>PT. Medina Dzikra Cemerlang Trans</h2>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-check mr-2 text-primary"></i>JL. Suwoko No. 43 A Lamongan - Jawa Timur.
                                </li>
                                <li><i class="fa fa-check mr-2 text-primary"></i>Telp : (0322) 3101285.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>

@endsection
