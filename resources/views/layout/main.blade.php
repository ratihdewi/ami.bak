<!DOCTYPE html>
<html lang="en">
    <head>
        @include('inc.head')
        <title class="title">@yield('title')</title>
    </head>

    <body id="body-pd">
        <div id="wrapper" class="d-flex">
            <div class="l-navbar show" id="nav-bar">@include('inc.sidebar')</div>
            <div id="content" class="w-100 mt-5 pt-3">
                @include('inc.header')
                <div class="container">
                    <div
                        id="main-container"
                        class="container border rounded mb-5"
                        style="min-height: 100"
                    >   
                        <div class="row mb-2 mt-3 me-2" style="font-size: 14px">
                            <div class="col d-flex justify-content-end">
                                @if (Auth::user()->peran == 'user')
                                    <a href="" style="text-decoration: none;"><i class="bi bi-person-square me-2"></i><span><b>User/</b></span></a>
                                @elseif (Auth::user()->peran == 'spm')
                                    <a href="" style="text-decoration: none;">
                                        <i class="bi bi-person-square me-2 h87"></i><span><b>SPM</b></span>
                                    </a>/
                                @endif
                                @yield('linking')
                            </div>
                        </div>
                        @yield('container')
                    </div>
                </div>
            </div>
        </div>

        @stack('script')
    </body>

    {{-- <body id="body-pd">
        @include('inc.header')
        <div class="l-navbar show" id="nav-bar">@include('inc.sidebar')</div>
        <!--Container Main start-->
        <div class="container">
            <div
                id="main-container"
                class="container border rounded mb-5"
                style="min-height: 100"
            >   
                <div class="row mb-2 mt-3 me-2" style="font-size: 14px">
                    <div class="col d-flex justify-content-end">
                        @if (Auth::user()->peran == 'user')
                            <a href="" style="text-decoration: none;"><i class="bi bi-person-square me-2"></i><span><b>User/</b></span></a>
                        @elseif (Auth::user()->peran == 'spm')
                            <a href="" style="text-decoration: none;">
                                <i class="bi bi-person-square me-2 h87"></i><span><b>SPM</b></span>
                            </a>/
                        @endif
                        @yield('linking')
                    </div>
                </div>
                @yield('container')
            </div>
        </div>
        
        <!--Container Main end-->
        @stack('script')
    </body> --}}
</html>
