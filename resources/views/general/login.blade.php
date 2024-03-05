@extends('layout.base')
@section('title', 'Dashboard')
@php $includeNav = false; @endphp {{-- TRUE TO INCLUDE SIDE NAV BAR TO PAGE --}}
@section('page') {{-- HTML CONTENT GOES IN THIS SECTION --}}

<div class="container-fluid h-100">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="bg-light p-4 border rounded">
            <div class="container-fluid text-center">
                <img src="{{asset('images/dimslogo.png')}}" id="icon" alt="User Icon" width="50" height="50"/>
                <h4 class="fw-bold pb-3 pt-3">DIMS USER MANAGER</h4>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="email" class="form-control" id="username" aria-describedby="usernameHelp">
                <div id="usernameHelp" class="form-text">Please enter your username to log in.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" aria-describedby="passwordHelp">
                <div id="passwordHelp" class="form-text">Please enter your username to log in.</div>
            </div>
            <p id="message">Invalid Credentials</p>
            <button type="submit" class="btn btn-secondary rounded-0 w-100" id="login">Submit</button>
        </div>
    </div>
</div>

@endsection
@section('scripts') {{-- JS CONTENT GOES IN THIS SECTION --}}

<script>
    $(document).ready(function() {
        $('#message').hide();
        
        $('#login').click(function() {
            $.ajax({
                url: '{!!url("/getlogin")!!}',
                type: "GET",
                data: {
                    username: $('#username').val(),
                    password: $('#password').val()
                },
                success: function(data) {
                    window.location = ('{!!url("/")!!}');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $('#username').css('border-color', 'red');
                    $('#password').css('border-color', 'red');
                    $('#message').css('border-color', 'red');
                    $('#message').show();
                    $('#message').css('color', 'red');
                }
            });
        });
    });
</script>

@endsection