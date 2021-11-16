<?php 
    include_once('./_common.php');
    $prevPage = $_SERVER['HTTP_REFERER'];


    $sc_no = $_POST['sc_no'];
    $sc_content= $_POST['sc_content'];
    echo $sc_no;
    echo $sc_content;
    $sql = "
            UPDATE scenario_qa
            SET sc_content = '{$sc_content}',
            sc_codeName = '{$sc_codeName}'
            WHERE sc_no = '{$sc_no}'
    ";
    $result = sql_query($sql);

    $sa_no = $_GET['sc_no'];
    $sql1 = "
            UPDATE scenario_aw
            SET sa_content = '{$sc_content}',
            sa_codeName = '{$sc_codeName}'
            WHERE sa_no = '{$sc_no}'
    ";
    $result1 = sql_query($sql1);
    

    header("Location:board.php?bo_table=free&wr_id={$wr_id}");
    
?>
