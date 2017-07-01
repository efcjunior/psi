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
    echo totalizaGrupoMesAno($json['startDate'],$json['endDate']);
}

if($json['action'] == 'exportToXls') {
    echo exportaXls(null,null,null);
}

//deve ser periodo
if($json['action'] == 'grupoMesAnoDia') {
    echo totalizaGrupoMesAno($json['grupo'],$json['data']);
}

if($json['action'] == 'origemData') {
    logMsg("totalizaOrigemData".$json['grupo'].$json['data']);
    echo totalizaOrigemData($json['grupo'],$json['data']);
}

if($json['action'] == 'areaGrupo') {
    logMsg("if totalizaAreaGrupo---start");
    echo totalizaAreaGrupo($json['startDate'],$json['endDate']);
}

if($json['action'] == 'labelData') {
    echo consultaData($json['mesano']);
}

function consultaData($mesano){
    $result = json_encode(queryData($mesano));
    return $result;
}

function totalizaGrupoMesAno($startDate,$endDate){
    $result = json_encode(queryGrupoMesAno($startDate,$endDate));
    return $result;
}

//deve ser periodo
function totalizaGrupoMesAnoDia($grupo, $data){
    $result = json_encode(queryGrupoMesAnoDia($grupo, $data));
    return $result;
}

function totalizaOrigemData($grupo, $data){
    $result = json_encode(queryOrigemData($grupo, $data));
    return $result;
}

function totalizaAreaGrupo($startDate,$endDate){
    logMsg("function totalizaAreaGrupo---start");
    $result = json_encode(queryAreaGrupo($startDate,$endDate));
    return $result;
}

function exportaXls($grupo, $dt_ocorrencia, $sr){
    $result = queryOcorrencias($grupo, $dt_ocorrencia, $sr);
}

?>