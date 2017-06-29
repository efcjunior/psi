<?php

header("Content-Type: application/json;charset=utf-8");

require_once('../config.php');
require_once('../util/log.php');
require_once(DBAPI);

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["CONTENT_TYPE"] == "application/json"){
    logMsg("Initializing functions...");
    $data = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
    logMsg("Reading parameters... :".$data);
    $json = json_decode($data,true);
    logMsg("Decoding parameters from json... :".$json);

}

if($json['action'] == 'index') {
    logMsg("Calling index...");
    index();
}

function index(){
    logMsg("Calling index...");
    $result = json_encode(find_all());
    echo $result;
}

//if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["CONTENT_TYPE"] == "application/json"){
//
//    $data = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
//    $_POST_JSON = json_decode($_REQUEST["JSON_RAW"],true);
//
//    if(is_array($_POST_JSON))
//        $_REQUEST = $_POST_JSON+$_REQUEST;
//
//    $ourFileName = "testFile.txt";
//    $ourFileHandle = fopen($ourFileName, 'w');
//    fwrite($ourFileHandle, $_SERVER["REQUEST_METHOD"]."-".$_SERVER["CONTENT_TYPE"]."-".$_REQUEST['nome']);
//    fclose($ourFileHandle);
//
//}else{
//    $ourFileName = "testFile.txt";
//    $ourFileHandle = fopen($ourFileName, 'w');
//    fwrite($ourFileHandle, $_SERVER["REQUEST_METHOD"]);
//    fclose($ourFileHandle);
//}



//if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["CONTENT_TYPE"] == "application/json")
//{
//    echo "oddddddddddddddddddddddddddddddddddddddddddddddddddddddk";
//
//    $data = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
//
//
//
//
//
//    global $_POST_JSON;
//    $_POST_JSON = json_decode($_REQUEST["JSON_RAW"],true);
//
//    // merge JSON-Content to $_REQUEST
//    if(is_array($_POST_JSON)) $_REQUEST   = $_POST_JSON+$_REQUEST;
//
//}



//echo "blllllllllllllllllllllllllllll";
//
//echo ini_get('allow_url_fopen');
//
//$json = file_get_contents("php://input");
//$data = json_decode($json, true);

//
//
//echo $_POST['data'];
//
//print_r($data);
//$data = json_decode($data, true);
//print_r($data);
//
//function test(){
//    echo "hello world";
//}
//
//echo "blllllllllllllllllllllllllllll";

?>