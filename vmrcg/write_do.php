<?php
    $conn = mysqli_connect("localhost","root","autoset","vmrcg");

    if(!$conn){
        die("실패".mysqli_error());
    }
    $sn_subject = $_POST['sn_subject'];
    $sn_explanation = $_POST['sn_explanation'];
    $sql = "
            INSERT INTO g5_write_free(sn_subject,sn_explanation,sn_in_datetime)
            VALUES('{$sn_subject}','{$sn_explanation}',now())
    ";
    $result = mysqli_query($conn,$sql);
    header("Location:board.php");
?>