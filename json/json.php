<?php 
    include_once('./_common.php');

    include_once('./jsonMenu.php'); 

    $g5['title'] = 'json';
    include_once(G5_PATH.'/_head.php');
    
    if($jsonName != ""){
        include_once(G5_JSON_PATH.'/pages/'.$jsonName.".php");
        include_once($json_skin_path.'/json.skin.php');
    }

    $is_aside_view = "display:none"; // 오른쪽 로그인 aside 가림
    include_once(G5_PATH.'/_tail.php');
?>