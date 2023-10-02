<?php
session_start();

if (!isset($_SESSION['user_id'])) {
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
    <title>Online Placement Cell - User Dashboard</title>
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
                <div class="col-md-8 text-center pt-3">
                    <p id="brand">Online Placement Cell</p>
                </div>
                <div class="col-md-2 text-center ">
                    <a style="color:white; text-decoration:none" href="logout.php">Logout <i
                            class="fa fa-user-circle"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div id="bodySection">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-3 py-1">
                    <div id="loginSection" class="p-4">
                        <a href="../">
                            <h5 class="text-dark"><i class="fa fa-home"></i> Home</h5>
                        </a><br>
                        <a href="main.php">
                            <h5 class="text-dark"><i class="fa fa-briefcase"></i> Jobs
                            </h5>
                        </a><br>
                        <a href="applied.php">
                            <h5 class="text-dark"><i class="fa fa-envelope"></i> Applied</h5>
                        </a><br>
                        <a href="profile.php">
                            <h5 class="text-dark"><i class="fa fa-user"></i> Profile</h5>
                        </a><br>
                        <a href="logout.php">
                            <h5 class="text-dark"><i class="fa fa-user-circle"></i> Logout</h5>
                        </a><br>
                    </div>
                </div>
                <div class="col-md-9 py-1">
                    <div id="Jobs"></div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            getData();
        });

        function getData() {
            $.ajax({
                url: '../api/api.php',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    call: 2,
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
                                '<div class="row">' +
                                '<div class="col-md-10">' +
                                '<h4>' + d.jpro + '</h4>' +
                                '<h6 class="text-muted">' + d.cname + '</h6>' +
                                '</div>' +
                                '<div class="col-md-2">' +
                                '<button class="btn text-white" type="button" onclick="conFirm(' + d.id + ')" style="background-color: #2c3e50">Apply</button>' +
                                '</div>' +
                                '</div>' +
                                '<hr>' +
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
                                'Posted on ' + d.created_at +
                                '</div>' +
                                '</div>' +
                                '</div><br>';
                        });

                        $("#Jobs").html(getJobs);
                        $("#jobsBadge").html('<span class="badge badge-danger">' + jobBadge + '</span>');
                    }
                }

            });
        }

        function conFirm(id) {
            var jid = id;
            swal({
                title: 'Are you sure?',
                text: "Confirm once before applying for this job!",
                icon: "warning",
                buttons: ['Cancel', 'Confirm'],
                dangerMode: true,
            })
                .then((ok) => {
                    if (ok) {
                        applyJob(jid);
                    } else {
                        swal("Think again!");
                    }
                });
        }

        function applyJob(jid) {
            var jid = jid;

            $.ajax({
                url: "../api/api.php",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify({
                    call: 4,
                    jid: jid,
                }),
                success: function (data) {
                    if (data == 1) {
                        swal({
                            title: "Thank you!!",
                            text: "You have applied to this job successfully!",
                            icon: "success",
                            button: "OK!",
                        });
                    }
                    else if (data == 2) {
                        swal({
                            title: "Already applied!",
                            text: "You have already applied to this job!",
                            icon: "info",
                            button: "OK!",
                        });
                    }
                    else {
                        swal({
                            title: "Error!",
                            text: "Some error occured!",
                            icon: "error",
                            button: "OK!",
                        });
                    }
                },
            });
        }

    </script>

</body>

</html>