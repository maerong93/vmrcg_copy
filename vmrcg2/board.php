<?php
include_once('./_common.php');

include_once('../head.php');

include_once(G5_VMRCG2_PATH.'/board_head.php');

if (isset($wr_id) && $wr_id) {
    
    include_once(G5_VMRCG2_PATH.'/view.php');

}else{
    // 쿼리 write 테이블 
    // list 배열 생성
    // for 문에서 $row 값을 list 배열에 push
    $sql = " SELECT * FROM g5_write_free ";

    $result = sql_query($sql);

    $list = array();

    for($i = 0; $row = sql_fetch_array($result); $i++){

        $list[$i] = $row;

    }
    include_once("./list.php");
    // include_once($dddd2_skin_path.'/list.skin.php');

    //include_once('C:/vmrcg2/board_main/theme/basic/skin/dddd2/basic/list.skin.php');
    
}


// if ($member['mb_level'] >= $board['bo_list_level'] && $board['bo_use_list_view'] || empty($wr_id))
//     include_once (G5_VMRCG2_PATH.'/list.php');

include_once(G5_PATH.'/tail.php');
?>