@extends('layouts.app')

@section('title', $title)


@section('content')

    <div class="container-md ">
        <div class="row pengeluaran-container px-5 py-2">
            <div class="col bg-white border-top border-3 border-info px-4 py-4 shadow">
                <form method="POST" action="/finance/expenditure-update/{{$data->finance_id}}">
                    @csrf
                    <input type="hidden" value="pengeluaran" name="pengeluaran_kategori" />
                     <input type="hidden" value="{{$data->finance_id}}" name="finance_id" />
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Sumber Pengeluaran</label>
                        <input class="form-control" name="sumber_pengeluaran" value="{{$data->finance_source}}"/>
                    </div>
                    @if ($errors->has('sumber_pengeluaran'))
                        <p class="text-danger">
                            {{ $errors->first('sumber_pengeluaran') }}
                        </p>
                    @endif
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Deskripsi Pengeluaran</label>
                        <textarea class="form-control" id="floatingTextarea" name="deskripsi_pengeluaran">{{$data->finance_description}}</textarea>
                    </div>
                    @if ($errors->has('deskripsi_pengeluaran'))
                        <p class="text-danger">
                            {{ $errors->first('deskripsi_pengeluaran') }}
                        </p>
                    @endif
                    <label class="form-label">Jumlah Pengeluaran</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" step="any" class="form-control" name="jumlah_pengeluaran" value={{$data->amount_expenditure}} />

                    </div>
                    @if ($errors->has('jumlah_pengeluaran'))
                        <p class="text-danger">
                            {{ $errors->first('jumlah_pengeluaran') }}
                        </p>
                    @endif
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Pengeluaran</label>
                        <input type="date" class="form-control" name="tanggal_pengeluaran" value="{{$data->finance_date}}"/>
                    </div>
                    @if ($errors->has('tanggal_pengeluaran'))
                        <p class="text-danger">
                            {{ $errors->first('tanggal_pengeluaran') }}
                        </p>
                    @endif

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>



    </div>
    
@endSection
