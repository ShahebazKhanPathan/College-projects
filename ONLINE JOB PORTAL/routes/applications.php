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
    <title>Applications - Online Placement Cell</title>
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
            <div class="row py-4">
                <div class="col-md-12 py-1">
                    <div id="loginSection" class="p-4">
                        <h4>Job Applications</h4><br>
                        <div id="Info"></div>
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
                    call: 7,
                }),
                success: function (data) {
                    console.log(data);
                    var jobs = '';
                    if (data == 0) {
                        $("#Info").html('There are no applications right now.');
                    }
                    else {
                        $.each(data, function (i, d) {
                            i++;
                            jobs +=
                                '<tr>' +
                                '<td>' + i + '</td>' +
                                '<td>' + d.name + '</td>' +
                                '<td>' + d.mobile + '</td>' +
                                '<td>' + d.cname + '</td>' +
                                '<td>' + d.jpro + '</td>' +
                                '<td>' + d.date + '</td>' +
                                '</tr>';
                        });
                    }

                    $("#Info").html(
                        '<div class="table-responsive-md">' +
                        '<table class="table">' +
                        '<tr>' +
                        '<th>Sr. no.</th>' +
                        '<th>Name</th>' +
                        '<th>Mobile</th>' +
                        '<th>Company</th>' +
                        '<th>Job Profile</th>' +
                        '<th>Date</th>' +
                        '</tr>' +
                        jobs +
                        '</table>' +
                        '</div>'
                    );


                }
            });
        }

    </script>

</body>

</html>