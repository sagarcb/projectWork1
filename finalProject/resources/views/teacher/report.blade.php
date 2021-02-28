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
            <h3 class="text-center text-white">{{$tinfo->tname}}'s Info</h3>
            <hr id="headingHr">
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h5>Name: <span>{{$tinfo->tname}}</span></h5>
                    <h5>Current Year: {{$activeys->year}}</h5>
                </div>
                <div class="col-md-6">
                    <h5>Dept: <span>{{$tinfo->deptcode}}</span></h5>
                    <h5>Current Semester: {{$activeys->semester}}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-12" id="regCourses">
            <h4>{{$courseid}}- MCQ report</h4>
            <hr>
            @if($evstatus->openforevaluation == 1)
                <h5>Evaluation is running</h5>
            @else
                <h5>Evaluation is Closed or not Opened yet</h5>
            @endif
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Positive Response</th>
                            <th scope="col">Mean Score</th>
                            <th scope="col">Total Weight</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Year</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @if(isset($mcq))
                            <th>{{$mcq->positive_response}}</th>
                            <td>{{$mcq->mean_score}}</td>
                            <td>{{$mcq->total_weight}}</td>
                            <td>{{$mcq->semester}}</td>
                            <td>{{$mcq->year}}</td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>

        <div class="col-md-12">
            <h4 class="text-center" style="color: white;">{{$courseid}}- Openended report</h4>
            <hr style="width: 350px; background: white;">

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Questions</th>
                            <th scope="col">Answers</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($openended->unique('qdesopenended') as $row1)
                        <tr>
                            <td>{{$row1->qdesopenended}}</td>
                            @foreach($openended as $row2)
                                @if($row2->qdesopenended == $row1->qdesopenended)
                                    <td>{{$row2->answerdesc}}</td>
                                @endif
                            @endforeach
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>


</div>


@include('teacher.common.footer')

<script src="{{url("")}}/js/bootstrap.min.js"></script>
<script src="{{url("")}}/js/studenthome1.js"></script>
</body>
</html>
