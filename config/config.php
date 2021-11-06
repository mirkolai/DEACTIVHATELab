<?php
date_default_timezone_set('Europe/Rome');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

session_start();

//generali

$GLOBALS['aiutaci_numero_annotazioni_richieste']=3;
$GLOBALS['aiutaci_istanze_sessione']=15;


$sito_internet = "Didattica";

//$data =(date("Y-m-d"));

$vers = "0.0";


$base_url = "https://domain_name/";

//connessione DB

$server = "localhost";

$user = "username";
//

$password = "password";
//

$database = "database_name";

//


