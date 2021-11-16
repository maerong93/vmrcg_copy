<?php 
    // 시나리오 정보 json 처리

    $SID = $_GET['SID']; // 시나리오 번호

    // 시나리오 존재 여부 확인 {
    $sql = "
            SELECT sn_scene
              FROM g5_write_free
             WHERE sn_scene = '{$SID}'        
    ";
    $row = sql_fetch($sql);
    if($row['sn_scene'] == ""){
        $result_json[JSON_RESULT_NAME] = jsonResultError($jsonName, urlencode("존재하지 않는 시나리오번호입니다."));
        toJson($result_json);
        exit();
    }
    // } 시나리오 존재 여부 확인 

    // 시나리오 정보 출력 {
    $sql = "
            SELECT sn_scene
                 , sn_subject
                 , sn_explanation
                 , sn_scene
              FROM g5_write_free
             WHERE sn_scene = '{$SID}'        
    ";
    $row = sql_fetch($sql);
    $result_json[JSON_RESULT_NAME] = jsonResultSuccess($jsonName, urlencode("시나리오 존재합니다."));//토큰값이 수정되었습니다.
    $result_json['item'][] = $row;
    toJson($result_json);
	exit();
    // } 시나리오 정보 출력 
?>