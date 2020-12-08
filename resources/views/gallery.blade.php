@extends('layouts.app')

@section('head')
    <!-- Magnific popup -->
    <link rel="stylesheet" href="{{ url('vendors/lightbox/magnific-popup.css') }}" type="text/css">

@endsection

@section('content')

    <div class="page-header">
        <div class="page-title">
            <h3>Gallery Armada</h3>
        <div>
            <button class="btn btn-primary file-upload-btn" data-toggle="modal" data-target="#import">
                    <i class="ti-upload mr-2"></i> Upload Foto
            </button>
    </div>

     
            <!-- modal -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModal1Label">Tambah Foto Armada</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="ti-close"></i>
                                </button>
                        </div>
                        <div class="modal-body">
                            <form action="uploadgambar" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="nama" class="col-form-label">Platnomor Armada :</label>
                                            <select name="ID_ARMADA" class="form-control" id="ID_ARMADA">
                                                @foreach($armada as $ar)
                                                            
                                                    <option value="{{$ar->ID_ARMADA}}">{{$ar->PLAT_NOMOR}}</option>
                                                            
                                                @endforeach                 
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="DESKRIPSI_FOTO" class="col-form-label">Deskripsi Foto :</label>
                                            <input type="DESKRIPSI_FOTO" class="form-control" id="DESKRIPSI_FOTO" name="DESKRIPSI_FOTO">
                                    </div>
                                    <div class="form-group">
                                        <label>PILIH FILE</label>
                                        <input type="file" name="file" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills gallery-filter mb-4">
                <li class="nav-item">
                    <a href="#" class="nav-link active" data-filter="*">All</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-filter=".webTemplates">Bus Besar</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-filter=".logos">Bus Sedang</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-filter=".drawings">Elf (Mini Bus)</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-filter=".ui">UI Elements</a>
                </li>
            </ul>
            
    
            <div class="gallery-container row">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 drawings mb-4">
                    <a href="{{ url('assets/media/image/photo1.jpg') }}" class="image-popup-gallery-item">
                        <div class="image-hover">
                            <img src="{{ url('assets/media/image/photo1.jpg') }}" class="rounded" alt="image">
                            <div class="image-hover-body rounded">
                                <div>
                                    <h4 class="mb-2">Gallery Item Title</h4>
                                    <div><i class="fa fa-tag mr-2"></i>Web, Logos</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 webTemplates drawings ui mb-4">
                    <a href="{{ url('assets/media/image/photo2.jpg') }}" class="image-popup-gallery-item">
                        <div class="image-hover">
                            <img src="{{ url('assets/media/image/photo2.jpg') }}" class="rounded" alt="image">
                            <div class="image-hover-body rounded">
                                <div>
                                    <h4 class="mb-2">Gallery Item Title</h4>
                                    <div><i class="fa fa-tag mr-2"></i>Web, Logos</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 logos mb-4">
                    <a href="{{ url('assets/media/image/photo3.jpg') }}" class="image-popup-gallery-item">
                        <div class="image-hover">
                            <img src="{{ url('assets/media/image/photo3.jpg') }}" class="rounded" alt="image">
                            <div class="image-hover-body rounded">
                                <div>
                                    <h4 class="mb-2">Gallery Item Title</h4>
                                    <div><i class="fa fa-tag mr-2"></i>Web, Logos</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ui mb-4">
                    <a href="{{ url('assets/media/image/photo4.jpg') }}" class="image-popup-gallery-item">
                        <div class="image-hover">
                            <img src="{{ url('assets/media/image/photo4.jpg') }}" class="rounded" alt="image">
                            <div class="image-hover-body rounded">
                                <div>
                                    <h4 class="mb-2">Gallery Item Title</h4>
                                    <div><i class="fa fa-tag mr-2"></i>Web, Logos</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ui mb-4">
                    <a href="{{ url('assets/media/image/photo5.jpg') }}" class="image-popup-gallery-item">
                        <div class="image-hover">
                            <img src="{{ url('assets/media/image/photo5.jpg') }}" class="rounded" alt="image">
                            <div class="image-hover-body rounded">
                                <div>
                                    <h4 class="mb-2">Gallery Item Title</h4>
                                    <div><i class="fa fa-tag mr-2"></i>Web, Logos</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 drawings mb-4">
                    <a href="{{ url('assets/media/image/photo6.jpg') }}" class="image-popup-gallery-item">
                        <div class="image-hover">
                            <img src="{{ url('assets/media/image/photo6.jpg') }}" class="rounded" alt="image">
                            <div class="image-hover-body rounded">
                                <div>
                                    <h4 class="mb-2">Gallery Item Title</h4>
                                    <div><i class="fa fa-tag mr-2"></i>Web, Logos</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 logos mb-4">
                    <a href="{{ url('assets/media/image/photo7.jpg') }}" class="image-popup-gallery-item">
                        <div class="image-hover">
                            <img src="{{ url('assets/media/image/photo7.jpg') }}" class="rounded" alt="image">
                            <div class="image-hover-body rounded">
                                <div>
                                    <h4 class="mb-2">Gallery Item Title</h4>
                                    <div><i class="fa fa-tag mr-2"></i>Web, Logos</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 webTemplates logos mb-4">
                    <a href="{{ url('assets/media/image/photo8.jpg') }}" class="image-popup-gallery-item">
                        <div class="image-hover">
                            <img src="{{ url('assets/media/image/photo8.jpg') }}" class="rounded" alt="image">
                            <div class="image-hover-body rounded">
                                <div>
                                    <h4 class="mb-2">Gallery Item Title</h4>
                                    <div><i class="fa fa-tag mr-2"></i>Web, Logos</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 logos mb-4">
                    <a href="{{ url('assets/media/image/photo9.jpg') }}" class="image-popup-gallery-item">
                        <div class="image-hover">
                            <img src="{{ url('assets/media/image/photo9.jpg') }}" class="rounded" alt="image">
                            <div class="image-hover-body rounded">
                                <div>
                                    <h4 class="mb-2">Gallery Item Title</h4>
                                    <div><i class="fa fa-tag mr-2"></i>Web, Logos</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <!-- Magnific popup -->
    <script src="{{ url('vendors/lightbox/jquery.magnific-popup.min.js') }}"></script>

    <!-- Isotope -->
    <script src="{{ url('vendors/jquery.isotope.min.js') }}"></script>

    <script src="{{ url('assets/js/examples/pages/gallery.js') }}"></script>

    
    <!-- File manager example -->
    <script src="{{ url('assets/js/examples/file-manager.js') }}"></script>

  
    
@endsection
