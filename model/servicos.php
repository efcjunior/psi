<?php

echo json_encode($_GET);
echo $_GET['dataIn'];

if (isset($_GET['dataIn'])){
    echo '<h1>ok</h1>';
}else{
    echo '<h1>eror</h1>';
}

?>