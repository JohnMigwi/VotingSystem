1<?php

    session_start();
    include 'connect.php';
    $unique_id = $_SESSION['unique_id'];

    $candidateID = $_POST['candidateID'];
    
    $query = "SELECT * FROM users WHERE unique_id = '{$unique_id}'";
    $sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($sql);
    if($row['status'] == 'notvoted'){
        
        $query = "SELECT * FROM candidates WHERE candidateID = '{$candidateID}'";
        $sql = mysqli_query($conn, $query);
        if($sql){
            $row = mysqli_fetch_assoc($sql);
            $votes = $row['votes'];
            $votes = (int)$votes;
            $votes = $votes + 1;
            $query2 = "UPDATE candidates SET votes = '{$votes}' WHERE candidateId = '{$candidateID}'";
            $sql2 = mysqli_query($conn, $query2);
            if($sql2){
                $query3 = "UPDATE users SET status = 'voted' WHERE unique_id = '".$_SESSION['unique_id']."'";
                $sql3 = mysqli_query($conn, $query3);
                if($sql3){
                    echo "you have voted successfully";
                }
            }else{
                echo "you have voted!!";
            }
        }else{
            echo "error";
        }

    }else{
        echo "you cannot vote again!";
    }




?>