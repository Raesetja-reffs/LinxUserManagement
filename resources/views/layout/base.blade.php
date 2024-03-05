<!doctype html>
<html lang="en">
	<head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', 'Linx User Manager')</title>
        <link rel="icon" href="{{asset('images/dimslogo.png')}}" type="image/icon type">
        <link rel="stylesheet" href="{{asset('css/colors.css')}}">
    
        <!-- Bootstrap CSS  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Select2 CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Bootstrap Select2 Theme CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- DevExtreme theme Light-->
        <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/20.2.13/css/dx.material.blue.light.compact.css">

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Box Icons -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <style>
            .dx-datagrid .dx-link {
                color: var(--lum-blue) !important;
            }
    
            .dx-pager .dx-page-sizes .dx-selection, .dx-pager .dx-pages .dx-selection {
                background-color: var(--lum-blue) !important;
                color: var(--lum-light);
            }
    
            .dx-button-mode-text.dx-button-default {
                color: var(--lum-blue) !important;
            }
    
            .dx-datagrid-filter-panel .dx-datagrid-filter-panel-clear-filter, .dx-datagrid-filter-panel .dx-datagrid-filter-panel-text {
                color: var(--lum-blue) !important;
            }
    
            .dx-datagrid-filter-panel .dx-icon-filter {
                color: var(--lum-blue) !important;
            }
    
            .dx-checkbox-checked .dx-checkbox-icon {
                color: var(--lum-light);
                background-color: var(--lum-blue) !important;
            }
    
            .dx-checkbox-indeterminate .dx-checkbox-icon {
                color: var(--lum-light);
                background-color: var(--lum-blue) !important;
            }

            .bg-lum-blue{
                color: var(--lum-light);
                background-color: var(--lum-blue) !important;
            }

            .text-lum-blue{
                color: var(--lum-blue);
            }

            .text-lum-yellow{
                color: var(--lum-yellow);
            }

            #overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent dark background */
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999; /* Ensure it's above other content */
                color: white;
            }

            :root {
                --point-color: White;
                --size: 5px;
            }

            .loader {
                background-color: var(--main-color);
                overflow: hidden;
                width: 100%;
                height: 100%;
                position: fixed;
                top: 0; left: 0;
                display: flex;
                align-items: center;
                align-content: center; 
                justify-content: center;  
                z-index: 100000;
            }

            .loader__element {
                border-radius: 100%;
                border: var(--size) solid var(--point-color);
                margin: calc(var(--size)*1);
            }

            .loader__element:nth-child(1) {
                animation: preloader .6s ease-in-out alternate infinite;
            }
            .loader__element:nth-child(2) {
                animation: preloader .6s ease-in-out alternate .2s infinite;
            }

            .loader__element:nth-child(3) {
                animation: preloader .6s ease-in-out alternate .4s infinite;
            }

            @keyframes preloader {
                100% { transform: scale(1.3); }
            }


            /* Nav styling */

            .sidebar {
                position: absolute;
                top: 0;
                left: 0;
                height: 100vh;
                width: 80px;
                background-color: var(--lum-dark);
                padding: 0.4rem, 0.8rem;
                transition: all 0.5s ease;
            }

            .sidebar.active ~ .main-content {
                left: 300px;
                width: calc(100% - 300px);
            }

            .sidebar.active {
                width: 300px;
            }

            .sidebar #btnNav {
                position: absolute;
                color: white;
                top: 1rem;
                left:  50%;
                font-size: 1.8rem;
                line-height: 50px;
                transform: translate(-50%);
                cursor: pointer;
            }

            .sidebar.active #btnNav {
                left: 90%;
            }

            .sidebar .top .logo{
                color: white;
                display: flex;
                height: 50px;
                width: 100%;
                align-items: center;
                pointer-events: none;
                opacity: 0;
            }

            .sidebar.active .top .logo {
                opacity: 1;
            }

            .top .logo i {
                font-size: 2rem;
                margin-right: 5px;
            }

            .sidebar ul li {
                position: relative;
                list-style-type: none;
                height: 50px;
                width: 90%;
                margin:0.8rem auto;
                line-height: 50px;
            }

            .sidebar ul li a {
                color: white;
                display: flex;
                align-items: center;
                text-decoration: none;
                border-radius: 0.8rem;
            }

            /* .sidebar ul li a:hover {
                background-color: white;
                color: var(--lum-blue);
            }

            .sidebar.active ul li a:hover {
                background-color: white;
                color: var(--lum-blue);
            } */

            .sidebar ul li a i {
                min-width: 70px;
                text-align: center;
                height: 50px;
                font-size: 1.4rem;
                border-radius: 12px;
                line-height: 50px;
            }

            .sidebar .nav-item {
                opacity: 0;
            }

            .sidebar.active .nav-item {
                opacity: 1;
            }

            .sidebar ul li .tooltip {
                position: absolute;
                left: 125px;
                top: 50%;
                transform: translate(-50%, -50%);
                box-shadow: 0 0.5rem 0.8rem rgba(0, 0, 0, 0.2);
                border-radius: 0.6rem;
                padding: 0.4rem 1.2rem;
                line-height: 1.8rem;
                z-index: 20;
                opacity: 0;
            }

            .sidebar ul li:hover .tooltip {
                opacity: 1;
            }

            .sidebar.active ul li .tooltip {
                display: none;
            }

            .main-content {
                position: relative;
                background: white;
                min-height: 100vh;
                left: 80px;
                top: 0;
                transition: all 0.5s ease;
                width: calc(100% - 80px);
                padding: 1rem;
            }
            
        </style>

	</head>
	<body class="d-flex flex-column vh-100">
        <div id="overlay" hidden>
            <div class="loader d-flex">
                <span class="loader__element"></span>
                <span class="loader__element"></span>
                <span class="loader__element"></span>
                {{-- <h1><i class="fa fa- px-2"></i></h1> --}}
            </div>
        </div>

        @if(isset($includeNav) && $includeNav)
            @include('layout.nav')
            <div class="main-content">
                @yield('page')
            </div>
        @else
            <div class="main-content w-100" style="left: 0;">
                @yield('page')
            </div>
        @endif

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <!-- Jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- DevExtreme library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/devextreme/20.2.13/js/dx.all.js"></script>

        <!-- Select 2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- Excel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js" integrity="sha512-dlPw+ytv/6JyepmelABrgeYgHI0O+frEwgfnPdXDTOIZz+eDgfW07QXG02/O8COfivBdGNINy+Vex+lYmJ5rxw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- File Saver -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js" integrity="sha512-Qlv6VSKh1gDKGoJbnyA5RMXYcvnpIqhO++MhIM2fStMcGT9i2T//tSwYFlcyoRRDcDZ+TYHpH8azBBCyhpSeqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('focus', ':input', function() {
                $(this).attr('autocomplete', 'off');
            });
            $(document).ready(function() {
                $('#logout').click(function() {
                    $.ajax({
                        url: '{!!url("/endsession")!!}',
                        type: "GET",
                        data: {
        
                        },
                        success: function(data) {
                            window.location = ('{!!url("/login")!!}');
                        },
                    });
                });

                $('#btnNav').click(function() {
                    $(".sidebar").toggleClass("active");
                })
            });

        </script>

        @yield('scripts')

        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert(msg);
            }

        </script>

    </body>
</html>