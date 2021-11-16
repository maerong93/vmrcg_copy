<?php
include_once('./_common.php');


include_once('../head.php');


include_once(G5_VMRCG_PATH.'/board_head.php');
include_once($dddd_skin_path.'/list.skin.php');

if (isset($sn_no) && $sn_no) {
    include_once(G5_VMRCG_PATH.'/view.php');
}

include_once(G5_PATH.'/tail.php');
?>