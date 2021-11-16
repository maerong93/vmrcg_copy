<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
<script>
// 글자수 제한

var char_min = parseInt(<?php echo $comment_min ?>); // 최소
var char_max = parseInt(<?php echo $comment_max ?>); // 최대
</script>
<?php
    include("./_common.php");

    $sql="SELECT count(*) as cnt  from scenario_qa where wr_id = {$wr_id}";
    $ro = sql_fetch($sql);
    $sql_qa = "select distinct qa_id from scenario_qa where wr_id = {$wr_id} order by qa_id asc";
    $result_qa = sql_query($sql_qa);
    $cnt = $ro['cnt'];
    $sql1 = "SELECT * FROM scenario_aw";
    $aw = sql_fetch($sql1);
    //echo $aw['sc_no'];
    //$result = sql_query($sql);    
    
?>
<button type="button" class="cmt_btn"><span class="total"><b>댓글</b> <?php echo $cnt; ?></span><span class="cmt_more"></span></button>
<!-- 댓글 시작 { -->
<section id="bo_vc">
    <h2>댓글목록</h2>
    <div>
        <ul class="gnb_menu" style="display:flex">
        <li class="gnb_menu li" style="margin-left:10px;"><a href="/board_main/vmrcg2/board.php?bo_table=free&wr_id=<?php echo $wr_id; ?>" style="font-size:25px;"><b>전체</b></a></li>
        <?php
            for($i=0;$row=sql_fetch_array($result_qa);$i++){

    
        ?>
            
        <?php
                if($row['qa_id'] > 0){
        ?>
            
            <li class="gnb_menu li" style="margin-left:10px;"><a href="/board_main/vmrcg2/board.php?bo_table=free&wr_id=<?php echo $wr_id; ?>&qa_id=<?=$row['qa_id']?>" style="padding-left:10px;border-left:2px solid black;font-size:25px;"><b>상태<?=$row['qa_id']?></b></a></li>
        <?php
                } //if문 닫음
            }   // for문 닫음
        ?>
        </ul>
    </div>
    <!-- 댓글 쓰기 시작 { -->
<aside id="bo_vc_w" class="bo_vc_w" style="margin-top:50px; border-bottom:3px solid black;">
    <h2>댓글쓰기</h2>
    <!-- <form name="fviewcomment" id="fviewcomment" action="<?php //echo $comment_action_url; ?>" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off"> -->
    <form name="fviewcomment" id="fviewcomment" action="write_comment_update.php" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>" id="w">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="comment_id" value="<?php echo $c_id ?>" id="comment_id">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="is_good" value="">

    <span class="sound_only">내용</span>
    <?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
    <textarea id="sc_content" name="sc_content" maxlength="10000" required class="required" title="내용" placeholder="댓글내용을 입력해주세요" 
    <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $c_wr_content; ?></textarea>
    <br><select name="qa_id" id="qa_id">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>

    </select>
    <label for="qa_id">상태</label>
    <br><input type="hidden" placeholder="오브젝트 명">
    <?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
    <script>
    $(document).on("keyup change", "textarea#wr_content[maxlength]", function() {
        var str = $(this).val()
        var mx = parseInt($(this).attr("maxlength"))
        if (str.length > mx) {
            $(this).val(str.substr(0, mx));
            return false;
        }
    });
    </script>
    <div class="bo_vc_w_wr">
        <div class="bo_vc_w_info">
            <!-- <?php if ($is_guest) { ?>
            <label for="wr_name" class="sound_only">이름<strong> 필수</strong></label>
            <input type="text" name="wr_name" value="<?php echo get_cookie("ck_sns_name"); ?>" id="wr_name" required class="frm_input required" size="25" placeholder="이름">
            <label for="wr_password" class="sound_only">비밀번호<strong> 필수</strong></label>
            <input type="password" name="wr_password" id="wr_password" required class="frm_input required" size="25" placeholder="비밀번호">
            <?php
            }
            ?>
            <?php
            if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) {
            ?>
            <span class="sound_only">SNS 동시등록</span>
            <span id="bo_vc_send_sns"></span>
            <?php } ?>
            <?php if ($is_guest) { ?>
                <?php echo $captcha_html; ?>
            <?php } ?>
        </div>
        <div class="btn_confirm">
        	<span class="secret_cm chk_box">
	            <input type="checkbox" name="wr_secret" value="secret" id="wr_secret" class="selec_chk">
	            <label for="wr_secret"><span></span>비밀글</label>
            </span> -->
            <button type="submit" id="btn_submit" class="btn_submit">댓글등록</button>
        </div>
    </div>
    </form>
</aside>
    <?php
    $wr_id = $_GET['wr_id'];
    $qa_id = $_GET['qa_id'];
    //$sql = "select * from scenario_qa where wr_id = {$wr_id} order by sc_no asc ";      
   // $sql = "select * from scenario_qa where wr_id = {$wr_id} order by sc_no asc ";                
    //$result1 = sql_query($sql);
    //$row = array();
    //echo $row['cnt'];
    //$cmt_amt = $row['cnt'];
    $data1 = array();
    
    $sql2 = "select * from scenario_qa where wr_id = {$wr_id} order by sc_no desc ";      // 댓글 전체 쿼리          
    $result2 = sql_query($sql2);

    $sql3 = "select * from scenario_qa where wr_id={$wr_id} and qa_id = {$qa_id}";     // 댓글 상태별 쿼리
    $result3 = sql_query($sql3);
    $j = 0;

    if($qa_id == 0){    //qa_id 가 0 일 때 전체  // 조건문 시작


    for($i = 0;$row2 = sql_fetch_array($result2); $i++){
        //echo $row2['sc_no'];
        //echo var_dump($row2);
        $data1[$j] = $row2;
        $tempQaData = $data1[$j];
        $j++;
        $data1[$j] = array();
        //echo var_dump($data1[$j]);
        //echo $tempQaData['sc_no'];
        $sqlAw = " SELECT * FROM scenario_aw WHERE sc_no = {$tempQaData['sc_no']}";
        //$sqlAw = " SELECT count(*) as cnt FROM scenario_aw WHERE sc_no = {$tempQaData['sc_no']}  ";
        //$sqlAw = " SELECT * FROM scenario_aw WHERE sc_no = 25 ";
        // $sqlAw = " SELECT count(*) FROM scenario_aw WHERE sc_no = 25 ";
        $result1 = sql_query($sqlAw);
        $rowAw = sql_fetch_array($result1);

        if($rowAw['sa_no'] != ""){
        
            $data1[$j]['sa_no'] = $rowAw['sa_no'];
            $data1[$j]['sc_no'] = $rowAw['sc_no'];
            $data1[$j]['sa_content'] = $rowAw['sa_content'];
            $data1[$j]['sa_codeName'] = $rowAw['sa_codeName'];
            $data1[$j]['sa_fileName'] = G5_DATA_URL."/audio/".$rowAw['sa_fileName'];
            $data1[$j]['sa_in_datetime'] = $rowAw['sa_in_datetime'];
            $j++;
        }else{

        }
    }

    } else if($qa_id=1){

        for($i = 0;$row3 = sql_fetch_array($result3); $i++){
            //echo $row2['sc_no'];
            //echo var_dump($row2);
            $data1[$j] = $row3;
            $tempQaData = $data1[$j];
            $j++;
            $data1[$j] = array();
            //echo var_dump($data1[$j]);
            //echo $tempQaData['sc_no'];
            $sqlAw = " SELECT * FROM scenario_aw WHERE sc_no = {$tempQaData['sc_no']}";
            //$sqlAw = " SELECT count(*) as cnt FROM scenario_aw WHERE sc_no = {$tempQaData['sc_no']}  ";
            //$sqlAw = " SELECT * FROM scenario_aw WHERE sc_no = 25 ";
            // $sqlAw = " SELECT count(*) FROM scenario_aw WHERE sc_no = 25 ";
            $result1 = sql_query($sqlAw);
            $rowAw = sql_fetch_array($result1);
    
            if($rowAw['sa_no'] != ""){
            
                $data1[$j]['sa_no'] = $rowAw['sa_no'];
                $data1[$j]['sc_no'] = $rowAw['sc_no'];
                $data1[$j]['sa_content'] = $rowAw['sa_content'];
                $data1[$j]['sa_codeName'] = $rowAw['sa_codeName'];
                $data1[$j]['sa_fileName'] = G5_DATA_URL."/audio/".$rowAw['sa_fileName'];
                $data1[$j]['sa_in_datetime'] = $rowAw['sa_in_datetime'];
                $j++;
            }else{
    
            }
        }

    }  // 조건문 종료
    
    //for ($i=0; $i < (count($data1)-1); $i++) {
    for ($i=0; $i < count($data1); $i++) {    
        //echo count($data1);
        $comment_id = $data1[$i]['sc_no'];
        $comment = $data1[$i]['sc_content'];
        $qaId = $data1[$i]['qa_id'];
        $fileName = G5_DATA_URL."/audio/".$data1[$i]['sn_fileName'];
        $regdate = $data1[$i]['sn_in_datetime'];
        $cmt_depth = "";
        // 댓글이라면 {
        if($data1[$i]['sa_no'] != ""){
            //echo "답변";
            $comment_id = $data1[$i]['sa_no'];
            $comment = $data1[$i]['sa_content'];
            $codeName = $data1[$i]['sa_codeName'];
            $fileName = $data1[$i]['sa_fileName'];
            $regdate = $data1[$i]['sa_in_datetime'];
            $nextId = $data1[$i]['qa_next_id'];
            $cmt_depth = 2 * 50;

        }
        // } 댓글이라면 

        if($comment_id == ""){
            continue;
        }
        

        $comment = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $comment);
        $cmt_sv = $cmt_amt - $i + 1; // 댓글 헤더 z-index 재설정 ie8 이하 사이드뷰 겹침 문제 해결
		$c_reply_href = $comment_common_url.'&amp;c_id='.$comment_id.'&amp;w=c#bo_vc_w';
		$c_edit_href = $comment_common_url.'&amp;c_id='.$comment_id.'&amp;w=cu#bo_vc_w';
        $is_comment_reply_edit = ($list[$i]['is_reply'] || $list[$i]['is_edit'] || $list[$i]['is_del']) ? 1 : 0;
	?>
    
	<article id="c_<?php echo $comment_id ?>" <?php if ($cmt_depth) { ?>style="margin-left:<?php echo $cmt_depth ?>px;border-top-color:#e0e0e0"<?php } ?>>
        <div class="pf_img"><?php echo get_member_profile_img($list[$i]['mb_id']);?></div>
        <div class="cm_wrap">
        
            <header style="z-index:<?php echo $i; ?>">
            
	            <h2><?php echo get_text($list[$i]['wr_name']); ?>님의 <?php if ($cmt_depth) { ?><span class="sound_only">댓글의</span><?php } ?> 댓글</h2>
	            <?php if ($is_ip_view) { ?>
	            <span class="sound_only">아이피</span>
	            <span>(<?php echo $list[$i]['ip']; ?>)</span>
	            <?php }  ?>
	            <span class="sound_only">작성일</span>
	            <span class="bo_vc_hdinfo"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $regdate ?></span>
	            <?php
	            include(G5_SNS_PATH.'/view_comment_list.sns.skin.php');
	            ?>
	        </header>
            
	        <!-- 댓글 출력 -->
	        <div class="cmt_contents">
            <span></span>  
                <?php if($cmt_depth){ ?>
	            <p>         
                    답변:
                    <?php if (strstr($list[$i]['wr_option'], "secret")) { ?><img src="<?php echo $dddd2_skin_url; ?>/img/icon_secret.gif" alt="비밀글"><?php } ?>
                    <!-- <input type="hidden" name="sc_no" class="sc_noo" value="<?php //echo $comment_id ?>"> -->
	                
                    <?php
                        
                    
                    $w = $_GET['w'];
                    if($w == 'cu'){
                        echo "<form method='post' action='updateComment.php?wr_id={$wr_id}'>
                            <input type='hidden' name='sc_no' value='{$comment_id}'>
                            <input type='text' name='sc_content' value='{$comment}'><br>
                            <input type='text' name='sc_codeName' value='{$codeName}'<br>
                            <button class='btn_cm_opt' type='submit'>수정</button></form>
                            ";
                    }else{
                        echo $comment;
                    }

                    ?>
	            </p>           
                <p>
                    <?php 
                        if($w == 'cu'){
                        }else{
                            echo "코드명: ".$codeName;
                        }
                    ?>       
                </p>
                <?php }else{ ?>
                    <p>         
                    질문:
                    <?php if (strstr($list[$i]['wr_option'], "secret")) { ?><img src="<?php echo $dddd2_skin_url; ?>/img/icon_secret.gif" alt="비밀글"><?php } ?>
                    
                    <!-- <input type="hidden" name="sc_no" class="sc_noo" value="<?php //echo $comment_id ?>"> -->
	                
                    <?php
                    $w = $_GET['w'];
                    if($w == 'cu'){
                        echo "<form method='post' action='updateComment.php?wr_id={$wr_id}'>
                            <input type='hidden' name='sc_no' value='{$comment_id}'>
                            <input type='text' name='sc_content' value='{$comment}'><br>
                            
                            <button class='btn_cm_opt' type='submit'>수정</button></form>
                            ";
                    }else{
                        echo $comment;
                    }
                    ?>
                    <br>
                    상태:
                    <?php echo $qaId ?>
	            </p>           
                <?php }?>
	            <?php 
                if($is_comment_reply_edit) {
	                if($w == 'cu') {
	                    $sql = " select wr_id, wr_content, mb_id from $write_table where wr_id = '$c_id' and wr_is_comment = '1' ";
	                    $cmt = sql_fetch($sql);
	                    if (!($is_admin || ($member['mb_id'] == $cmt['mb_id'] && $cmt['mb_id'])))
	                        $cmt['wr_content'] = '';
	                    $c_wr_content = $cmt['wr_content'];
	                }
				?>
	            <?php }?>
            
	        </div>
            
	        <span id="edit_<?php echo $comment_id ?>" class="bo_vc_w"></span><!-- 수정 -->
	        <span id="reply_<?php echo $comment_id ?>" class="bo_vc_w"></span><!-- 답변 -->
	        <input type="hidden" value="<?php echo strstr($list[$i]['wr_option'],"secret") ?>" id="secret_comment_<?php echo $comment_id ?>">
	        <textarea id="save_comment_<?php echo $comment_id ?>" style="display:none"><?php echo get_text($list[$i]['content1'], 0) ?></textarea>
            <input type="hidden" class="play_content" value="<?=$row[$i]['sc_content'];?>"/>
            <input type="hidden" class="play_id" value="<?=$i;?>"/>
            <button class="btn_cm_opt btn_b01 btn play_btn" onclick="tts_reply<?=$i;?>(); return false" value="<?php echo $i?>"><i class="far fa-play-circle"></i></button>
            <div id="player<?php echo $i?>"></div>
		</div>
        
		<div class="bo_vl_opt">
            <button type="button" class="btn_cm_opt btn_b01 btn"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">댓글 옵션</span></button>
        	<ul class="bo_vc_act">
            <?php
                $sql ="SELECT * FROM scenario_aw WHERE sc_no ='{$comment_id}'";
                $row = sql_fetch($sql);
                if(!$cmt_depth){
            ?>
                    <?php if($comment_id === $row['sc_no']){ ?>
                    
                    <li><a href="board.php?bo_table=free&wr_id=<?php echo $wr_id?>&w=cu" onclick="comment_box('<?php echo $comment_id ?>', 'cu'); return false;">수정</a></li>
                    <li><a href="deleteComment.php?sc_no=<?php echo $comment_id ?>" onclick="return comment_delete(<?php echo $comment_id ?>);">삭제</a></li>
                    <?php }else{?>
                        <li><a href="<?php echo $c_reply_href; ?>" onclick="comment_reply(<?php echo $comment_id?>); return false;">답변</a></li>
                        <li><a href="board.php?bo_table=free&wr_id=<?php echo $wr_id?>&w=cu" onclick="comment_box('<?php echo $comment_id ?>', 'cu'); return false;">수정</a></li>
                        <li><a href="deleteComment.php?sc_no=<?php echo $comment_id ?>" onclick="return comment_delete(<?php echo $comment_id ?>);">삭제</a></li>
                    <?php }?>
            <?php }else{?>
                <li><a href="board.php?bo_table=free&wr_id=<?php echo $wr_id?>&w=cu" onclick="comment_box('<?php echo $comment_id ?>', 'cu'); return false;">수정</a></li>
                <li><a href="deleteComment.php?sc_no=<?php echo $comment_id ?>" onclick="return comment_delete(<?php echo $comment_id ?>);">삭제</a></li>
            <?php } ?>
            </ul>

        </div>
        <div class="reply_<?php echo $comment_id; ?>" id="reply" style="display:none;">
        
            <form action="create_reply.php" method="post">             
                <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>"> 
                <input type="hidden" name="sc_no" value="<?php echo $comment_id ?>">
                <input type="hidden" name="codeName" value="<?php echo $codeName ?>">
                <div>
                <?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
                <textarea class="frm_input required" id="sa_content" name="sa_content" maxlength="10000" style="height:120px;width:930px;" required class="required" title="내용" placeholder="댓글내용을 입력해주세요" 
                <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $c_wr_content; ?></textarea>
                </div>
                <div>
                    <input class="frm_input input required" type="text" name="sa_codeName" placeholder="코드명">
                </div>
                <div>
                    <!-- <input class="frm_input input required" type="text" name="sa_codeName" placeholder="코드명"> -->
                    <select name="qa_next_id" id="qa_next_id">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select><label for="qa_next_id">상태</label>
                </div>
                <button type="submit" id="btn_submit1" class="btn_submit1">등록</button>
                <button class="btn_close" type="button" id="btn_cancel<?php echo $comment_id ?>" value="<?php echo $comment_id ?>">취소</button>
            </form>
        </div>
        
        <?php 
            
            include_once('../vmrcg2/t2s.php');
            $t2s = new PHP_Text2Speech; 
            
            $sql_delete = "select * from scenario_qa where sc_no = '{$comment_id}'";
            $result_delete = sql_query($sql_delete);
            $row_delete = sql_fetch_array($result_delete);
            $name = $row_delete['sn_fileName'];
            // echo $row_delete['sn_fileName'];
            $fname = trim(basename($t2s->speak($comment,'ko',$wr_id)));
            // unlink(G5_DATA_PATH."/audio/c8de37295b47aec416f54e31f59bd987.mp3");
            // unlink(G5_DATA_PATH."/audio/c8de37295b47aec416f54e31f59bd987.txt");
            //echo $fname;
            $sql = "
                    UPDATE scenario_qa
                    SET sn_fileName = '{$fname}',
                        sc_content = '{$comment}'                
                    WHERE sc_no = {$comment_id}
                    ";
            sql_query($sql);

            $sql1 = "
                    UPDATE scenario_aw
                    SET sa_fileName = '{$fname}',
                        sa_content = '{$comment}'                  
                    WHERE sa_no = {$comment_id}
                    ";
            sql_query($sql1);
            //echo substr(php_uname(),0,7);
        ?>
        <script>

            var tts = '';
            function tts_reply<?=$i;?>(){
                
                tts += "<audio controls='controls' autoplay='autoplay'>";
                tts += "<source src='/board_main/data/audio/<?php echo $fname ?>' type='audio/mp3' />";
                tts += "</audio>";

                console.log(tts);
                
                document.getElementById('player<?=$i;?>').innerHTML = tts;

                tts="";
                
                console.log("<?php echo $comment_id; ?>");

            }
            //location.reload();

			$(function() {
		        // 댓글 옵션창 열기
                $(".btn_cm_opt").on("click", function(){
                    $(this).parent("div").children(".bo_vc_act").show();
                });
                    
                // 댓글 옵션창 닫기
                $(document).mouseup(function (e){
                    var container = $(".bo_vc_act");
                    if( container.has(e.target).length === 0)
                    container.hide();
                });
		    });
            
            var cmt = $("#btn_cancel").val();

            $("#btn_cancel<?php echo $comment_id ?>").on("click",function(){
                $(".reply_<?php echo $comment_id ?>").css("display","none");

                var con = document.getElementById("bo_vc_w");
                con.style.display = "block";
            })  
            
		</script>
    </article>

    <?php }// article 반복문 종료
       // article 조건문 종료
    ?>

    <?php if ($i == 0) { //댓글이 없다면 ?><p id="bo_vc_empty">등록된 댓글이 없습니다.</p><?php } ?>

</section>
<!-- } 댓글 끝 -->
<script>
// $('.play_btn').click(function(){
//     console.log('클릭');

