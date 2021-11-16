<?php

//---------------------------------------------
// JSON 관련 함수
//---------------------------------------------
function jsonResult($method, $result, $message) {
	$result_json = array(
			"method"	=> 	(string)$method,
			"result"	=>	(string)$result,
			"message"	=>	(string)$message
		);
	return $result_json;
}

function jsonResultSuccess($method, $message){
	return jsonResult($method, "Y", $message);
}

function jsonResultError($method, $message){
	return jsonResult($method, "N", $message);
}

function toJson($result_array){
	//echo my_json_encode($result_json); 
	//echo json_encode($result_array, JSON_UNESCAPED_UNICODE);
	//echo json_encode($result_array);
	$json_result = json_encode($result_array,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	$json_result = urldecode($json_result);
	echo $json_result;
	//echo iconv("CP949","UTF-8",$json_result);

} 

function getJson($result_array){
	return json_encode($result_array, JSON_UNESCAPED_UNICODE);
}

function my_json_encode($arr){
	array_walk_recursive(
		$arr, 
		function (&$item, $key) {
			if (is_string($item)) 
				$item = mb_encode_numericentity($item, array (0x80, 0xffff, 0, 0xffff), 'UTF-8'); 
			}
	);
			
    return mb_decode_numericentity(json_encode($arr), array (0x80, 0xffff, 0, 0xffff), 'UTF-8');
}

?>