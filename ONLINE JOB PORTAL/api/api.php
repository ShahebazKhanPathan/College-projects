<?php
session_start();

// CONNECTION
include('connection.php');

// JSON OBJECT DECODING
$json = json_decode(file_get_contents("php://input"), true);


// LOGIN
if ($json['call'] == 1) {

    $mobile = $json['mobile'];
    $pass = $json['pass'];

    $query = mysqli_query($con, "select * from user where mobile='$mobile' and password='$pass'");
    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_array($query)) {
            $id = $data['id'];
            $branch = $data['branch'];
            $_SESSION['user_id'] = $id;
            $_SESSION['branch'] = $branch;
            echo json_encode(1);
        }
    } else {
        echo json_encode(0);
    }
}

// FETCH JOBS BY USER BRANCH
if ($json['call'] == 2) {

    $id = $_SESSION['user_id'];
    $branch = $_SESSION['branch'];

    $getJobs = mysqli_query($con, "select * from job where branch='$branch'");

    if (mysqli_num_rows($getJobs) > 0) {
        $jobs = mysqli_fetch_all($getJobs, MYSQLI_ASSOC);
        $empty = mysqli_free_result($getJobs);
        echo json_encode($jobs);
    } else {
        echo json_encode(0);
    }
}


// JOB APPLY BY USER
if ($json['call'] == 4) {

    $jid = $json['jid'];
    $uid = $_SESSION['user_id'];
    $date = date('d-m-Y');

    $check = mysqli_query($con, "select * from application where uid='$uid' and jid='$jid'");
    if (mysqli_num_rows($check) > 0) {
        echo json_encode(2);
    } else {
        $query = mysqli_query($con, "insert into application (uid, jid, date) values('$uid','$jid','$date')");
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

}

// FETCH USER DATA 
if ($json['call'] == 5) {

    $id = $_SESSION['user_id'];
    $getData = mysqli_query($con, "select * from user where id='$id'");

    if (mysqli_num_rows($getData) > 0) {
        $data = mysqli_fetch_all($getData, MYSQLI_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(0);
    }
}

// FETCH APPLIED JOBS BY USER ID 
if ($json['call'] == 6) {

    $id = $_SESSION['user_id'];
    $getData = mysqli_query($con, "select job.cname, job.jloc, job.jpro, application.date  from job left join application on application.jid=job.id where application.uid='$id'");

    if (mysqli_num_rows($getData) > 0) {
        $data = mysqli_fetch_all($getData, MYSQLI_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(0);
    }
}

// FETCH JOB APPLICATIONS 
if ($json['call'] == 7) {

    $getData = mysqli_query($con, "select user.name, user.mobile, job.cname, job.jpro, application.date from user left join application on user.id=application.uid left join job on job.id=application.jid where user.id=application.uid");

    if (mysqli_num_rows($getData) > 0) {
        $data = mysqli_fetch_all($getData, MYSQLI_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(0);
    }
}

// FETCH ALL JOBS
if ($json['call'] == 11) {

    $getJobs = mysqli_query($con, "select * from job");

    if (mysqli_num_rows($getJobs) > 0) {
        $jobs = mysqli_fetch_all($getJobs, MYSQLI_ASSOC);
        $empty = mysqli_free_result($getJobs);
        echo json_encode($jobs);
    } else {
        echo json_encode(0);
    }
}

?>