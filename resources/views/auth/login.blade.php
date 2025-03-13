@extends('layouts.auth')

@section('title', 'Login')

@section('main')

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('images/bg2.jpg')}}) no-repeat top center;">
    <div class="auth-box on-sidebar p-4 bg-white m-0">
        <div id="loginform">
            <div class="logo text-center">
                <span class="db">
                    <img src="{{ asset('images/logo_arita.png')}}" alt="logo" width="50%"><br/>
                    <h4>PT. ARITA PRIMA INDONESIA</h4>
                </span>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal mt-3 form-material" id="loginform" action="index.html">
                        <div class="form-group mb-5 mt-4">
                            <div class="col-xs-12">
                                <select class="select2 form-control custom-select select2-hidden-accessible">
                                    <option value="" class="text-center">Admin</option>
                                    <option value="" class="text-center">Karyawan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Username"> 
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" placeholder="Password"> 
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <div class="checkbox checkbox-info float-left pt-0 pl-1 ml-3 mb-3">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> Remember me </label>
                            </div> 
                        </div>
                        <div class="form-group text-center mt-3">
                            <div class="col-xs-12">
                                <a class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" href="/">Log In</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection