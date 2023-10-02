<?php

// start session
session_start();

// include database connection file
include('connect.php');

// decode json object 
$json = json_decode(file_get_contents("php://input"), true);


// Admin login
if ($json['call'] == 2) {
    $uid = $json['uid'];
    $pass = $json['pass'];

    $real_id = 123;
    $real_pass = 456;

    if ($uid==$real_id and $pass==$real_pass) {
        $_SESSION['uid'] = $uid;
        echo json_encode(1);
    } else {
        echo json_encode(0);
    }

}

// Add student
if ($json['call'] == 3) {

    $name = $json['name'];
    $fname = $json['fname'];
    $roll = $json['roll'];
    $semester = $json['semester'];
    $branch = $json['branch'];
    $date = date('d-m-Y');

    $check = mysqli_query($con, "select * from student where roll_no='$roll' and branch='$branch' and semester='$semester'");

    if (mysqli_num_rows($check) > 0) {
        echo json_encode(2);
    } else {
        $query = mysqli_query($con, "insert into student (name, roll_no, fname, semester, branch, created_at) values('$name','$roll','$fname','$semester', '$branch', '$date')");
        if ($query) {
            echo json_encode($response['success'] = 1);
        } else {
            echo json_encode($response['success'] = 0);
        }
    }
}

// Get students
if ($json['call'] == 4) {
    $getStudents = mysqli_query($con, "select * from student");
    if (mysqli_num_rows($getStudents) > 0) {
        $students = mysqli_fetch_all($getStudents, MYSQLI_ASSOC);
        $empty = mysqli_free_result($getStudents);
        echo json_encode($students);
    } else {
        echo json_encode($response['success'] = 0);
    }
}

// Add record
if ($json['call'] == 8) {

    $sid = $_SESSION['sid'];
    $subname = $json['subname'];
    $subcode = $json['subcode'];
    $subtype = $json['subtype'];
    $midmarks = $json['midmarks'];
    $sessionalmarks = $json['sessionalmarks'];
    $endmarks = $json['endmarks'];
    $date = date('d-m-Y');

    $check = mysqli_query($con,"select * from record where sname='$subname' and sid='$sid'");
    if(mysqli_num_rows($check)>0){
        echo json_encode(2);
    }
    else{
        $insert = mysqli_query($con,"insert into record (sid, sname, scode, stype, midmarks, sessionmarks, endmarks, created_at) 
        values ('$sid','$subname','$subcode','$subtype','$midmarks','$sessionalmarks','$endmarks','$date')");
    
        if($insert) {
            echo json_encode($response['success'] = 1);
        } else {
            echo json_encode($response['success'] = 0);
        }
    }

    
}

// Get records
if ($json['call'] == 9) {
    $sid = $_SESSION['sid'];
    $getRecords = mysqli_query($con, "select sname, scode, stype, midmarks, sessionmarks, 
    endmarks from record WHERE sid='$sid' ");
    if (mysqli_num_rows($getRecords) > 0) {
        $records = mysqli_fetch_all($getRecords, MYSQLI_ASSOC);
        $empty = mysqli_free_result($getRecords);
        echo json_encode($records);
    } else {
        echo json_encode($response['success'] = 0);
    }
}

// create session for id
if ($json['call'] == 12) {
    $sid = $json['sid'];
    $_SESSION['sid'] = $sid;
    echo json_encode(1);
}

// get student detail
if ($json['call'] == 13) {
    $sid = $_SESSION['sid'];
    $check = mysqli_query($con, "select * from student where id='$sid'");
    if (mysqli_num_rows($check) > 0) {
        $detail = mysqli_fetch_array($check, MYSQLI_ASSOC);
        $empty = mysqli_free_result($check);
        echo json_encode($detail);
    } else {
        echo json_encode($response['success'] = 0);
    }
}


?>