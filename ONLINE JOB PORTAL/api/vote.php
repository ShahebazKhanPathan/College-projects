<?php

// IMPORT DATABASE CONNECTION FILE
include('connection.php');

session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(!isset($_SESSION['user_id'])){
        echo '<script>
        alert("Login is required!");
        window.location="../";
        </script>'; 
    }
    else{
        $oid = $_POST['option'];
        $uid = $_SESSION['user_id'];
        $pid = $_POST['pid'];
    
        $check = mysqli_query($con, "select * from voting where uid='$uid' and pid='$pid' ");
    
        if(mysqli_num_rows($check)>0){
            echo '<script>
                    alert("You already voted!");
                    history.back();
                    </script>';
        }
        else
        {
            $option = mysqli_query($con, "select votes from options where id='$oid'");
            $fetch = mysqli_fetch_array($option);
            $votes = $fetch['votes']+1;
            $update = mysqli_query($con, "update options set votes='$votes' where id='$oid'");
            $query = mysqli_query($con, "insert into voting (uid, pid, oid) values('$uid','$pid', '$oid')");
            
            if($query and $update){
                echo '<script>
                    alert("Voting successfull!");
                    history.back();
                    </script>';
            }
            else{
                echo '<script>
                    history.back();
                    window.location="../routes/main.php";
                    </script>';
            }
        }
    }

    

   
}


?>