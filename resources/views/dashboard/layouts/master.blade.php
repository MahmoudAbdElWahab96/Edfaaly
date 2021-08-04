<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modern Optics | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- bootstrap select css -->
    <link href="{{asset('assets/js/plugins/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <!-- bootstrap 3.0.2 -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- font Awesome -->
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="{{asset('assets/css/ionicons.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('assets/css/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css"/>
    <!-- fullCalendar -->
    <link href="{{asset('assets/css/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Daterange picker -->
    <link href="{{asset('assets/css/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css"/>
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{asset('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- NOTY -->
    <link href="{{asset('assets/css/noty.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{asset('assets/css/AdminLTE.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" type="text/css"/>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-black">
<!-- header logo: style can be found in header.less -->
@include('dashboard.layouts.header')
<div class="wrapper row-offcanvas row-offcanvas-left">

@include('dashboard.layouts.sidebar')
<!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">

            @yield('content')
            @include('dashboard.partials._session')

        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<!-- add new calendar event modal -->


<!-- jQuery 2.0.2 -->
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> --}}
<script src="{{asset('assets/js/jquery-2.0.2.min.js')}}" type="text/javascript"></script>

<!-- jQuery UI 1.10.3 -->
<script src="{{asset('assets/js/jquery-ui-1.10.3.min.js')}}" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- Morris.js charts -->
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('assets/js/plugins/morris/morris.min.js')}}" type="text/javascript"></script> --}}
<!-- Sparkline -->
<script src="{{asset('assets/js/plugins/sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<!-- jvectormap -->
<script src="{{asset('assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"
        type="text/javascript"></script>
<!-- fullCalendar -->
<script src="{{asset('assets/js/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets/js/plugins/jqueryKnob/jquery.knob.js')}}" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="{{asset('assets/js/plugins/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"
        type="text/javascript"></script>
<!-- iCheck -->
<script src="{{asset('assets/js/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/bootstrap-select-1.13.14/dist/js/i18n/defaults-*.min.js')}}" type="text/javascript"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>--}}

<!-- AdminLTE App -->
<script src="{{asset('assets/js/AdminLTE/app.js')}}" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/js/AdminLTE/dashboard.js')}}" type="text/javascript"></script>

<!-- NOTY -->
<script src="{{asset('assets/js/noty.min.js')}}" type="text/javascript"></script>

@yield('scripts')

<script>
    // Delete Confirmation
    $('.delete').click(function (e) {

        var that = $(this);
        e.preventDefault();
        var n = new Noty({
            text: 'Are you sure you want to delete this?',
            killer: true,
            type: 'warning',
            buttons: [
                Noty.button('Yes', 'btn btn-success mr-2', function () {
                    that.closest('form').submit();
                }),

                Noty.button('No', 'btn btn-primary mr-2', function () {
                    n.close();
                })
            ]

        }).show();

        let aquiringMessage = document.querySelector('.noty_layout');
        aquiringMessage.classList.add('alert', 'alert-danger');
        aquiringMessage.style.padding = '10px';
        aquiringMessage.querySelector('.btn-primary').style.marginLeft = '10px';
    });

    // Preview Image
    $(".image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.imag-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }
    });
</script>

</body>
</html>
