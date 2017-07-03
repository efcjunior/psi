<?php
require_once('../config.php');
require_once(DBAPI);

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["CONTENT_TYPE"] == "application/json"){
    $data = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
    $json = json_decode($data,true);
}

if($json['action'] == 'grupoMesAno') {
    header("Content-Type: application/json;charset=utf-8");
    echo totalizaGrupoMesAno($json['startDate'],$json['endDate'],$json['grupo']);
}

if($json['action'] == 'exportToXls') {
    exportaXls($json['startDate'],$json['endDate'],$json['noAgrupador'],$json['valorAgrupador']);
}

//deve ser periodo
if($json['action'] == 'grupoMesAnoDia') {
    header("Content-Type: application/json;charset=utf-8");
    echo totalizaGrupoMesAno($json['grupo'],$json['data']);
}

if($json['action'] == 'origemData') {
    header("Content-Type: application/json;charset=utf-8");
    echo totalizaOrigemData($json['grupo'],$json['data']);
}

if($json['action'] == 'areaGrupo') {
    header("Content-Type: application/json;charset=utf-8");
    echo totalizaAreaGrupo($json['startDate'],$json['endDate'], $json['sr']);
}

if($json['action'] == 'labelByCampo') {
    header("Content-Type: application/json;charset=utf-8");
    echo consultaCampoPorPeriodo($json['startDate'],$json['endDate'],$json['nomeCampo']);
}

function consultaCampoPorPeriodo($startDate,$endDate,$nomeCampo){
    $result = json_encode(queryCampoPorPeriodo($startDate,$endDate, $nomeCampo));
    return $result;
}

function totalizaGrupoMesAno($startDate,$endDate,$grupo){
    $result = json_encode(queryGrupoMesAno($startDate,$endDate,$grupo));
    return $result;
}

function totalizaGrupoMesAnoDia($grupo, $data){
    $result = json_encode(queryGrupoMesAnoDia($grupo, $data));
    return $result;
}

function totalizaOrigemData($grupo, $data){
    $result = json_encode(queryOrigemData($grupo, $data));
    return $result;
}

function totalizaAreaGrupo($startDate,$endDate, $sr){
    $result = json_encode(queryAreaGrupo($startDate,$endDate, $sr));
    return $result;
}

function exportaXls($startDate,$endDate,$noAgrupador,$valorAgrupador){
//
//header('Set-Cookie: fileDownload=true; path=/');
//header('Cache-Control: max-age=60, must-revalidate');
//    logMsg("function exportaXls---loop");
//    $nomeColunas = array('Ocorrencia','Grupo','Origem','Assunto','Item','Motivo','Unidade','SR','SN','DI','VP');

//    $fileName = "relatorio_analitico" . date('Ymd') . ".xls";
//
//    header("Content-Disposition: attachment; filename=\"$fileName\"");
//    header("Content-Type: application/vnd.ms-excel");

//    $excel = new SimpleExcel('xml');                    // instantiate new object (will automatically construct the parser & writer type as XML)
//
//    $excel->writer->setData(
//        array
//        (
//            array('ID',  'Name',            'Kode'  ),
//            array('1',   'Kab. Bogor',       '1'    ),
//            array('2',   'Kab. Cianjur',     '1'    ),
//            array('3',   'Kab. Sukabumi',    '1'    ),
//            array('4',   'Kab. Tasikmalaya', '2'    )
//        )
//    );                                                  // add some data to the writer
//    $excel->writer->saveFile('example');                // save the file with specified name (example.xml)


//    $result = queryOcorrencias($startDate,$endDate,$noAgrupador,$valorAgrupador);



//    foreach($result as $e){
//        logMsg("FOR...: " . $e['ocorrencia']);
//        logMsg("FOR...: " . $e['grupo']);
//        logMsg("FOR...: " . $e['origem']);
//        logMsg("FOR...: " . $e['assunto']);
//        logMsg("FOR...: " . $e['item']);
//        logMsg("FOR...: " . $e['motivo']);
//        logMsg("FOR...: " . $e['unidade']);
//        logMsg("FOR...: " . $e['sr']);
//        logMsg("FOR...: " . $e['sn']);
//        logMsg("FOR...: " . $e['di']);
//        logMsg("FOR...: " . $e['vp']);

//    }
}

?>