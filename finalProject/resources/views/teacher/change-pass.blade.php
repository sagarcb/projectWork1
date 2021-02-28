<!doctype html>
<html lang="en">
<head>
    @include('teacher.common.head')
    <title>Teacher Homepage</title>

    <link rel="stylesheet" href="{{""}}/css/teacher.css">
</head>
<body>
@include('teacher.common.navbar')
<div class="container" id="teacher-body">
    <div class="row">

        <div class="col-md-12">
            <h3 class="text-center text-white">Edit {{$tinfo->tname}}'s Info</h3>
            <hr id="headingHr">
        </div>

        @php($id = session('tid'))
        <div class="col-md-12" id="regCourses">
            <form style="margin-right: 350px; margin-left: 350px; margin-bottom: 10px" action="{{url("/teacher/$tinfo->tid/update-pass")}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name"><span style="color: white">Give old password:</span></label>
                    <input type="password" class="form-control" name="oldPassword" id="old">
                    @error('oldPassword')
                    <span style="color: yellow">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password"><span style="color: white">Give new password</span></label>
                    <input type="password" class="form-control" name="newPassword" id="password">
                    @error('newPassword')
                    <span style="color: yellow">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirm"><span style="color: white">Confirm new password</span></label>
                    <input type="password" class="form-control" name="confirmPassword" id="confirm">
                    @error('confirmPassword')
                    <span style="color: yellow">{{$message}}</span>
                    @enderror
                </div>
                <p style="color: yellow">{!! Session::has('msg') ? Session::get("msg") : '' !!}</p>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1"><span style="color: white">Show password</span></label>
                </div>
                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
            <script !src="">
                $('#exampleCheck1').on('click',function () {
                    if (this.checked){
                        $('#password').attr('type','text');
                        $('#confirm').attr('type','text');
                        $('#old').attr('type','text');
                    }else {
                        $('#password').attr('type','password');
                        $('#confirm').attr('type','password');
                        $('#old').attr('type','password');
                    }
                });
            </script>
        </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">

            </div>
            <div class="col-md-1"></div>
        </div>

    </div>


</div>
@include('teacher.common.footer')

<script src="{{url("")}}/js/bootstrap.min.js"></script>
<script src="{{url("")}}/js/studenthome1.js"></script>
</body>
</html>
