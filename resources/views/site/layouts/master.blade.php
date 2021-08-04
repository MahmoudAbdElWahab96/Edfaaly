<!DOCTYPE html>
<html>
    <head>
        <!-- Basic page needs
		===========================-->
		<title>grade ecommerce</title>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">

        <!-- Mobile specific metas
		===========================-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/images/logo.png')}}">

        <!-- =================Google Web Fontx ===========================-->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700">

        <!-- Css Base And Vendor
		===========================-->
        <link rel="stylesheet" href="{{asset('assets/admin/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/jquery-ui/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/owl-carousel/css/owl.carousel.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/owl-carousel/css/owl.theme.css')}}">
        <link rel="stylesheet" href="{{asset('assets/jquery-toast/dist/jquery.toast.min.css')}}">

        <!-- Site Style
		===========================-->
        <link rel="stylesheet" href="{{asset('public/css/style.css')}}">

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="wrapper">

            @include('site.layouts.includes.header')

            <div class="main" role="main">

                @yield('page-content')

            </div><!--End main-->

        </div><!--End Wrapper-->

    </body>

    @include('site.layouts.includes.footer')

    <script src="{{asset('assets/jquery-toast/dist/jquery.toast.min.js')}}"></script>

    @yield('scripts')

    <script>

        $(document).ready(function () {

            $('.product-remove').on('click', function () {

                var _this = $(this);
                var url = _this.data('url');

                $.ajax({
                    url: url,
                    method:'GET',
                    success: function (result) {
                        //
                    }
                });
            });


            $(document).on('click', '.add-to-fav', function (e) {

                e.preventDefault();

                var _this = $(this);

                $.ajax({
                    url: _this.data('url'),
                    success: function (result) {

                        console.log(result);

                        $.toast({
                            heading: 'Information',
                            text: 'product was added to cart successfully!',
                            icon: 'info',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#E3363F'  // To change the background
                        });
                    }
                });
            });

        });



    </script>

</html>
