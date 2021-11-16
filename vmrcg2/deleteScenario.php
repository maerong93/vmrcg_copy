<?php
    include_once('./_common.php');
    $wr_id = $_GET['wr_id'];
    
    $sql = "DELETE FROM g5_write_free WHERE wr_id = '{$wr_id}' ";

    // 시나리오 삭제
    $result = sql_query($sql);
    
    $row = sql_fetch($sql);
   

    // 시나리오 삭제 시 해당 답변들도 삭제

    if($row['wr_id']==""){

        $sql = "DELETE FROM scenario_qa WHERE wr_id = '{$wr_id}'";
        sql_query($sql);
    }

    header("Location:board.php?bo_table=free")

?>