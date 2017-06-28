<?php
/** DSN  banco de dados Postgresql*/
define('DB_DSN', 'pgsql:host=localhost;port=5432;dbname=des;user=postgres;password=postgres');
/** caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** caminho no server para o sistema **/
if ( !defined('BASEURL') )
    define('BASEURL', '/ouvidoria/');

/** caminho do arquivo de banco de dados **/
if ( !defined('DBAPI') )
    define('DBAPI', ABSPATH . 'inc/database.php');