<?php
session_start();
if (!isset($_SESSION['uid']) and !isset($_SESSION['sid'])) {
    header('location:../');
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Record - Online Evaluation of Academic Performance</title>
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
            <div class="row">
                <div class="col-sm-12 text-center pt-3">
                    <p id="brand">Online Evaluation of Academic Performance</p>
                </div>
            </div>
        </div>
    </div>

    <div id="bodySection">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-3 border-right">
                    <h5>PROFILE</h5><br>
                    <b>Name:</b> <br> <span id="sname"></span><br><br>
                    <b>Father's Name:</b><br> <span id="fname"></span><br><br>
                    <b>Roll No:</b><br> <span id="roll"></span><br><br>
                    <a href="main.php">
                        <button type="button" style="background-color:#341f97" class="btn btn-sm text-white">Add New Student <i
                                class="fa fa-plus"></i></button>
                    </a><br><br>
                    <a href="logout.php"><button style="background-color:#341f97" class="btn btn-sm text-white">
                            Logout
                            <i class="fa fa-user-circle"></i>
                        </button>
                    </a>
                </div>
                <div class="px-5 col-md-9">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <h5>ADD MARKS</h5><br>
                                <input class="form-control mb-3" type="text" placeholder="Subject Name" id="subname">
                                <input class="form-control mb-3" type="text" placeholder="Subject Code" id="subcode">
                                <select class="custom-select mb-3" id="subtype">
                                    <option value="Theory">Theory</option>
                                    <option value="Practical">Practical</option>
                                </select>
                                <input class="form-control mb-3" type="text" placeholder="Mid Sem Marks" id="midmarks">
                                <input class="form-control mb-3" type="text" placeholder="Sessional Marks"
                                    id="sessionalmarks">
                                <input class="form-control mb-3" type="text" placeholder="End Sem Marks" id="endmarks">
                                <button class="btn form-control text-white" type="button" onclick="addRecord()"
                                    style="background-color:#341f97">Add record</button>
                            </div>
                            <div class="form-group col-md-6">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row py-3">
                <div class="col-md-12">
                    <div class="text-center">
                        <h5>STATEMENT OF MARKSHEET (PROVISIONAL)</h5>
                    </div>
                    <div class="py-3" id="recordList"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="../resources/js/record.js"></script>

</body>
</html>