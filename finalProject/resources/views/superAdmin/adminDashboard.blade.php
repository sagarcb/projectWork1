@extends("superAdmin.master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5"><span></span></div>
                        <div class="col-md-4"><h2>Admins list</h2></div>
                        <div class="col-md-4"><span></span></div>
                    </div>


                    <table>
                        <tr>
                            <th>Admin Name</th>
                            <th>Admin ID</th>
                            <th>Dept.</th>
                            <th>Activity Status</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($admin as $row)
                            <tr>
                                <td>{{$row->empname}}</td>
                                <td>{{$row->empid}}</td>
                                <td>{{$row->deptcode}}</td>
                                <td>
                                    <input data-id="{{$row->empid}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $row->empactivitystatus ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <a href="{{url("superadmin/$row->empid/edit")}}">
                                        <button>Edit</button>
                                    </a>
                                    <form action="{{url("superadmin/$row->empid")}}" method="post" onsubmit="return confirm('Are you sure to delete this todo?')">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
        <!-- /.content-wrapper -->

    <script>
        $(function () {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/superadmin/statusupdate',
                    data: {status : status, user_id: user_id},
                    success: function(data){
                        console.log(data.success)
                    },
                    error: function () {
                        alert("Failed to update");
                    }
                });
            });

        });


    </script>

@endsection
