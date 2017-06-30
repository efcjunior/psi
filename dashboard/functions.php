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

if($json['action'] == 'grupoMesAno') {
    echo totalizaGrupoMesAno();
}

if($json['action'] == 'labelData') {
    echo consultaData($json['mesano']);
}

function consultaData($mesano){
    $result = json_encode(queryData($mesano));
    return $result;
}

function totalizaGrupoMesAno(){
    $result = json_encode(queryGrupoMesAno());
    return $result;
}

?>