<!DOCTYPE html>
<html lang="en">
  <head>
    @include('inc.head')
    <title class="title">
      @yield('title')
    </title>
  </head>

<body id="body-pd">
    @include('inc.header')
    <div class="l-navbar" id="nav-bar">
      @include('inc.sidebar')
    </div>
    <!--Container Main start-->
    <div id="main-container" class="container height-100 border rounded mb-5">
        @yield('container')
    </div>
    <!--Container Main end-->
    @stack('script')

</body>
</html>