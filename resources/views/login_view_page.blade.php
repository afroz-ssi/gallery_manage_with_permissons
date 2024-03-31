{{-- @extends('layouts.top_header')
@section('title', 'Admin & User Login Page') --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin & User Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="shadow-sm row">
        <div class="col-md-3"> </div>
        <div class="col-md-6">
            <!-- Login  content -->
            <main class="p-4 min-vh-100">
                <div class="jumbotron jumbotron-fluid rounded bg-white border-0 shadow-sm border-left px-4">
                    <div class="container pb-5">
                        <h1 class="display-4 mb-2 text-center text-primary">Admin & User Login</h1>
                        <form method="POST" id="multiLoginForm" action="{{ route('multi_login') }}">
                            @csrf
                            <h6 class="text-success text-center mb-2" id="msg"></h6>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="text" name="email" id="email"
                                    placeholder="Email">
                                <small class="text-danger error-text email_error" id="email_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input class="form-control" type="password" name="pass" id="password"
                                    placeholder="Password">
                                <small class="text-danger error-text password_error" id="password_error"></small>
                            </div>
                            <br>

                            <h6 class="text-danger text-center mb-3" id="msg_err"></h6>
                            <div class="form-group">
                                <button class="btn btn-success btn-lg" type="submit" id="std_login">Submit</button>
                            </div>

                        </form>
                    </div>
            </main>
        </div>
        <div class="col-md-3"></div>


    </div>
    <div class="col-md-12 col-lg-8 ml-md-auto px-0 ms-md-auto">



    </div>
    @extends('layouts.footer')
