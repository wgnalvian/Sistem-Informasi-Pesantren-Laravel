@extends('layouts.app')

@section('title', 'Tambah Santri')


@section('content')

    <div class="container-md ">
        <div class="row pemasukan-container px-5 py-2">
            <div class="col bg-white border-top border-3 border-info px-4 py-4 shadow">
                <form method="POST" action="/santri/handleCreate" enctype="multipart/form-data">
                    @csrf

                    <div style="position : relative;width : 150px; height : 150px; ">
                        <label for="exampleInputEmail1" class="form-label d-block">Foto Santri</label>
                        <img class="student_image" style=" position :absolute ;  height : 100% " src="/images/default.jpg"
                            alt="">
                        <input class="student_image_input" type="file" name="student_image"
                            style="opacity : 0; width : 150px ; height : 150px; z-index : 1 ">
                    </div>
                    @if ($errors->has('student_image'))
                        <p class="text-danger">
                            {{ $errors->first('student_image') }}
                        </p>
                    @endif

                    <div class="mb-3 mt-5">
                        <label for="exampleInputEmail1" class="form-label">Nama Santri</label>
                        <input class="form-control" name="student_name" />
                    </div>
                    @if ($errors->has('student_name'))
                        <p class="text-danger">
                            {{ $errors->first('student_name') }}
                        </p>
                    @endif
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat Santri</label>
                        <textarea class="form-control" id="floatingTextarea" name="student_address"></textarea>
                    </div>
                    @if ($errors->has('student_address'))
                        <p class="text-danger">
                            {{ $errors->first('student_address') }}
                        </p>
                    @endif
                    <label class="form-label">Wali Santri</label>
                    <div class="input-group mb-3">

                        <input type="text" step="any" class="form-control" name="student_guardian" />

                    </div>
                    @if ($errors->has('student_guardian'))
                        <p class="text-danger">
                            {{ $errors->first('student_guardian') }}
                        </p>
                    @endif
                    <label class="form-label">Nomer Telepon</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">+62</span>
                        <input type="number" step="any" class="form-control" name="phone" />

                    </div>
                    @if ($errors->has('student_guardian'))
                        <p class="text-danger">
                            {{ $errors->first('student_guardian') }}
                        </p>
                    @endif
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="student_date_entry" />
                    </div>
                    @if ($errors->has('student_date_entry'))
                        <p class="text-danger">
                            {{ $errors->first('student_date_entry') }}
                        </p>
                    @endif

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>



    </div>

    <script>
        let studentImageInput = document.querySelector('.student_image_input');
        let studentImage = document.querySelector('.student_image');

         studentImageInput.addEventListener('change', (e) => {
            let image = URL.createObjectURL(e.target.files[0]);
            studentImage.src = image;
        })
    </script>

@endSection
