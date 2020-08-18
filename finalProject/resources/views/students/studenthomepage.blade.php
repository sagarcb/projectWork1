<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/studenthome.css')}}">
    <link rel="stylesheet" href="{{url("css/footer.css")}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
@include('common.navbar')<!--Navbar Section-->

<div class="container"> <!--container classs starts-->
<div class="studentinfo"> <!--studentinfo classs starts-->

    <h4 style="color: white; padding-top: 10px; text-align: center;"><b>Teaching Evaluation</b></h4>
    <hr style="color: white; background-color: white; height: 3px;">

        <div class="row"> <!--row classs starts-->
            <div class="col-md-12"> <!--col-md-12 classs starts-->
                <form action="" method="get">
                    <label style="padding-left: 20px">Program: <input type="text" name="program" value="" readonly></label>
                    <label id="date">Date: <input type="text" name="date" value="" readonly></label><br/><br/>
                    <label id="studentid">Student ID: <input type="text" name="studentid" value="" readonly></label><br/>
                    <label id="studentname">Student Name: <input type="text" name="studentname" value="" readonly></label>
                </form>
            </div> <!--col-md-12 classs ends-->
        </div> <!--row classs ends-->

        <!--Dropdown menu starts-->
        <div class="row justify-content-md-center"> <!--row justify-content-md-center class starts-->

            <div class="col-md-6">

                <div class="row">

                    <!--Choose Year dropdown menu starts-->
                    <div class="col-md-6">
                        <div class="dropdown">
                            <label style="text-align: center;">Choose Year:</label><br/>
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                ------------------
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">2020</a>
                                <a class="dropdown-item" href="#">2019</a>
                                <a class="dropdown-item" href="#">2018</a>
                            </div>
                        </div>
                    </div>
                    <!--Choose Year dropdown menu ends-->

                    <!--Choose semester dropdown menu starts-->
                    <div class="col-md-6">
                        <div class="dropdown">
                            <label style="text-align: center;">Choose Semester:</label><br/>
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                ------------------
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Spring 2020</a>
                                <a class="dropdown-item" href="#">Fall 2019</a>
                                <a class="dropdown-item" href="#">Summer 2019</a>
                            </div>
                        </div><!--dropdown class ends-->
                    </div>
                    <!--Choose semester dropdown menu ends-->

                </div>

            </div>

        </div> <!--row justify-content-md-center class ends-->

    <!--Dropdown class ends-->


    <!--Table Section starts-->
    <div class="table d-flex justify-content-center">

        <table>
            <tr>
                <th>Submit Status</th>
                <th>Course Code</th>
                <th>Section</th>
                <th>Teacher Name</th>
            </tr>
            <tr>
                <td><button type="submit" id="submit-status" name="btn-submit-status">Evaluate</button></td>
                <td>CSE-0419</td>
                <td>A</td>
                <td>Jubayer Ahmed</td>
            </tr>
            <tr>
                <td><button type="submit" id="submit-status1" name="btn-submit-status">Evaluate</button></td>
                <td>CSE-0419</td>
                <td>A</td>
                <td>Jubayer Ahmed</td>
            </tr>
        </table>

    </div>

    <div class="row justify-content-center">

        <div class="col-md-6 justify-content-center" id="open-for-evaluate">

            <!-- The Modal -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-body">
                        <h5>Evaluation Status</h5>
                        <hr style="height: 3px; background-color: white;">
                        <p><b>Open for Evaluation</b></p>
                        <button class="btn btn-secondary" id="evaluated" style="display: ;">Evaluate</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--Script for pop up Modal screen starts-->
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("submit-status");
        var btn1 = document.getElementById("submit-status1");

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
            document.getElementById("evaluated").style.display = "";
            document.getElementsByTagName("p")[0].innerHTML="<b>Open For Evaluation</b>";
        }

        btn1.onclick = function(){
            modal.style.display = "block";
            document.getElementById("evaluated").style.display = "none";
            document.getElementsByTagName("p")[0].innerHTML="<b>Evaluated</b>";

        }


        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <!--Script for pop up Modal screen ends-->

</div><!--studentinfo classs ends-->
</div><!--container classs ends-->

@include('common.footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<script src="{{url('js/jquery-3.4.1.slim.min.js')}}"></script>

</body>
</html>

