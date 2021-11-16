<?php
    include_once('./_common.php');    
    $sc_no = $_POST['sc_no'];

    $sa_content = $_POST['sa_content'];
    $sa_codeName = $_POST['sa_codeName'];
    $codeName = $_POST['codeName'];
    $qa_next_id = $_POST['qa_next_id'];
    $sql="
        INSERT INTO scenario_aw(sc_no,sa_content,sa_codeName,sa_in_datetime,qa_next_id,qa_id)
        VALUES('{$sc_no}','{$sa_content}','{$sa_codeName}',now(),'{$qa_next_id}','{$codeName}')
    ";
    echo $sc_no;
    $result = sql_query($sql);
    header("Location:board.php?bo_table=free&wr_id={$wr_id}");
?>