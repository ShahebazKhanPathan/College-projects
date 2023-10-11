<?php

// INCLUDE DATABASE CONNECTION FILE
include('connection.php');

// COLLECT FORM DATA
$json = json_decode(file_get_contents("php://input"), true);

$cname = $_POST['cname'];
$jlocation = $_POST['jlocation'];
$jprofile = $_POST['jprofile'];
$jdescription = $_POST['jdescription'];
$branch = $_POST['branch'];
$qualification = $_POST['qualification'];
$experience = $_POST['experience'];
$salary = $_POST['salary'];
$eligibility = $_POST['eligibility'];
$vacancies = $_POST['vacancies'];
$date = date('d-F-Y');


// INSERT QUERY FOR ADDING NEW JOB
$query = mysqli_query($con, "insert into job (cname, jloc, jpro, jdes, branch, quali, exp, salary, eligibility, vacancy, created_at) 
values('$cname','$jlocation','$jprofile','$jdescription','$branch','$qualification','$experience', '$salary','$eligibility', '$vacancies', '$date')");


// RESPONSE
if ($query) {
    echo json_encode(1);
} else {
    echo json_encode(0);
}


?>