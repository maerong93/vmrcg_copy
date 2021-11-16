<?php

    include_once("./_common.php");
    // if($_POST["sn_usable"]){
    //     echo $_POST['sn_usable'];
    // }else{
    //     echo "error";
    // }
    $wr_id = $_POST['wr_id'];
    $sn_usable = $_POST['sn_usable'];
    echo $sn_usable;
    echo $wr_id;
    $sql = "UPDATE g5_write_free SET sn_use = '{$sn_usable}' WHERE wr_id = {$wr_id} ";

    sql_query($sql);
?>