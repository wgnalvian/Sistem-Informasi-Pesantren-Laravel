@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    @include('sweetalert::alert')
    <div class="container-md">
        <div class="row px-4 d-flex justify-content-between">
            <div class="col-md-5 bg-white d-flex align-items-center" style="height : 50px; border-top : 2px solid #FF0076">

                <b>Pengguna</b>
            </div>
            <div class="col-md-6 bg-white d-flex align-items-center" style="height : 50px; border-top : 2px solid #FF0076">
                <b>Pesantren</b>

            </div>
        </div>
        <div class="row px-4 d-flex justify-content-between mt-3">

            <div class="col-md-5 bg-white p-3 d-flex flex-column " style="height : 350px">
                <form action="">
                    <fieldset disabled>
                        <label class="align-self-start d-block">Foto Pengguna</label>
                        <img style="width : 150px; " src="/images/{{$data->user_image}}" alt="">

                        <div class="mt-3">
                            <label for="disabledTextInput" class="form-label">Nama Pengguna</label>
                            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{Auth::user()->name}}">
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="col-md-6 bg-white d-flex align-items-center p-3">
                <form action="">
                    <fieldset disabled>
                        <label class="align-self-start d-block">Logo Pesantren</label>
                        <img style="width : 150px; " src="/images/{{$data->school_image}}" alt="">

                        <div class="mt-3">
                            <label for="disabledTextInput" class="form-label">Nama Pesantren</label>
                            <input type="text" id="disabledTextInput" class="form-control"
                                placeholder="{{$data->school_name}}">
                        </div>
                        <div class="mt-3 mb-3">
                            <label for="disabledTextInput" class="form-label">Alamat Pesantren</label>
                            <input type="text" id="disabledTextInput" class="form-control"
                                placeholder="{{$data->school_address}}">
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>

         <div class="row px-4 mt-4" style="height : 70px; margin-bottom: 100px">
            <div class="col border-top  border-2 border-info bg-white w-100 h-100 shadow d-flex align-items-center justify-content-between">
                <h5 class="fw-bold">Edit Data Profile</h5>
               
                
                <a href="/profile/edit"><button type="submit" class="btn btn-lg  fw-bold rounded-3 bg-warning" >Edit</button></a>
                
            </div>
        </div>

    </div>




@endSection
