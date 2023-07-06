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
            @yield('container')
        </div>
        <!--Container Main end-->
        @stack('script')
    </body>
</html>
