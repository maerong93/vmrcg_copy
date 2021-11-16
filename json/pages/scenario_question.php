<?php 
/*
$arr_formData = array(
	array(
		essential => "*",
		type => "text"	,
		name => "name"	,
		info => $proc_info	,
		value => $proc_name,
		attr => " readonly "
	),
	array(
		essential => "*",
		type => "text"	,
		name => "text"	,
		info => "텍스트 타입"	,
		value => "",
		attr => ""
	),
	array(
		essential => "*",
		type => "checkbox"	,
		name => "checkbox"	,
		info => "체크박스 타입"	,
		value => "Y",
		attr => "",
		text => "지우기"
	),
	array(
		essential => "*",
		type => "file"	,
		name => "file"	,
		info => "이미지 파일"	,
		value => "",
		attr => " accept='image/*' "
	),
	array(
		essential => "*",
		type => "textarea"	,
		name => "textarea"	,
		info => "텍스트에어리어"	,
		value => "ㅁㅁㅁ",
		attr => ""
	),
	array(
		essential 	=> "",
		type 		=> "select"	,
		name 		=> "select"	,
		info 		=> "셀렉트"	,
		value 		=> array("value1", "value2", "value3"),
		attr 		=> "" ,
		text 		=> array("값1", "값2", "값3")
	),
	array(
		essential 	=> "",
		type 		=> "radio"	,
		name 		=> "radio"	,
		info 		=> "라디오"	,
		value 		=> array("Y", "N"),
		attr 		=> array(" checked ", ""),
		text 		=> array("허용", "거부")
	),
);

*/

$json_name = "scenario_question";

$arr_formData = array(

	array(
		'essential' 	=> "*" ,
		'type'		=> "text" ,
		'name'		=> "json_name" ,
		'info'		=> "** 호출 이름 **" ,
		'value' 		=> $json_name ,
		'attr' 		=> " readonly "
    ),
	array(
		'essential' => "*" ,
		'type'		=> "text" ,
		'name'		=> "SID" ,
		'info' 		=> "시나리오번호" ,
		'value' 		=> "" ,
		'attr' 		=> ""
    ),
	array(
		'essential' => "*",
		'type' => "text",
		'name' => "qa_id",
		'info' => "질문아이디",
		'value' => "",
	),
    array(
		'essential' 	=> "*" ,
		'type'		=> "text" ,
		'name'		=> "qa" ,
		'info' 		=> "질문" ,
		'value' 		=> "" ,
		'attr' 		=> ""
    ),
);
?>