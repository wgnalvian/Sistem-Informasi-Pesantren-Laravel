@extends('layouts.app')

@section('title', $title)


@section('content')

    <div class="container-md  ">
        <div class="row px-3 pt-2">
            <div class="col-md-5 ">
                <form action="/finance/search" method="POST">
                    @csrf
                    <div class="row ">

                        <div class="col-md-4  ">
                            <select class="form-select " aria-label="Default select example" name="bulan">
                                <option selected value=''>...Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                        <select name="tahun" id="" class="form-select ">
                         <option selected value=''>...Tahun</option>
                         @for ($min = $minTahun; $min <  $maxTahun + 1; $min++)
                             <option value="{{$min}}">{{$min}}</option>
                         @endfor
                        </select>
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn  rounded-3" style="background-color : #00F29D">Cari</button>
                        </div>

                    </div>
                </form>




            </div>
        </div>

        <div class="row px-4 pt-4 ">
            <div class="col bg-white  shadow p-0">
                <div class="table-responsive w-100">

                    <table class="table w-100 ">

                        <tbody>
                            <tr class="" style="background-color : #51F7F9">

                                <th class="text-center" scope="col">Tanggal</th>
                                <th class="text-center" scope="col">Kategori</th>
                                <th class="text-center" scope="col">Sumber</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Pemasukan</th>

                                <th class="text-center" scope="col">Pengeluaran</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                            @foreach ($data as $item)
                                <tr>
                                    @if ($item->finance_category == 'pemasukan')

                                        <td class="text-center">{{ $item->finance_date }}</td>
                                        <td class="text-center">{{ $item->finance_category }}</td>
                                        <td class="text-center">{{ $item->finance_source }}</td>
                                        <td class="text-center">{{ $item->finance_description }}</td>
                                        <td class="text-center">Rp. {{ $item->amount_income }}</td>
                                        <td class="text-center"> - </td>
                                        <td class="text-center"><a href="/finance/update/{{ $item->finance_id }}"><button  class="btn btn-sm  text-dark rounded-3" style="background-color : #F5FF07">edit</button></a>

                                            <form action="/finance/delete/{{ $item->finance_id }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm text-whtie rounded-3" style="background-color: #FF0000; color : white" type="submit">delete</button>

                                            </form>

                                        </td>


                                    @endIf
                                    @if ($item->finance_category == 'pengeluaran')

                                        <td class="text-center">{{ $item->finance_date }}</td>
                                        <td class="text-center">{{ $item->finance_category }}</td>
                                        <td class="text-center">{{ $item->finance_source }}</td>
                                        <td class="text-center">{{ $item->finance_description }}</td>
                                        <td class="text-center"> - </td>
                                        <td class="text-center">Rp. {{ $item->amount_expenditure }}</td>
                                        <td class="text-center"><a
                                                href="/finance/update/{{ $item->finance_id }}">
                                               <button  class="btn btn-sm  text-dark rounded-3" style="background-color : #F5FF07">edit</button>
                                                    
                                                    </a>
                                            <form action="/finance/delete/{{ $item->finance_id }}" method="POST">
                                                @csrf
                                                 <button class="btn btn-sm text-whtie rounded-3" style="background-color: #FF0000; color : white" type="submit">delete</button>

                                            </form>

                                        </td>


                                    @endIf

                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="5">
                                </td>
                                <td><b>Total Pemasukan</b></td>
                                <td><b>Rp. {{ number_format($income) }}</b></td>

                            </tr>
                            <tr>
                                <td colspan="5">
                                </td>
                                <td><b>Total Pengeluaran</b></td>
                                <td><b>Rp. {{ number_format($expenditure) }}</b></td>

                            </tr>
                            <tr>
                                <td colspan="5">
                                </td>
                                <td><b>Total Keuangan</b></td>
                                <td><b>Rp. {{ number_format($total) }}</b></td>

                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>


        </div>
<div class="badge text-wrap mt-4 ml-3" style="width: 6rem; background-color : #FF4281">
            Cetak Data 
        </div>
        <div class="row mt-2">
            <div class="col">
            </div>
        </div>

        

        <div class="row px-4" style="height : 100px; margin-bottom: 100px">
            <div class="col border-top  border-2 border-info bg-white w-100 h-100 shadow d-flex align-items-center justify-content-between">
                <h4 class="fw-bold">Cetak Data Keuangan</h4>
                <form action="/finance/pdf" method="POST">
                @csrf
                
                <button type="submit" class="btn btn-lg text-white fw-bold rounded-3" style="background-color : #6E00FF">Cetak</button>
                </form>
            </div>
        </div>

    </div>

@endSection
