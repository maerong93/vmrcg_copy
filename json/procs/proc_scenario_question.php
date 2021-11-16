<?php 
    // 질문 답변 json 처리 


    $SID = $_GET['SID']; // 시나리오 번호
    $qa = $_GET['qa']; // 질문
    $qa_id = $_GET['qa_id']; //질문 아이디


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

    // 시나리오의 질문이 존재하는지 확인 {
    $sql = "
        SELECT COUNT(sc_no) AS sc_noCnt
        FROM scenario_qa    
        WHERE sn_scene = '{$SID}'
    ";
    $row = sql_fetch($sql);
    if($row['sc_noCnt'] == 0){
        $result_json[JSON_RESULT_NAME] = jsonResultError($jsonName, urlencode("질문 데이터가 하나도 없습니다."));
        toJson($result_json);
        exit();
    }
    // } 시나리오의 질문이 존재하는지 확인 


    // 해당 질문의 답변 출력 {
    $mp3URL = G5_DATA_URL.'/audio/';
    $sql = "
            SELECT sc_no
                , wr_id
                , sc_content
                , qa_id
                , sn_scene
            FROM scenario_qa
            WHERE sn_scene = '{$SID}' and qa_id = '{$qa_id}'
    ";
    $result = sql_query($sql);
    $sc_contentArr = array(); // 질문 데이터 
    for($i = 0; $row = sql_fetch_array($result); $i++){
        $sc_contentArr[$i] = $row;
    }
    $searchString =" ";
    $replaceString = "";
    $TopSimilarityPercentData = ["sc_no" => "", "percent" => 0, "sc_content" => "", "sn_fileName" => ""]; // 제일 근접한 질문
    
    for($i = 0; $i < count($sc_contentArr); $i++){
        $topPercentData = array();
        similar_text($qa , str_replace($searchString,$replaceString,$sc_contentArr[$i]['sc_content']), $percent1);  //공백 입력 시 search 안됨
        similar_text(str_replace($searchString,$replaceString,$sc_contentArr[$i]['sc_content']) , $qa, $percent1);  //공백 입력 시 search 안됨
        // similar_text($qa , $sc_contentArr[$i]['sc_content'], $percent1);
        // similar_text($sc_contentArr[$i]['sc_content'] , $qa, $percent2);

        if($percent1 > $percent2){
            $topPercentData = $sc_contentArr[$i];
            $topPercentData['percent'] = $percent1;

        }else{
            $topPercentData = $sc_contentArr[$i];
            $topPercentData['percent'] = $percent2;
        }

        if($TopSimilarityPercentData['percent'] < $topPercentData['percent']){
            $TopSimilarityPercentData['sc_no'] = $topPercentData['sc_no'];
            $TopSimilarityPercentData['percent'] = $topPercentData['percent'];
            $TopSimilarityPercentData['sc_content'] = $topPercentData['sc_content'];            
            $TopSimilarityPercentData['sn_fileName'] = $topPercentData['sn_fileName'];
        }
    }
    

    if($TopSimilarityPercentData['sc_no'] == ""){
        $result_json[JSON_RESULT_NAME] = jsonResultError($jsonName, urlencode("등록된 답변이 없습니다."));
        toJson($result_json);
        exit();

    }else{

        $sql = "
                SELECT sa_no
                    , sc_no
                    , sa_content
                    , sa_codeName
                    , qa_next_id
                    , CONCAT('{$mp3URL}', sa_fileName) AS fileName
                FROM scenario_aw
                WHERE sc_no = '{$TopSimilarityPercentData['sc_no']}'
        ";
        $row = sql_fetch($sql);
        $result_json[JSON_RESULT_NAME] = jsonResultSuccess($jsonName, urlencode("답변이 존재합니다."));//토큰값이 수정되었습니다.
        $result_json['item'][] = $row;
        toJson($result_json);
        exit();
        // if($TopSimilarityPercentData['percent'] >= 50){
        //     $result_json[JSON_RESULT_NAME] = jsonResultSuccess($jsonName, urlencode("답변이 존재합니다."));//토큰값이 수정되었습니다.
        //     $result_json['item'][] = $row;
        //     toJson($result_json);
        //     exit();
        // }else{
        //     $result_json[JSON_RESULT_NAME] = jsonResultSuccess($jsonName, urlencode("답변이 존재합니다."));//토큰값이 수정되었습니다.
        //     $result_json['item'][] = $row;
        //     toJson($result_json);
        //     exit();
        // }
        
    }
    // } 해당 질문의 답변 출력 

?>