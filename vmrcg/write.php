<?php
include_once('./_common.php');
include_once(G5_EDITOR_LIB);
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');



include_once(G5_PATH.'/head.sub.php');
@include_once ($dddd_skin_path.'/write.head.skin.php');
include_once('./board_head.php');

$action_url = https_url(G5_BBS_DIR)."/write_update.php";

echo '<!-- skin : '.(G5_IS_MOBILE ? $board['bo_mobile_skin'] : $board['bo_skin']).' -->';
include_once ($dddd_skin_path.'/write.skin.php');

include_once('./board_tail.php');
@include_once ($dddd_skin_path.'/write.tail.skin.php');
include_once(G5_PATH.'/tail.sub.php');
?>