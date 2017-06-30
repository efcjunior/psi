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


function queryData($mesano){

    if($mesano){
        $sql = "
            SELECT
                distinct anomes
            FROM CTE
             
            ORDER BY 1
        ";
    }


    return executaQueryGrupoData($sql);
}


function queryGrupoMesAno(){
    $sql = "SELECT
                anomes, grupo, count(*)as total
            FROM CTE
             
            GROUP BY 1,2
             
            ORDER BY 1,2";
    return executaQueryGrupoData($sql);
}

function executaQueryGrupoData($paramSql){
    logMsg("Initializing find_all function...");

    $dbconn = open_database();

    $sql = "WITH CTE AS
     
               (SELECT
                   date_part('year',dt_ocorrencia)  ano,
                   date_part('month',dt_ocorrencia) mes,
                   date_part('day',dt_ocorrencia) dia,
                   to_char(dt_ocorrencia, 'YYYY-MM') anomes,
                   to_char(dt_ocorrencia, 'YYYY-MM-DD') anomesdia,
                   g.grupo
               FROM iousm001.ioutb03_relatorio r
               inner join iousm001.ioutb02_grupo_origem g on r.origem = g.origem
               ) \n\n".$paramSql;

    $result = pg_query($dbconn, $sql);

    logMsg("Result...".$result);

    if (!$result) {
        echo "An error occurred.\n";
        exit;
    }

    $arr = pg_fetch_all($result);

    close_database($dbconn);

    return $arr;

}