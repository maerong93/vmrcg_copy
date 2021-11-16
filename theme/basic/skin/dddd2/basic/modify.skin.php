<?php
    if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
    add_stylesheet('<link rel="stylesheet" href="'.$dddd2_skin_url.'/style.css">', 0);
    //include_once('write.php');
    $sql ="select * from g5_write_free where wr_id = '{$wr_id}'";
    $row = sql_fetch($sql);
?>

<section id="bo_w">
    <h2 class="sound_only"><?php echo "시나리오 리스트 수정" ?></h2>

    <form name="fwrite" id="fwrite" action="modify.php" method="post">
        <!-- <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>"> -->
        <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">

    <div class="bo_w_tit write_div">
        <label for="sn_subject" class="sound_only">제목<strong>필수</strong></label>
        
        <div id="autosave_wrapper" class="write_div">
            <input type="text" name="sn_subject" value="<?php echo $row['sn_subject'] ?>" id="sn_subject" class="frm_input full_input required" size="50" maxlength="255" placeholder="제목">
        </div>
        
    </div>

    <div class="bo_w_select half_select write_div required">
        <select name="sn_scene" id="sn_scene">
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
        </select>
    </div>

    <div class="write_div">
        <label for="wr_content" class="sound_only">내용<strong>필수</strong></label>
        <div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
            <textarea name="sn_explanation" id="sn_explanation" cols="30" rows="10" style="height:300px;"><?php echo $row['sn_explanation'] ?></textarea>
        </div>
        
    </div>
    <div class="write_div">
        <input type="radio" name="gender" id="male" value="male" <?php if($row['sn_voice']=='male') echo "checked" ?> > 남자
        <input type="radio" name="gender" id="female" value="female" <?php if($row['sn_voice']=='female') echo "checked" ?>> 여자
    </div>

    <div class="btn_confirm write_div">
        <a href="<?php echo get_pretty_url($bo_table); ?>" class="btn_cancel btn">취소</a>
        <button type="submit" id="btn_submit" accesskey="s" class="btn_submit btn">수정</button>
    </div>
    </form>
</section>
<script>
    var modi_btn = document.getElementById('btn_submit');
   // modi_btn.click = alert("dddd");
    

</script>