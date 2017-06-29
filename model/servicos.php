<?php

echo
$data = file_get_contents('php://input');

echo "blalladfas";

echo $_POST['data'];

print_r($data);
$data = json_decode($data, true);
print_r($data);



