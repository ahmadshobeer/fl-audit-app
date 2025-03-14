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
                    <form class="form-horizontal mt-3 form-material" id="login_form" >
                        @csrf
                        <div class="form-group mb-3">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="username" id="username" placeholder="Username"> 
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" id="password" required="" placeholder="Password"> 
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
                                <button type="submit" class="btn btn-primary btn-info btn-lg btn-block waves-effect waves-light">Login</button>
                                {{-- <a class="btn btn-info btn-lg btn-block waves-effect waves-light" type="submit" href="/">Log In</a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

   
    $(document).on("submit", "#login_form", function (e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "/post-login",
        data: {
            username: $("#username").val(),
            password: $("#password").val(),
            _token: "{{ csrf_token() }}"
        },
        dataType: "json",
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    title: "Berhasil!",
                    text: response.message,
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = response.redirect; // Redirect ke /home
                });
            }
        },
        error: function (xhr) {
            Swal.fire({
                title: "Gagal!",
                text: xhr.responseJSON.message,
                icon: "error"
            });
        }
    });
});
</script>

@endsection