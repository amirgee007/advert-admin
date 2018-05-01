<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ========== Css Files ========== -->
    <link href="{{asset("/public/css/root.css")}}"  rel="stylesheet" type="text/css" >
    <link href="{{asset("/public/css/nv.d3.min.css")}}"  rel="stylesheet" type="text/css" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
</head>
<body>
<!-- Start Page Loading -->
<div class="loading"><img src="{{asset("/public/img/loading.gif")}}" alt="loading-img"></div>
<!-- End Page Loading -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START TOP -->
<div id="top" class="clearfix">

    <!-- Start App Logo -->
    <div class="applogo" >
        <a href="/"  class="logo"><img style="width: 250px;height: 50px; margin-top: -15px;margin-left: 5px" src="{{asset("/public/img/logo.png")}}"> </a>
    </div>
    <!-- End App Logo -->

    <!-- Start Sidebar Show Hide Button -->
    <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <!-- End Sidebar Show Hide Button -->


    <!-- Start Top Right-->
    <ul class="top-right">

        <li class="dropdown link">
            <!--<a href="#" data-toggle="dropdown" class="dropdown-toggle hdbutton">Create New <span class="caret"></span></a>-->
            <ul class="dropdown-menu dropdown-menu-list">
                <li><a href="#"><i class="fa falist fa-paper-plane-o"></i>Product or Item</a></li>
                <li><a href="#"><i class="fa falist fa-font"></i>Blog Post</a></li>
                <li><a href="#"><i class="fa falist fa-file-image-o"></i>Image Gallery</a></li>
                <li><a href="#"><i class="fa falist fa-file-video-o"></i>Video Gallery</a></li>
            </ul>
        </li>


        <li class="dropdown link">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><img src="{{asset("public/img/profileimg.png")}}" alt="img"><b>{{auth()->user()->name}}</b><span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
                <li role="presentation" class="dropdown-header">Profile</li>
                <li><a href="#"><i class="fa falist fa-inbox"></i>Tickets{{--<span class="badge label-danger">4</span>--}}</a></li>
                <li><a href="#"><i class="fa falist fa-wrench"></i>Settings</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa falist fa-lock"></i> Lockscreen</a></li>
                <li> <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa falist fa-power-off"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form></li>
            </ul>
        </li>

    </ul>
    <!-- End Top Right -->

</div>
<!-- END TOP -->
<!-- //////////////////////////////////////////////////////////////////////////// -->


<!-- //////////////////////////////////////////////////////////////////////////// -->


@include('layouts.sidebar')

<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START CONTENT -->
<div class="content">
    @yield('content')
</div>
<!-- End Content -->
<!-- //////////////////////////////////////////////////////////////////////////// -->


<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="{{asset("/public/js/jquery.min.js")}}"></script>

<!-- ================================================
Bootstrap Core JavaScript File
================================================ -->
<script src="{{asset("/public/js/bootstrap/bootstrap.min.js")}}"></script>

<!-- ================================================
Plugin.js - Some Specific JS codes for Plugin Settings
================================================ -->
<script type="text/javascript" src="{{asset("/public/js/plugins.js")}}"></script>

<!-- ================================================
Bootstrap Select
================================================ -->
<script type="text/javascript" src="{{asset("/public/js/bootstrap-select/bootstrap-select.js")}}"></script>

<!-- ================================================
Bootstrap Toggle
================================================ -->
<script type="text/javascript" src="{{asset("/public/js/bootstrap-toggle/bootstrap-toggle.min.js")}}"></script>

<!-- ================================================
Bootstrap WYSIHTML5
================================================ -->
<!-- main file -->
<script type="text/javascript" src="{{asset("/public/js/bootstrap-wysihtml5/wysihtml5-0.3.0.min.js")}}"></script>
<!-- bootstrap file -->
<script type="text/javascript" src="{{asset("/public/js/bootstrap-wysihtml5/bootstrap-wysihtml5.js")}}"></script>


<!-- ================================================
jQuery UI
================================================ -->
<script type="text/javascript" src="{{asset("/public/js/jquery-ui/jquery-ui.min.js")}}"></script>

<!-- ================================================
Moment.js
================================================ -->
<script type="text/javascript" src="{{asset("/public/js/moment/moment.min.js")}}"></script>

@yield('footer_scripts')
</body>
</html>
