<?php
// IMPORT DATABASE CONNECTION FILE
include('connection.php');

// COLLECT FORM DATA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $branch = $_POST['branch'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $cgpa = $_POST['cgpa'];
    $ten = $_POST['ten'];
    $twelve = $_POST['twelve'];
    $year = $_POST['year'];
    $date = date('d-m-Y');

    // CHECK MOBILE NO
    $check = mysqli_query($con, "select * from user where mobile='$mobile' ");

    // VALIDATIONS
    if ($pass !== $cpass) {
        echo json_encode(3);
    } else if (strlen($mobile) != 10) {
        echo json_encode(5);
    } else if (mysqli_num_rows($check) > 0) {
        echo json_encode(4);
    } else {
        $query = mysqli_query($con, "insert into user (name, mobile, email, password, branch, quali, exp, cgpa, ten, twelve, year, created_at) 
        values('$name','$mobile','$email','$pass','$branch','$qualification','$experience','$cgpa','$ten','$twelve','$year','$date')");

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }


}

?>