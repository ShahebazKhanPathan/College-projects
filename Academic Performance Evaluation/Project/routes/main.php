<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location:../');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Online Evaluation of Academic Performance</title>
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
                <div class="col-md-12 text-center">
                    <form>
                        <div class="form-row">
                            <div class="form-group text-center col-md-8">
                                <h4>ADD NEW STUDENT</h4>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="logout.php" style="background-color:#341f97" class="btn btn-sm text-white"> 
                                    Logout
                                    <i class="fa fa-user-circle"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                    <form>
                        <div class="form-row pt-3">
                            <div class="form-group col-md-6">
                                <input class="form-control" type="text" placeholder="Name" id="name">
                            </div>
                            <div class="form-group col-md-6">
                                <input class="form-control" type="text" placeholder="Father's Name" id="fname">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input class="form-control" type="text" placeholder="Roll No" id="roll">
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" id="branch">
                                    <option value="">Branch</option>
                                    <option value="Mechanical">Mechanical</option>
                                    <option value="Electrical">Electrical</option>
                                    <option value="Civil">Civil</option>
                                    <option value="CSE">CSE</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" id="semester">
                                    <option value="">Semester</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="VI">VI</option>
                                    <option value="VII">VII</option>
                                    <option value="VIII">VIII</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 p-0 m-0"></div>
                            <div class="form-group col-md-4">
                                <button class="btn btn-success form-control" style="background-color:#341f97"
                                    type="button" onclick="addStudent()">Submit</button>
                            </div>
                            <div class="form-group col-md-4 p-0 m-0"></div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4>STUDENTS LIST</h4><br>
                    <div class="py-3" id="studentList"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="../resources/js/student.js">
    </script>

</body>

</html>