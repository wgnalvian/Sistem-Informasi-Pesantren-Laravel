@extends('layouts.app')

@section('title', 'Data Santri')


@section('content')

    <div class="container-md  ">
        <div class="row px-3 pt-2">
            <div class="col-md-12 ">
              




            </div>
        </div>


        <div class="row px-4 pt-4 ">
            <div class="col bg-white  shadow p-0">
                <div class="table-responsive w-100">

                    <table class="table w-100 ">
                        <?php
                        $aktif = 0;
                        $keluar = 0; ?>
                        <tbody>
                            <tr class="" style=" background-color : #00F29D">


                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Alamat</th>
                                <th class="text-center" scope="col">Wali</th>
                                <th class="text-center" scope="col">No. Telp</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Aksi</th>

                            </tr>

                            @foreach ($data as $item)
                                <tr>

                                    <td class="text-center" scope="col">{{ $item->student_name }}</td>
                                    <td class="text-center" scope="col">{{ $item->student_address }}</td>
                                    <td class="text-center" scope="col">{{ $item->student_guardian }}</td>
                                    <td class="text-center" scope="col">{{ $item->student_phone }}</td>
                                    <td class="text-center" scope="col">
                                        {{ $item->student_date_out ? 'keluar' : 'aktif' }}</td>
                                    <?php
                                    if ($item->student_date_out) {
                                        $keluar += 1;
                                    } else {
                                        $aktif += 1;
                                    }
                                    
                                    ?>
                                    <td class="text-center d-flex justify-content-center" scope="col">
                                        <div class="d-flex">
                                            <button class="badge rounded-pill bg-info border-0" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $item->student_id }}">detail</button>
                                            <form action="/santri/delete/{{ $item->student_id }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="badge rounded-pill bg-danger border-0">delete</button>
                                            </form> <button class="badge rounded-pill bg-warning border-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->student_id }}">edit</button>
                                        </div>



                                </tr>
                                <div class="modal fade" id="exampleModal{{ $item->student_id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Santri</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <fieldset disabled>

                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label d-block">Foto
                                                            Santri
                                                        </label>
                                                        <img src="/images/{{ $item->student_image }}" alt=""
                                                            style="width: 100px;">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">Nama
                                                        </label>
                                                        <input type="text" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">Alamat
                                                        </label>
                                                        <input type="text" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_address }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">Wali
                                                        </label>
                                                        <input type="text" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_guardian }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">No telp
                                                        </label>
                                                        <input type="text" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_phone }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">Tanggal Masuk
                                                        </label>
                                                        <input type="text" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_date_entry }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">Tanggal Keluar
                                                        </label>
                                                        <input type="text" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_date_out }}">
                                                    </div>

                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="editModal{{ $item->student_id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <form action="/santri/update/{{ $item->student_id }}" enctype='multipart/form-data'
                                        method="POST">
                                        @csrf
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Santri</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">


                                                    <div style="position : relative;width : 150px; height : 150px; ">
                                                        <label for="exampleInputEmail1" class="form-label d-block">Foto
                                                            Santri</label>
                                                        <img class="student_image"
                                                            style=" position :absolute ;  height : 100% "
                                                            src="/images/{{ $item->student_image }}" alt="">
                                                        <input class="student_image_input" type="file" name="student_image"
                                                            style="opacity : 0; width : 150px ; height : 150px; z-index : 1 ">
                                                    </div>
                                                    @if ($errors->has('student_image'))
                                                        <p class="text-danger">
                                                            {{ $errors->first('student_image') }}
                                                        </p>
                                                    @endif
                                                    <div class="mb-3 mt-5">
                                                        <label for="disabledTextInput" class="form-label">Nama
                                                        </label>
                                                        <input type="text" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_name }}" name="student_name">
                                                    </div>
                                                    @if ($errors->has('student_name'))
                                                        <p class="text-danger">
                                                            {{ $errors->first('student_name') }}
                                                        </p>
                                                    @endif
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">Alamat
                                                        </label>
                                                        <input type="text" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_address }}" name="student_address">
                                                    </div>
                                                    @if ($errors->has('student_address'))
                                                        <p class="text-danger">
                                                            {{ $errors->first('student_address') }}
                                                        </p>
                                                    @endif
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">Wali
                                                        </label>
                                                        <input type="text" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_guardian }}"
                                                            name="student_guardian">
                                                    </div>
                                                    @if ($errors->has('student_guardian'))
                                                        <p class="text-danger">
                                                            {{ $errors->first('student_guardian') }}
                                                        </p>
                                                    @endif
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">No telp
                                                        </label>
                                                        <input type="text" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_phone }}" name="student_phone">
                                                    </div>
                                                    @if ($errors->has('student_phone'))
                                                        <p class="text-danger">
                                                            {{ $errors->first('student_phone') }}
                                                        </p>
                                                    @endif
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">Tanggal Masuk
                                                        </label>
                                                        <input type="text" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_date_entry }}"
                                                            name="student_date_entry">
                                                    </div>
                                                    @if ($errors->has('student_date_entry'))
                                                        <p class="text-danger">
                                                            {{ $errors->first('student_date_entry') }}
                                                        </p>
                                                    @endif
                                                    <div class="mb-3">
                                                        <label for="disabledTextInput" class="form-label">Tanggal Keluar
                                                        </label>
                                                        <input type="date" id="disabledTextInput" class="form-control"
                                                            value="{{ $item->student_date_out }}"
                                                            name="student_date_out">
                                                    </div>
                                                    @if ($errors->has('student_date_out'))
                                                        <p class="text-danger">
                                                            {{ $errors->first('student_date_out') }}
                                                        </p>
                                                    @endif

                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-end"><b>Jumlah Santri</b></td>
                                <td class="text-center">{{ count($data) }}</td>

                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-end"><b>Jumlah Santri Aktif</b></td>
                                <td class="text-center">{{ $aktif }}</td>

                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-end"><b>Jumlah Santri Keluar</b></td>
                                <td class="text-center">{{ $keluar }}</td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>


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
