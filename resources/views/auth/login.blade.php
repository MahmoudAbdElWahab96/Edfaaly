<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> MMSA | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/iCheck/square/blue.css') }}">
</head>

<body class="hold-transition login-page" style="background: #337ab7; overflow-y: hidden;">
    <div class="login-box">
        <div class="login-logo">
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body" style="border-radius: 10px;width: 305px;margin-left: 500px;margin-top: 200px;">
            <form action="{{route('login')}}" method="post">

                <div class="form-group has-feedback {{ $errors->has('email')? 'has-error' : ''}}">
                    {!! csrf_field() !!}

                    <input type="text" name="email" class="form-control" value="{{ count($errors) ? Request::old('email') : '' }}" placeholder="email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                     @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password')? 'has-error' : ''}}">
                    <input type="password" name="password" class="form-control" placeholder="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> remember me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 2.2.0 -->
    <script src="{{ asset('assets/admin/jquery/jquery.js') }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('assets/admin/iCheck/icheck.min.js') }}"></script>
    <script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
    </script>
</body>

</html>
