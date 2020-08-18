@extends("superAdmin.master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <div class="content">
            <div class="row">
               <div class="col-md-12">
                   <div class="form">
                       <form action="{{url('superadmin/selectactivesemester/')}}" method="post">
                           @csrf
                           <div class="row">
                               <div class="col-md-3">
                                   <label for="inputDeptCode">Dept. Code</label>
                                   <select id="inputDeptCode" name="deptcode" class="form-control">
                                       <option selected value="choose">Choose...</option>
                                       <option value="CSE">CSE</option>
                                       <option value="Law">Law</option>
                                       <option value="Pharmacy">Pharmacy</option>
                                       <option value="FET">Food Engineering</option>
                                       <option value="English">English</option>
                                       <option value="BBA">BBA</option>
                                       <option value="Architecture">Architecture</option>
                                       <option value="JCM">Journalism</option>
                                   </select>
                               </div>
                               <div class="col-md-3">
                                   <label for="inputSemester">Semester</label>
                                   <select id="inputSemester" name="semester" class="form-control">
                                       <option selected value="choose">Choose...</option>
                                       <option value="summer">Summer</option>
                                       <option value="spring">Spring</option>
                                       <option value="fall" >Fall</option>
                                   </select>
                               </div>
                               <script>
                                   var a = document.getElementById('inputDeptCode');
                                   a.addEventListener('click',function () {
                                        if (a.value == 'phm'){
                                            document.getElementById('inputSemester').options['2'].disabled = true;
                                        }
                                   })
                               </script>


                               <div class="col-md-3">
                                   <label for="inputYear">Current Year</label><br/>
                                   <input type="text" name="year" id="inputYear" readonly value="">
                               </div>
                               <script>
                                   var d = new Date();
                                   var n = d.getFullYear();
                                   document.getElementById('inputYear').value = n;
                               </script>

                               <div class="col-md-3">
                                   <span></span><br/>
                                   <Button class="btn btn-success" type="submit">Save</Button>
                               </div>

                           </div>
                       </form>
                   </div>
                   <hr>

                   <div class="row">
                       <div class="col-md-12">
                           <table class="table table-striped">
                               <thead>
                               <tr>
                                   <th scope="col">Dept</th>
                                   <th scope="col">Running Semester</th>
                                   <th scope="col">Current Year</th>
                                   <th scope="col">Active Status</th>
                               </tr>
                               </thead>
                               <tbody>
                               @foreach($active as $row)
                               <tr>
                                   <td>{{$row->dept}}</td>
                                   <td>{{$row->semester}}</td>
                                   <td>{{$row->year}}</td>
                                   <td>
                                       <input data-id="{{$row->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $row->active_status ? 'checked' : '' }}>
                                   </td>
                               </tr>
                               @endforeach
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <script>
                       $(function () {
                           $('.toggle-class').change(function() {
                               var status = $(this).prop('checked') == true ? 1 : 0;
                               var id = $(this).data('id');
                               $.ajax({
                                   type: "GET",
                                   dataType: "json",
                                   url: '/superadmin/selectactivesemester/activestatusupdate',
                                   data: {status : status, id: id},
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

               </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
