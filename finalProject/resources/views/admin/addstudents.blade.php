@extends("admin/master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4"><span></span></div>
                    <div class="col-md-4"><h3>Add new Students</h3></div>
                    <div class="col-md-4"><span></span></div>
                </div>
                <div class="row">
                    <div class="col-md-1"><span></span></div>
                    <div class="col-md-10">
                        <form action="{{url('admin/addstudents')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label for="inputID">Name</label>
                                    <input type="text" name="sname" class="form-control" placeholder="Student Name">
                                </div>
                                <div class="col">
                                    <label for="inputEmail">Email</label>
                                    <input type="text" name="semail" class="form-control" placeholder="Student email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="inputID">ID</label>
                                    <input type="text" name="sid" class="form-control" placeholder="Student id">
                                </div>
                                <div class="col">
                                        <label for="inputDeptCode">Dept. Code</label>
                                        <select id="inputDeptCode" name="deptcode" class="form-control">
                                            <option value="null" selected>Choose...</option>
                                            <option value="cse">CSE</option>
                                            <option value="law">Law</option>
                                            <option value="phm">Pharmacy</option>
                                            <option value="arch">Architecture</option>
                                            <option value="eng">English</option>
                                            <option value="bba">BBA</option>
                                            <option value="food">Food & Nutrition</option>
                                        </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="submit" class="btn-primary" value="Register">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-1"><span></span></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection
