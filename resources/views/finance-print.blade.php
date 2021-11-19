<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <div class="row" style="border-bottom : 2px solid black">
        <div class="col d-flex align-items-center justify-content-evenly" style="height : 150px">
            <img style="height : 80px ; width :  80px"
                src="{{$_SERVER['DOCUMENT_ROOT']}}/images/{{$school_image}}"
                >
            
                <h1 style="margin-left : 8rem">{{$school_name}}</h1>


            
        </div>
            
                <p style="margin-left : 9rem; position : absolute; top : 3rem">{{$school_address}}</p>
    </div>
    
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
