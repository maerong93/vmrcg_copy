<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once('./_common.php');

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

include_once("PHP_Text2Speech.class.php");
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$dddd2_skin_url.'/style.css">', 0);
?>

<div>
    <iframe name="json1" id="json1" src="json_data.php" frameborder="0"></iframe>
    <?php 
    
    ?> 
</div>
