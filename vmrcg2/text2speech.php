<?php
include_once('./_common.php');
//text2mp3.php

echo $wr_id;
$sql = "select * from scenario_qa where wr_id = {$wr_id}";
$row = sql_fetch($sql);
$comment = $row['sc_content'];
echo $comment;
if(!$comment) exit;
if(!$sn_voice) $sn_voice="FEMALE"; 

$q = trim($q);

//참조 https://cloud.google.com/text-to-speech/docs/voices?hl=ko
if(strtolower($sn_voice)=="male") $name="ko-KR-Standard-C";
else $name="ko-KR-Wavenet-B";

$s='{
  "input":{
    "text":"'.$comment.'"
  },
  "voice":{
    "languageCode":"ko-KR",
    "name":"'.$name.'",
    "ssmlGender":"'.$sn_voice.'"
  },
  "audioConfig":{
    "audioEncoding":"MP3"
  }
}';
 
 
//$vars=json_decode($s,true);
//Authorization: Bearer "$(gcloud auth application-default print-access-token)

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://texttospeech.googleapis.com/v1/text:synthesize"); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$s);  //Post Fields
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

/* $headers = [
     'Cache-Control: no-cache',
    'Content-Type: application/json; charset=utf-8',
    'X-Goog-Api-Key: AIzaSyCGW4TmawQJjgyPoA7yiSHI3boy6Ewkfrk'
 ];  */

$headers = [
    'Cache-Control: no-cache',
    'Content-Type: application/json; charset=utf-8',
    'X-Goog-Api-Key: AIzaSyDCuz7uaM5dZ-SeLJ6jJKSw_PF_ZMLNv1I'
 ]; 

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$server_output = curl_exec($ch);

curl_close($ch);

$tmp=json_decode($server_output,true);
//echo var_dump($server_output);
//echo "dddd";
if(!$play) {
	echo $tmp['audioContent'];
	//echo "헬로우";
	//file_put_contents('output.mp3', $audioContent);
}else{

	//echo "dddd";
	$fname='data/texttospeech_'.date("H").'.mp3';
	//@unlink($fname);
	$result=@file_put_contents($fname, base64_decode($tmp['audioContent']));

	if($result){
?>

	<audio controls>
	  <source src="<?=$fname?>" type="audio/mp3">
	Your browser does not support the audio element.
	</audio>

<?php
	}

}
//echo "Dddd";
?>