//     let $playParentObj = $(this).closest('.cmt_contents');
//     console.log($playParentObj);
//     let play_content_val = $playParentObj.find('.play_content').val();
//     console.log(play_content_val);
//     let play_id_val = $playParentObj.find('.play_id').val();
//     let tts = '';

//     // tts += "<audio controls='controls' autoplay='autoplay'>";
//     // tts += "<source src='' type='audio/mp3' />";
//     // tts += "</audio>";

//     tts += '<audio controls="controls" autoplay="autoplay">';
//     tts += '<source src="'+play_content_val+'" type="audio/mp3"> ';
//     tts += '</audio>';

//     console.log(tts);
//     $('#player'+play_id_val).html(tts);

//     try{
//         //document.getElementById('player'+play_id_val).innerHTML = tts;
        
//     }catch{

//     }
    
//     tts="";
// });

$(".cmt_contents").on("click",function(){
                // $.ajax({
                //     url: 'deleteComment.php',
                //     dataType: 'json',
                //     type: 'post',
                //     async: false,
                //     data: {
                //         sc_no: <?php //echo $comment_id ?>
                //     },
                //     success: function(e){
                //         console.log("성공");
                //     }
 });


  
</script>
<?php if ($is_comment_write) {
    if($w == '')
        $w = 'c';
?>

    <script>

        //let reply = document.getElementById('replyNo');
        function comment_reply(comment_id){
            //alert(comment_id);
            //let reply = document.getElementsByClassName("reply_"+comment_id);
            let reply = $(".reply_"+comment_id);
            let ccc = document.getElementById("c_"+comment_id);
            for(var i=0;i<reply.length;i++){
                console.log(reply[i]);
                replyNo = reply[i];
                reply.css("display","block");
                //reply[i].style.display = "block";
                //ccc.append(reply[i]);
            }

            var con = document.getElementById("bo_vc_w");
            con.style.display = "none";

            //reply.css("display","none");
                   
            //document.getElementById('reply')
        }
        
        <?php if($_GET['c_id'] && $w == 'c'){?>
            comment_reply(<?=$_GET['c_id']?>);
        <?php } ?>
    </script>


    <?php 
        //include_once("../vmrcg2/text2speech.php");
    ?>

<script>
var save_before = '';
var save_html = document.getElementById('bo_vc_w').innerHTML;

function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_vmrcg2_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": "",
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        f.wr_content.focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count'); 
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("댓글은 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("댓글은 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("댓글을 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('이름이 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('비밀번호가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

    <?php if($is_guest) echo chk_captcha_js();  ?>

    set_comment_token(f);

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

// function comment_box(comment_id, work)
// {
//     var el_id,
//         form_el = 'fviewcomment',
//         respond = document.getElementById(form_el);

//     // 댓글 아이디가 넘어오면 답변, 수정
//     if (comment_id)
//     {
//         if (work == 'c')
//             el_id = 'reply_' + comment_id;
//         else
//             el_id = 'edit_' + comment_id;
//     }
//     else
//         el_id = 'bo_vc_w';

//     if (save_before != el_id)
//     {
//         if (save_before)
//         {
//             document.getElementById(save_before).style.display = 'none';
//         }

//         document.getElementById(el_id).style.display = '';
//         document.getElementById(el_id).appendChild(respond);
//         //입력값 초기화 
//         try {
//             document.getElementById('wr_content').value = '';    
//         } catch (error) {
            
//         }
        
        
//         // 댓글 수정
//         if (work == 'cu')
//         {
//             document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
//             if (typeof char_count != 'undefined')
//                 check_byte('wr_content', 'char_count');
//             if (document.getElementById('secret_comment_'+comment_id).value)
//                 document.getElementById('wr_secret').checked = true;
//             else
//                 document.getElementById('wr_secret').checked = false;
//         }

//         document.getElementById('comment_id').value = comment_id;
//         document.getElementById('w').value = work;

//         if(save_before)
//             $("#captcha_reload").trigger("click");

//         save_before = el_id;
//     }
// }

function comment_delete(comment_id)
{
    $.ajax({
        url: 'deleteComment.php',
        dataType: 'json',
        type: 'post',
        async: false,
        data: {
            sc_no: comment_id
        },
        success: function(e){
            console.log("성공");
        }                   
    })

    return confirm("이 댓글을 삭제하시겠습니까?");
}

//comment_box('', 'c'); // 댓글 입력폼이 보이도록 처리하기위해서 추가 (root님)

<?php if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>

$(function() {
    // sns 등록
    $("#bo_vc_send_sns").load(
        "<?php echo G5_SNS_URL; ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table; ?>",
        function() {
            save_html = document.getElementById('bo_vc_w').innerHTML;
        }
    );
});
<?php } ?>

</script>
<?php } 
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<!-- } 댓글 쓰기 끝 -->
<script>
jQuery(function($) {            
    //댓글열기
    $(".cmt_btn").click(function(e){
        e.preventDefault();
        $(this).toggleClass("cmt_btn_op");
        $("#bo_vc").toggle();
    });
});
</script>