<!DOCTYPE html>
<html lang="en">
    <head>
        @include('inc.head')
        <title class="title">@yield('title')</title>
    </head>

    <body id="body-pd">
        @include('inc.header')
        <div class="l-navbar" id="nav-bar">
            @include('auditor.sidebar')
        </div>
        <!--Container Main start-->
        <div
            id="main-container"
            class="container border rounded mb-5"
            style="min-height: 100"
        >
            <div class="row mb-2 mt-3 me-2">
                <div class="col d-flex justify-content-end">
                    <a href="" style="text-decoration: none;"><i class="bi bi-person-square me-2"></i><span><b>Auditor/</b></span></a>
                    @yield('linking')
                </div>
            </div>
            @yield('container')
        </div>
        <!--Container Main end-->
        @stack('script')
    </body>
</html>
