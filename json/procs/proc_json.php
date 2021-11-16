<?php 
    /*
        form 태그 처리 URL
    */
    header('Content-type: text/html; charset=utf-8');
    include_once('./_common.php');
    include_once(G5_LIB_PATH.'/func_json.php'); // json 관련 함수 인클루드
    $jsonName = $_REQUEST['json_name']; // jsonName 파라미터

    $path = G5_PATH."/json/procs/proc_".$jsonName.".php";

    //json_name 으로 없는 파일을 요청한다면 에러 표출
    if(!file_exists($path)){
        $result_json[JSON_RESULT_NAME] = jsonResultError($jsonName, urlencode("존재하지 않는 json_name 입니다."));
	    toJson($result_json);
        exit();
    }    
    include($path); // 백엔드 처리후 json 출력
?>