<?php

function open_database() {
    try {
        $conn = pg_connect(DB_DSN);

        if (!$conn) {
            logMsg("Not Connected");
        }

        return $conn;
    } catch (Exception $e) {
        echo $e->getMessage();
        return null;
    }
}
function close_database($conn) {
    try {
        pg_close($conn);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function queryOcorrencias($grupo, $dt_ocorrencia, $sr){
    $sql = "SELECT
                *
            FROM CTE WHERE 1=1";

    if($grupo != null){
        $sql = $sql." and grupo = '".$grupo."'";
    }

    if($dt_ocorrencia != null){
        $sql = $sql." and dt_ocorrencia = '".$dt_ocorrencia."'";
    }

    if($sr != null){
        $sql = $sql." and sr in (".$sr.")";
    }

    return executaQuery($sql);
}


function queryData($mesano){

    if($mesano){
        $sql = "
            SELECT
                distinct anomes
            FROM CTE
             
            ORDER BY 1
        ";
    }else{
        $sql = "
            SELECT
                distinct dt_ocorrencia
            FROM CTE
             
            ORDER BY 1
        ";
    }


    return executaQuery($sql);
}


function queryGrupoMesAno($startDate,$endDate){
    $sql = "SELECT
                anomes, grupo, count(*)as total
            FROM CTE
             
            GROUP BY 1,2
             
            ORDER BY 1,2";
    return executaQuery($sql,$startDate,$endDate);
}

/*deve ser periodo*/
function queryGrupoMesAnoDia($grupo,$data){
    $sql = "SELECT
	          anomes, grupo, count(*)as total
            FROM CTE
            
            WHERE anomes = ".$data." and grupo = ".$grupo." 
            
            GROUP BY 1,2
            
            ORDER BY 1,2";

    return executaQuery($sql);
}

function queryOrigemData($grupo,$data){

    logMsg("GRUPO...".$grupo);

    $sql = "SELECT
	          dt_ocorrencia, origem, count(*)as total
            FROM CTE
            
            WHERE anomes = '".$data."' and grupo = '".$grupo."' 
            
            GROUP BY 1,2
            
            ORDER BY 1,2";

    return executaQuery($sql);
}

function queryAreaGrupo($startDate,$endDate){
    logMsg("function queryAreaGrupo---start");
    $sql = "  SELECT
                   sr,
                   grupo,
                   count(*)as total
                FROM CTE
                
                GROUP BY 1,2
                
                ORDER BY 1,2";
    return executaQuery($sql,$startDate,$endDate);
}

function executaQuery($paramSql,$startDate,$endDate){
    $dbconn = open_database();

    $sql = "WITH CTE AS
                (SELECT
                   date_part('year',dt_ocorrencia)  ano,
                   date_part('month',dt_ocorrencia) mes,
                   date_part('day',dt_ocorrencia) dia,
                   to_char(dt_ocorrencia, 'YYYY-MM') anomes,
                   to_char(dt_ocorrencia, 'YYYY-MM-DD') anomesdia,
                   dt_ocorrencia,
                   ocorrencia,
                   g.grupo,
                   r.origem,
                   r.id_unidade,
                   r.assunto,
                   r.item,
                   r.motivo,
                   u.sr,
                   u.sn,
                   u.di,
                   u.vp
                FROM iousm001.ioutb03_relatorio r
                inner join iousm001.ioutb02_grupo_origem g on r.origem = g.origem
                inner join iousm001.ioutb01_unidade u on r.id_unidade = u.id ";

                if($startDate != null && $endDate != null){
                    $sql = $sql."WHERE dt_ocorrencia between '".$startDate."' and '".$endDate."') \n\n".$paramSql;
                }else {
                    $sql = $sql.")\n\n".$paramSql;
                }

    logMsg("SQL...".$sql);


    $result = pg_query($dbconn, $sql);

    if (!$result) {
        echo "An error occurred.\n";
        exit;
    }

    $arr = pg_fetch_all($result);

    close_database($dbconn);

    return $arr;

}