<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home - Evaluation of Academic Performance</title>
    <link rel="stylesheet" href="resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="resources/css/stylesheet.css">
    <script src="resources/Jquery/jquery-3.5.1.js"></script>
    <script src="resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="resources/js/sweetalert.min.js"></script>
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
            <div class="row py-4 align-items-center">
                <div class="col-md-7 pb-3 text-center">
                <img src="uploads/image.jpg" class="img-fluid">

                    <h5>Welcome to the Online Evaluation of Academic Performance!</h5>
                    <p>
                        Our platform is designed to revolutionize the way academic performance is assessed and analyzed.
                        With a user-friendly interface and advanced features, we provide students, educators, and
                        institutions with a comprehensive online solution for evaluating and tracking academic progress.
                    </p>

                </div>
                <div class="col-md-5 text-center">
                    <div id="loginSection" class="text-center">
                        <br>
                        <h4><i class="fa fa-user-circle fa-3x" style="color:#341f97"></i></h4>
                        <h4>Admin login</h4><br>
                        <form>
                            <div class="form-row py-1 px-5">
                                <div class="form-group col-md-12">
                                    <input type="text" id="uid" class="form-control" placeholder="User ID">
                                </div>
                            </div>
                            <div class="form-row py-1 px-5">
                                <div class="form-group col-md-12">
                                    <input id="pass" type="password" class="form-control" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-row py-1 px-5">
                                <div class="form-group col-md-12">
                                    <input type="button" style="background-color:#341f97" onclick="loginFun()"
                                        class="form-control btn btn-success" value="Login">
                                </div>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="resources/js/login.js"></script>

</body>

</html>