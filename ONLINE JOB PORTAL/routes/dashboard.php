<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location:../');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>Admin Dashboard - Online Placement Cell</title>
    <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/stylesheet.css">
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
</head>

<body>

    <div id="headerSection" class="sticky-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <a href="../"><button class="btn text-white"><i class="fa fa-chevron-circle-left"></i> Back</button>
                    </a>
                </div>
                <div class="col-sm-4 text-center pt-3">
                    <p id="brand">Online Placement Cell</p>
                </div>
                <div class="col-sm-2 text-center">
                    <a class="text-white" href="dashboard.php">Jobs <i class="fa fa-briefcase"></i></a>
                </div>
                <div class="col-sm-2 text-center">
                    <a class="text-white" href="applications.php">Applications <i class="fa fa-inbox"></i></a>
                </div>
                <div class="col-sm-2 text-center">
                    <a class="text-white" href="logout.php">Logout <i class="fa fa-user-circle"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div id="bodySection">
        <div class="container">

            <div class="row py-3">
                <div class="col-md-4">
                    <div id="loginSection" class="p-4">
                        <h4 id="groups">Create new opening</h4><br>
                        <form id="createJobForm" enctype="multipart/form-data">
                            <input name="cname" type="text" class="form-control" placeholder="Company name" required>
                            <br>
                            <input name="jlocation" type="text" class="form-control" placeholder="Job Location"
                                required>
                            <br>
                            <input name="jprofile" type="text" class="form-control" placeholder="Job Profile" required>
                            <br>
                            <textarea name="jdescription" type="text" class="form-control" placeholder="Job description"
                                required></textarea>
                            <br>
                            <select name="branch" class="form-control">
                                <option value="Not mentioned">Branch</option>
                                <option value="Mechanical">Mechanical</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Civil">Civil</option>
                                <option value="Electrical">Electrical</option>
                            </select>
                            <br>
                            <select name="qualification" class="form-control">
                                <option value="Not mentioned">Qualification</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Graduation">Graduation</option>
                                <option value="Post Graduation">Post Graduation</option>
                            </select>
                            <br>
                            <select name="experience" class="form-control">
                                <option value="Not mentioned">Experience</option>
                                <option value="Fresher">Fresher</option>
                                <option value="6 months">6 months</option>
                                <option value="1 Year">1 Year</option>
                                <option value="2 Years">2 Years</option>
                                <option value="3 Years">3 Years</option>
                                <option value="4 Years">4 Years</option>
                                <option value="5 Years">5 Years</option>
                            </select>
                            <br>
                            <select name="salary" class="form-control">
                                <option value="Not mentioned">Salary</option>
                                <option value="Not disclosed">Not disclosed</option>
                                <option value="10,000 - 15,000">10,000 - 15,000</option>
                                <option value="15,000 - 20,000">15,000 - 20,000</option>
                                <option value="20,000 - 25,000">20,000 - 25,000</option>
                                <option value="25,000 - 30,000">25,000 - 30,000</option>
                            </select>
                            <br>
                            <textarea name="eligibility" type="text" class="form-control"
                                placeholder="Eligibility criteria" required></textarea>
                            <br>
                            <input name="vacancies" type="number" class="form-control" placeholder="No. of vacancies"
                                required>
                            <br>

                            <input type="submit" class="form-control btn btn-dark" id="btnn" name="regbtn"
                                value="Create">
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div id="Jobs"></div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            getJobs();
        });


        function getJobs() {
            $.ajax({
                url: '../api/api.php',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    call: 11
                }),
                success: function (data) {
                    console.log(data);
                    var jobs = data;
                    var getJobs = '';

                    if (data == 0) {
                        $("#Jobs").html('<div id="loginSection" class="p-4"><p>There are no jobs right now.</p></div>');
                    }
                    else {
                        $.each(jobs, function (i, d) {
                            getJobs +=
                                '<div id="loginSection" class="p-4">' +
                                '<h4>' + d.jpro + '</h4>' +
                                '<h6 class="text-muted">' + d.cname + '</h6><hr>' +
                                '<div class="row">' +
                                '<div class="col-md-6">' +
                                '<b>Job location:</b><br> ' + d.jloc + '<br><br>' +
                                '<b>Job Description:</b><br> ' + d.jdes + '<br><br>' +
                                '<b>Branch:</b><br> ' + d.branch + '<br><br>' +
                                '<b>Qualification:</b><br> ' + d.quali + '<br><br>' +
                                '</div>' +
                                '<div class="col-md-6">' +
                                '<b>Experience:</b><br> ' + d.exp + '<br><br>' +
                                '<b>Salary:</b><br> ' + d.salary + '<br><br>' +
                                '<b>Eligibility Criteria:</b><br> ' + d.eligibility + '<br><br>' +
                                '<b>Vacancies:</b><br> ' + d.vacancy + '<br><br>' +
                                '</div>' +
                                '</div>' +
                                '</div><br>';
                        });

                        $("#Jobs").html(getJobs);
                    }
                }

            });
        }

        $("#createJobForm").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '../api/job.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    swal({
                        title: "Job posted successfully!",
                        text: "New job opening has been created successfully!",
                        icon: "success",
                        button: "OK!",
                    }).
                        then((done) => {
                            if (done) {
                                location.reload();
                            }
                        });
                }
            });
        });

        $("#logoForm").on('submit', function (e) {
            e.preventDefault();
            $("#exampleModal").modal('hide');
            $.ajax({
                url: '../api/info.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    getInfo();
                }
            });
        });


        function deletePoll(id) {

            var id = id;

            swal({
                title: 'Are you sure?',
                text: "Confirm first if you want to delete any poll!",
                icon: "warning",
                buttons: ['Cancel', 'Confirm'],
                dangerMode: true,
            })
                .then((vote) => {
                    if (vote) {
                        delCan(id);
                    } else {
                        swal("Think again!");
                    }
                });
        }

        function delCan(id) {
            $.ajax({
                url: '../api/api.php',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    call: 0,
                    id: id
                }),
                success: function (data) {
                    if (data == 1) {
                        getPolls();
                    }
                }

            });
        }


    </script>

</body>

</html>