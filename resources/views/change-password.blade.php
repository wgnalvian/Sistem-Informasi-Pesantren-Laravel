@extends('layouts.app')
@section('title', 'Change Password')
@section('content')
    @include('sweetalert::alert')
    <div class="container-md">
        <div class="row px-4 d-flex justify-content-between">
            <div class="col-md-5 bg-white d-flex align-items-center" style="height : 50px; border-top : 2px solid #00FFFF">

                <b>Change Password</b>
            </div>

        </div>
        <div class="row px-4 d-flex justify-content-between mt-3">

            <div class="col-md-5 bg-white p-3 d-flex flex-column " style="height : 350px">
                <form action="/handle-change-password" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">Old Password</label>
                        <input type="password" name="oldPassword"class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                      @if ($errors->has('oldPassword'))
                        <p class="text-danger">
                            {{ $errors->first('oldPassword') }}
                        </p>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="password" class="form-control" name="newPassword" id="exampleInputPassword1" placeholder="Password">
                    </div>
                     @if ($errors->has('newPassword'))
                        <p class="text-danger">
                            {{ $errors->first('newPassword') }}
                        </p>
                    @endif
                    <button class="btn text-white " type="submit" style="background-color : #2EFF69 ; font-weight : bold">submit</button>
                </form>
            </div>

        </div>

       
        

    </div>




@endSection
