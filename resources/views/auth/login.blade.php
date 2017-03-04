<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

    <title>Eyeteach 2017</title>

    <!-- Icons -->
    <link href="{{ url('css/stylesheets.css') }}" rel="stylesheet">
    {{-- <link href="../../css/simple-line-icons.css" rel="stylesheet"> --}}

    <!-- Main styles for this application -->
    {{-- <link href="../../css/style.css" rel="stylesheet"> --}}

</head>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" align="center">
                <div class="card-group mb-0" style="width:60%;">
                    <div class="card p-2">
                        <div class="card-block">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <div class="input-group mb-1">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                                <input id="username" type="text" class="form-control" placeholder="Email">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                <input id="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="row" >
                                <div style="width: 95%;" align="right">
                                    <button type="button" class="btn btn-primary px-2" id="btnLogin">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and necessary plugins -->
    <script src="{{ url('js/all.js') }}"></script>
    {{-- <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../bower_components/tether/dist/js/tether.min.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script> --}}

</body>

<script type="text/javascript">
    $(document).ready(function(){
        $('#btnLogin').on('click',function(){
            var email = $.trim($('#username').val());
            var password = $.trim($('#password').val());

            $.post(
                "{{ url('checklogin') }}",
                {
                    'email':email,
                    'password':password
                },
                function(data){
                    if($.trim(data.success) == "1"){
                        window.location = "{{ url('admin/videos/index') }}";
                    }else{
                        sweetAlert("Oops...", "Invalid account.", "error");
                    }
                }
            );
        });
    });
</script>

</html>
