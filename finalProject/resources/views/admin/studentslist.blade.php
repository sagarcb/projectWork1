@extends("admin/master")

@section("content")

    <div class="content-wrapper">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {{--Button section--}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn">
                                <button type="button" class="btn btn-success"><a class="text-white" href="{{url('/admin/addstudents')}}">Add Student</a></button>
                                <button type="button" class="btn btn-warning" data-target="#mymodel" data-toggle="modal">Add from Excel</button>
                            </div>
                        </div>
                    </div>
                    {{--End of buton section--}}

                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 30px">
                                <a class="navbar-brand" href="#">Students List</a>
                            </nav>
                        </div>
                        <div class="col-md-12" id="student-t">
                            <div style="height: 10px">
                                <span></span>
                            </div>
                            <table class="table table-striped" id="student-table">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Dept. Code</th>
                                    <th scope="col">Registration Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{$student->sid}}</td>
                                        <td>{{$student->sname}}</td>
                                        <td>{{$student->semail}}</td>
                                        <td>{{$student->deptcode}}</td>
                                        <td>{{$student->created_at}}</td>
                                        <td>
                                            <a href="{{url("admin/$student->sid/edit")}}">
                                                <button>Edit</button>
                                            </a>
                                            <form action="{{url("admin/$student->sid")}}" method="post" onsubmit="return confirm('Are you sure to delete this row?')">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" id="mymodel">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>Excel Import</h3>
                                <hr>
                            </div>

                            <div class="modal-body">
                                <div class="choose-file">
                                    <form action="{{url('/admin/students')}}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="file" name="file" id="" accept="">
                                        </div>
                                        <button type="submit" id="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
 {{--   <script !src="">
        var v = document.querySelector("#submit");
        v.addEventListener("click",function () {
            location.reload();
        })
    </script>--}}

@endsection
