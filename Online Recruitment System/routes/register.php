<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>Sign Up - Online Placement Cell</title>
    <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/stylesheet.css">
    <link rel="stylesheet" href="../resources/Jquery/jquery-ui.css">
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Jquery/jquery-ui.js"></script>
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
                <div class="col-sm-6 pt-3">
                    <p id="brand">Online Placement Cell</p>
                </div>
                <div class="col-md-2">
                    <a href="../"><button class="btn text-white"><i class="fa fa-user-circle"></i> Sign In</button> </a>
                </div>
                <div class="col-md-2">
                    <a href="../admin.php"><button class="btn text-white"><i class="fa fa-user-circle"></i>
                            Admin</button> </a>
                </div>
            </div>
        </div>
    </div>

    <div id="bodySection">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-2">
                </div>
                <div class="col-md-8 text-center">
                    <form id="regForm" enctype="multipart/form-data">
                        <div class="form-row py-1">
                            <div class="col-md-3"></div>
                            <div class="form-group col-md-6 text-white">
                                <h4 style="font-weight: 600;">Create new account</h4><br>
                                <input name="name" type="text" class="form-control" placeholder="Name" required><br>
                                <input name="email" type="email" class="form-control" placeholder="Email " required><br>
                                <input name="mobile" type="text" class="form-control" placeholder="Mobile No"
                                    required><br>
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
                                <input name="cgpa" type="text" class="form-control"
                                    placeholder="Current CGPA" required><br>
                                <input name="ten" type="text" class="form-control" placeholder="10th Percentage"
                                    required><br>
                                <input name="twelve" type="text" class="form-control"
                                    placeholder="12th/Diploma Percentage"" required><br>
                                <input name=" year" type="text" class="form-control" placeholder="Passout Year"" required><br>
                                <input name=" pass" type="password" class="form-control" placeholder="Password"
                                    required><br>
                                <input name="cpass" type="password" class="form-control" placeholder="Confirm password"
                                    required><br>
                                <input type="submit" class=" btn btn-dark" id="btnn" name="regbtn" value="Register"><br>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            $("#regForm").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '../api/register.php',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data == 1) {
                            swal({
                                title: "Registration successfull!",
                                text: "You are successfully registered on online placement cell!",
                                icon: "success",
                                button: "OK!",
                            }).then((value) => {
                                window.location = '../';
                            });
                        }
                        else if (data == 3) {
                            swal({
                                title: "Passwords do not match!",
                                text: "Password and Confirm password does not match!",
                                icon: "error",
                                button: "OK!",
                            });
                        }
                        else if (data == 4) {
                            swal({
                                title: "User already exists!",
                                text: "Mobile number is already taken. Try another!",
                                icon: "error",
                                button: "OK!",
                            });
                        }
                        else if (data == 5) {
                            swal({
                                title: "Invalid Mobile No!",
                                text: "Only 10 digits required!",
                                icon: "error",
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
                    }
                });
            });
        });

    </script>

</body>

</html>