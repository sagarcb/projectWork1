<!doctype html>
<html lang="en">
<head>
    @include('students.common.head')
    <title>Tuition Fee</title>

    <link rel="stylesheet" href="{{url("")}}/css/studenthome1.css">

    <script src="{{url("")}}/js/jquery-3.4.1.slim.min.js"></script>

    <style>
        form{
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 5px;
            border: 1px solid white;
        }
    </style>

</head>
<body>
{{--Head Navbar Section Starts--}}
@include('students/common/navbar')
{{--Head Navbar Section ends--}}


<div class="container">
    <div class="row">
        <div class="col-md-12" id="main-contents">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto mt-3">
                    <h4 class="text-white">Student ID: UG02-42-16-009</h4>
                    <select class="custom-select m-2" name="paymentMethod" id="paymentMethod">
                        <option value="" selected>Select payment Method</option>
                        <option value="bkash">BKash</option>
                        <option value="db">Dhaka Bank</option>
                        <option value="card">Card</option>
                    </select>

                    <div id="paymentProcedure" style="color: yellow; display: none" >
                        <small>* First Go to your payment option on Bkash</small><br>
                        <small>* Use (01679186979) this number to make payment</small><br>
                        <small>* Add Give your ID as reference</small><br>
                        <small>* Then fill up the form given below with necessary informations</small><br>


                        <form action="" method="post" class="text-white">
                            @csrf

                            <div class="form-group">
                                <label for="transactionID" class="text-white">Give Payment Transaction ID</label>
                                <input type="text" class="form-control" id="transactionID" placeholder="Transaction ID">
                            </div>
                            <div class="form-group">
                                <label for="transactionAmount" class="text-white">Paid Amount</label>
                                <input type="number" class="form-control" id="transactionAmount" placeholder="Transaction Amount">
                            </div>
                            <div class="form-group">
                                <label for="paymentNumber" class="text-white">Payment Number</label>
                                <input type="number" class="form-control" id="paymentNumber" placeholder="Payment Number">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

{{--Footer section starts--}}
@include('students/common/footer')
{{--Footer Section Ends--}}

<script src="{{url("")}}/js/bootstrap.min.js"></script>
</body>
</html>

<script !src="">
    $("select").on('click', function () {
        if ($(this).val() === "bkash"){
            $("#paymentProcedure").css("display","block");
        }else {
            $("#paymentProcedure").css("display","none");
        }
    });
</script>
