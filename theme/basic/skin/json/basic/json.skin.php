<?php
/*
	2021-06-28
	설명 ; json form 페이지 처리
 */

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
//echo $json_skin_url.'/style.css';
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$json_skin_url.'/style.css">', 0);
?>

<!-- 회원정보 입력/수정 시작 { -->

<div class="register">
	<form id="form_send" name="form_send" target="resultFrame" action="<?php echo G5_URL.'/json/procs/proc_json.php' ?>" onsubmit="return false;" method="GET"  >
		<div id="register_form" class="form_01">   
			<div class="tbl_frm01 tbl_wrap register_form_inner">
				<h2>Json처리 (<?=$json_name;?>)</h2>
				<ul>
					<?php foreach($arr_formData as $formData){ ?>
						<li>
							<label for="<?php echo $formData['name'];?>" style="font-weight:bold;">
								<font style="color:red;"><?php echo $formData['essential']." ";?></font><?php echo $formData['info']."(".$formData['name'].")";?>
							</label>
							<?php 
								if($formData['type'] == "text"){ // input text 타입이라면
									echo '<input type="'.$formData['type'].'" name="'.$formData['name'].'" value="'.$formData['value'].'"  '.$formData['attr'].' class="frm_input full_input"/>';
								}else if($formData['type'] == "radio"){ // 라디오 버튼 이라면
									$i = 0;
									foreach($formData['value'] as $value){
										echo "<input type='".$formData['type']."' name='".$formData['name']."' value='".$value."' ".$formData['attr'][$i]." />".$formData['text'][$i]." (".$value.") ";
										$i++;
									}
								}
							?>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="btn_confirm">
			<a href="<?php echo G5_URL ?>" class="btn_close">메인으로 이동</a>
			<button type="button" id="btn_submit" class="btn_submit" onclick="formSubmit();">전송</button>
		</div>
	</form>
</div>
	<div id="register_form" class="form_01" style="margin-top:20px;">
		<div class="tbl_frm01 tbl_wrap register_form_inner">
			<h2>Json 결과</h2>
			<ul>
				<li>
					<label for="resultFrame">json결과</label>
					<iframe id="resultFrame" name="resultFrame" width="100%" height="500px"></iframe>
				</li>
			</ul>
		</div>
	</div>
<script>

function formSubmit(){
	var form_send = document.form_send;

	form_send.submit();
}
</script>

<!-- } 회원정보 입력/수정 끝 -->