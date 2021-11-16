
<?php
include_once("./_common.php");
function getFileNames($directory) {

	$results = array(); 

	$handler = opendir($directory); 

	while ($file = readdir($handler)) { 

		if ($file != '.' && $file != '..' && is_dir($file) != '1') {

			$results[] = $file; 

		}

	} 

	closedir($handler); 

	return $results;

}

print_r(getFileNames("/audio/0ab4d197d0dced8e339ae60ed5541985.mp3"));

echo basename(G5_DATA_URL."/audio/65446ad16a744b4e3bf1e8cdf3f12e29.mp3");

?>