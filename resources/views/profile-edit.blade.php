@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    <form action="/profile/update" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-md">
            <div class="row px-4 d-flex justify-content-between">
                <div class="col-md-5 bg-white d-flex align-items-center"
                    style="height : 50px; border-top : 2px solid #FF0076">

                    <b>Pengguna</b>
                </div>
                <div class="col-md-6 bg-white d-flex align-items-center"
                    style="height : 50px; border-top : 2px solid #FF0076">
                    <b>Pesantren</b>

                </div>
            </div>
            <div class="row px-4 d-flex justify-content-between mt-3">




                <div class="col-md-5 bg-white p-3 d-flex flex-column " style="height : 350px">
                    <label class="align-self-start d-block">Foto Pengguna</label>
                    <div style="position : relative;width : 150px; height : 150px; ">
                        <img class="user_image" style=" position :absolute ;  height : 100% "
                            src="/images/{{ $data->user_image }}" alt="">
                        <input class="user_image_input" type="file" name="user_image"
                            style="opacity : 0; width : 150px ; height : 150px; z-index : 1 ">
                    </div>
                    @if ($errors->has('user_image'))
                        <p class="text-danger">
                            {{ $errors->first('user_image') }}
                        </p>
                    @endif

                    <div class="mt-3">
                        <label for="disabledTextInput" class="form-label">Nama Pengguna</label>
                        <input type="text" name="username" class="form-control" value="{{ Auth::user()->name }}">
                    </div>
                    @if ($errors->has('username'))
                        <p class="text-danger">
                            {{ $errors->first('username') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-6 bg-white d-flex flex-column  p-3">

                    <label class="align-self-start d-block">Logo Pesantren</label>
                    <div style="position : relative;width : 150px; height : 150px; ">
                        <img class="school_image" style=" position :absolute ;  height : 100% "
                            src="/images/{{ $data->school_image }}" alt="">
                        <input class="school_image_input" type="file" name="school_image"
                            style="opacity : 0; width : 150px ; height : 150px; z-index : 1 ">
                    </div>
                    @if ($errors->has('school_image'))
                        <p class="text-danger">
                            {{ $errors->first('school_image') }}
                        </p>
                    @endif


                    <div class="mt-3">
                        <label for="disabledTextInput" class="form-label">Nama Pesantren</label>
                        <input type="text" id="disabledTextInput" class="form-control" value="{{ $data->school_name }}"
                            name="school_name">
                    </div>
                    @if ($errors->has('school_name'))
                        <p class="text-danger">
                            {{ $errors->first('school_name') }}
                        </p>
                    @endif
                    <div class="mt-3 mb-3">
                        <label for="disabledTextInput" class="form-label">Alamat Pesantren</label>
                        <input type="text" id="disabledTextInput" class="form-control"
                            value="{{ $data->school_address }}" name="school_address">
                    </div>
                    @if ($errors->has('school_address'))
                        <p class="text-danger">
                            {{ $errors->first('school_address') }}
                        </p>
                    @endif
                </div>

            </div>

            <div class="row px-4 mt-4" style="height : 70px; margin-bottom: 100px">
                <div
                    class="col border-top  border-2 border-info bg-white w-100 h-100 shadow d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold">Submit</h5>


                    <button type="submit" class="btn btn-lg  fw-bold rounded-3 bg-warning">Submit</button>

                </div>
            </div>

        </div>
    </form>


    <script>
        let schoolImageInput = document.querySelector('.school_image_input');
        let schoolImage = document.querySelector('.school_image');
        let userImageInput = document.querySelector('.user_image_input');
        let userImage = document.querySelector('.user_image');

        schoolImageInput.addEventListener('change', (e) => {
            let image = URL.createObjectURL(e.target.files[0]);
            schoolImage.src = image;
        })
        userImageInput.addEventListener('change', (e) => {
            let image = URL.createObjectURL(e.target.files[0]);
            userImage.src = image;
        })
    </script>

@endSection
