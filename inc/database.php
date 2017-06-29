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

function find_all(){
    logMsg("Initializing find_all function...");

    $dbconn = open_database();

    $sql = "select * from iousm001.ioutb03_relatorio";

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