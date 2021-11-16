<?php

//구글 클라우드 인증 정보 json화일이 저장된 경로
putenv(G5_DATA_PATH.'/data/vchatttsdownload/simprec-5a1ecc447fb0.json');

include_once('./_common.php');


//print_r($argv);
$str = $argv[2];//"아이가 식탁에 앉아서 밥을 먹지 않아요. 밥먹는 투정도 하는듯 하고요 이럴땐 어떻게 하는게 좋을까요?";//
$wr_id = $argv[3];

//exit;

//echo phpinfo();
//exit;
//
// includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';

// Imports the Cloud Client Library
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;


// instantiates a client
$client = new TextToSpeechClient();

// sets text to be synthesised
$synthesisInputText = (new SynthesisInput())
    ->setText($str);

// build the voice request, select the language code ("en-US") and the ssml
// voice gender
$voice = (new VoiceSelectionParams())
    ->setLanguageCode('ko-KR')
    ->setSsmlGender(SsmlVoiceGender::FEMALE);

// Effects profile
$effectsProfileId = "telephony-class-application";

// select the type of audio file you want returned
$audioConfig = (new AudioConfig())
    ->setAudioEncoding(AudioEncoding::MP3)
    ->setEffectsProfileId(array($effectsProfileId));

// perform text-to-speech request on the text input with selected voice
// parameters and audio file type
$response = $client->synthesizeSpeech($synthesisInputText, $voice, $audioConfig);
$audioContent = $response->getAudioContent();

//echo $audioContent;
//print_r($audioContent);
// the response's audioContent is binary
file_put_contents('/home/vmrdev/vchat/data/file/vchat/wr_subject_'.$wr_id.'.mp3', $audioContent);
echo 'Audio content written to "/home/vmrdev/vchat/data/file/vchat/wr_subject_'.$wr_id.'.mp3' . PHP_EOL;


?>