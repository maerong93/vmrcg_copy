<?php 
    include_once('./_common.php');
    $prevPage = $_SERVER['HTTP_REFERER'];


    $sc_no = $_GET['sc_no'];
    
    $sql = "delete from scenario_qa where sc_no = {$sc_no}";
    echo $sc_no;
    $result = sql_query($sql);
    $sa_no = $_GET['sc_no'];
    $sql1 = "delete from scenario_aw where sa_no = {$sa_no}";
    $result1 = sql_query($sql1);
    
    $sql2 = "delete from scenario_aw where sc_no = {$sc_no}";
    $result2 = sql_query($sql2);
    //unlink() 디렉토리 내 해당 파일 삭제
    
    
    $sql_name_del = "SELECT sn_fileName FROM scenario_qa WHERE sc_no = {$sc_no}";
    $row = sql_fetch($sql_name_del);
    echo $sc_no;
    echo $row['sn_fileName'];

    if(isset($row)){
        echo $row['sn_fileName']."<br>";
        unlink(G5_DATA_PATH."/audio/".$row['sn_fileName']);
        $rename =str_replace("mp3","txt",$row['sn_fileName']);
        echo $rename;
        unlink(G5_DATA_PATH."/audio/".$rename);
    }
    // echo "Ddd";
    // echo $prevPage."Dd";
    header("Location:".$prevPage);

    
?>
