<?php 
    // 시나리오 리스트 json 처리
    $sql = "
                SELECT wr_id
                     , sn_subject
                     , sn_explanation
                     , sn_scene
                  FROM g5_write_free        
                 ORDER BY wr_id
    ";
    $result = sql_query($sql);
    $result_json[JSON_RESULT_NAME] = jsonResultSuccess($jsonName, urlencode("."));
    for($i = 0; $row = sql_fetch_array($result); $i++){
        $result_json['item'][] = $row;
    }
    toJson($result_json);
	exit();
?>