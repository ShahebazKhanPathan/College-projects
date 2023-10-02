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
    <title>My Applied Jobs - Online Placement Cell</title>
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
                            <h5 class="text-dark"><i class="fa fa-briefcase"></i> Jobs</h5>
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
                    <div id="loginSection" class="p-4">
                        <h4 class="border-bottom">My Applications</h4><br>
                        <div id="Jobs"></div>
                    </div>
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
                    call: 6,
                }),
                success: function (data) {
                    console.log(data);
                    var jobs = '';
                    if (data == 0) {
                        $("#Jobs").html('You have not applied for any job yet.');
                    }
                    else {
                        $.each(data, function (i, d) {
                            i++;
                            jobs +=
                                '<div class="row">' +
                                '<div class="col-md-1">' +
                                '<h5>' + i + '.</h5>' +
                                '</div>' +
                                '<div class="col-md-7">' +
                                '<h5>' + d.jpro + '</h5>' +
                                '<h6 class="text-muted">' + d.cname + '</h6>' +
                                '</div>' +
                                '<div class="col-md-4">' +
                                'Applied on <br>' + d.date +
                                '</div>' +
                                '</div><hr>';
                        });

                        $("#Jobs").html(jobs);

                    }


                }

            });
        }

    </script>

</body>

</html>