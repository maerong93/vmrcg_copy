<?php
    include_once("./_common.php");

    include_once("./t2s.php");
    $prevPage = $_SERVER['HTTP_REFERER'];
    $wr_id = $_POST['wr_id'];
    $sn_subject = $_POST['sn_subject'];
    $sn_explanation = $_POST['sn_explanation'];
    $sn_scene = $_POST['sn_scene'];
    $sn_voice = $_POST['gender'];

    $update = G5_TIME_YMDHIS;

    $sql =
            "UPDATE g5_write_free
            SET sn_subject = '{$sn_subject}',
            sn_explanation = '{$sn_explanation}',
            sn_scene = '{$sn_scene}',
            sn_voice = '{$sn_voice}',
            sn_up_datetime = '{$update}'
            where wr_id = '{$wr_id}'
            ";
    sql_query($sql);
    $sql1 = "SELECT *
            FROM g5_write_free
            WHERE wr_id ='{$wr_id}'
            ";
    $result = sql_query($sql1);

    $data = array();
    $sql4 = "select * from scenario_qa where wr_id = {$wr_id} order by sc_no asc ";                
    $result4 = sql_query($sql4);


    for($i=0;$row=sql_fetch_array($result4);$i++){
        
        $sc_no = $row['sc_no'];
        $wr_id = $row['wr_id'];
        $sc_content = $row['sc_content'];
        $sn_in_datetime = $row['sn_in_datetime'];
        //echo $sc_no;
        $sql2 = "SELECT *
        FROM scenario_qa
        WHERE sc_no = '{$sc_no}'
        ";
        
        $fname = $row['sn_fileName'];
        $sc_content = $row['sc_content'];
        unlink(G5_DATA_PATH."/audio/".$fname);
        unlink(G5_DATA_PATH."/audio/".str_replace("mp3","txt",$fname));

        $sql3 = "UPDATE scenario_qa 
                SET
                    sn_fileName ='',
                    sc_content='{$sc_content}',
                    sn_up_datetime = '{$update}'
                WHERE sc_no='{$sc_no}'
                ";
        echo "질문: ".$sc_content."<br>";
        sql_query($sql3);

        $data[$i] = $sc_no;
        echo $fname."<br>";
        

    }
    echo var_dump($data)."<br>";  
    //echo $data['sc_no']."<br>";
    for($j=0;$j < count($data);$j++){
        $sc_no = $data[$j];
        //echo $sc_no."<br>";
        
        $sql5 = "SELECT * FROM scenario_aw WHERE sc_no ='{$sc_no}'";
        $dddd = sql_query($sql5);
        $row = sql_fetch_array($dddd);
        $sa_no = $row['sa_no'];
        $sa_content = $row['sa_content'];
        $fname1 = $row['sa_fileName'];
        echo $fname1;
        if($sa_no !=''){
            
            unlink(G5_DATA_PATH."/audio/".$fname1);
            unlink(G5_DATA_PATH."/audio/".str_replace("mp3","txt",$fname1));
            echo "답변: ".$sa_content."<br>";
            $sql6 = "UPDATE scenario_aw 
                    SET 
                        sa_fileName = '', 
                        sa_content='{$sa_content}',
                        sa_up_datetime = '{$update}'
                    WHERE sa_no = {$sa_no}
                    ";
            sql_query($sql6);
            
            $fname = $row['sa_fileName'];
        }
    }
    header("location:board.php?bo_table=free");
    //header("location:board.php?bo_table=free&wr_id={$wr_id}");
?>