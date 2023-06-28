<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!--fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!--//fonts-->
    <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('link-css')
    <!--theme-style-->
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    @stack('css')

</head>
<body>
    @include('frontend.layouts._header')
    <div class="container">
        @yield('content')
        @include('frontend.layouts._sidebar')
    </div>
    @include('frontend.layouts._footer')


    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    @stack('link-js')
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--initiate accordion-->
    <script type="text/javascript">
        $(function () {
            var menu_ul = $(".menu > li > ul"),
                menu_a = $(".menu > li > a");
            menu_ul.hide();
            menu_a.click(function (e) {
                e.preventDefault();
                if (!$(this).hasClass("active")) {
                    menu_a.removeClass("active");
                    menu_ul.filter(":visible").slideUp("normal");
                    $(this).addClass("active").next().stop(true, true).slideDown("normal");
                } else {
                    $(this).removeClass("active");
                    $(this).next().stop(true, true).slideUp("normal");
                }
            });
        });
    </script>
    @stack('js')
</body>
</html>
