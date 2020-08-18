<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url("css/login.css")}}">
    <link rel="stylesheet" href="{{url("css/footer.css")}}">

</head>
<body>

<div class="container" style="margin-bottom: 20px;">
    <div class="logo">
        <img src="images/logo.png" alt="State University Logo">
        <p><b>State University Of Bangladesh</b></p>

        <div class="login-form">
            <form action="/examples/actions/confirmation.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"><a style="color: white; text-decoration: none;" href="{{url('/student')}}">Login</a></button>
                </div>
            </form>
        </div>

        <div>
        <a style="color: white; margin-left: 10px; margin-right: 10px;" href="#">TeacherLogin</a>
        <a style="color: white; margin-left: 10px; margin-right: 10px;" href="{{url('/adminlogin')}}">AdminLogin</a>
        <a style="color: white; margin-left: 10px; margin-right: 10px" href="{{url("/superadminlogin")}}">SuperAdminLogin</a>
        </div>

    </div>
</div>
@include("common.footer")


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
</body>
</html>
