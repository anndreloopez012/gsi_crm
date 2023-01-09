<?php

//$conn_string = "host=localhost port=5432 dbname=adgeco user=postgres password=Ad.2021* options='--client_encoding=UTF8'";
//$conn_string = "host=localhost port=5431 dbname=database_adgeco user=postgres password=Ad.2021* options='--client_encoding=UTF8'";

$conn_string = "host=wimog-gt.com port=5432 dbname=gsi  user=admin_gsi  password=Andrelopez01 options='--client_encoding=UTF8'";


//$conn_string = "host=localhost port=5432 dbname=adgeco_db user=postgres password=Ad.2021* options='--client_encoding=UTF8'";
$link  = pg_connect($conn_string);
if (!$link) {
    echo "Error: No se ha podido conectar a la base de datos\n";
}
// Close connection
// pg_close($link);

$var_consulta = pg_query($link, "SELECT KEY_ENCRYPT,COD_ENCRYPT FROM ADMCONFIG");
if ($row = pg_fetch_row($var_consulta)) {
    $idRow0 = trim($row[0]);
    $idRow1 = trim($row[1]);
}
$KEY_ENCRYPT = isset($idRow0) ? $idRow0 : '';
$COD_ENCRYPT = isset($idRow1) ? $idRow1 : '';

define("KEY", $KEY_ENCRYPT);
define("COD", $COD_ENCRYPT);
