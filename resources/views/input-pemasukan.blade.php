@extends('layouts.app')

@section('title', $title)


@section('content')

    <div class="container-md ">
        <div class="row pemasukan-container px-5 py-2">
            <div class="col bg-white border-top border-3 border-info px-4 py-4 shadow">
                <form method="POST" action="{{ route('handleInputIncome') }}">
                    @csrf
                    <input type="hidden" value="pemasukan" name="pemasukan_kategori" />
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Sumber Pemasukan</label>
                        <input class="form-control" name="sumber_pemasukan" />
                    </div>
                    @if ($errors->has('sumber_pemasukan'))
                        <p class="text-danger">
                            {{ $errors->first('sumber_pemasukan') }}
                        </p>
                    @endif
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Deskripsi Pemasukan</label>
                        <textarea class="form-control" id="floatingTextarea" name="deskripsi_pemasukan"></textarea>
                    </div>
                    @if ($errors->has('deskripsi_pemasukan'))
                        <p class="text-danger">
                            {{ $errors->first('deskripsi_pemasukan') }}
                        </p>
                    @endif
                    <label class="form-label">Jumlah Pemasukan</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" step="any" class="form-control" name="jumlah_pemasukan" />

                    </div>
                    @if ($errors->has('jumlah_pemasukan'))
                        <p class="text-danger">
                            {{ $errors->first('jumlah_pemasukan') }}
                        </p>
                    @endif
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Pemasukan</label>
                        <input type="date" class="form-control" name="tanggal_pemasukan" />
                    </div>
                    @if ($errors->has('tanggal_pemasukan'))
                        <p class="text-danger">
                            {{ $errors->first('tanggal_pemasukan') }}
                        </p>
                    @endif

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>



    </div>
    
@endSection
