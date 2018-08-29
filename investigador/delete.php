<?php
require_once "../models/Investigador.php";
$db = new Database;
$investigador = new Investigador($db);
$rut_inv = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_STR);
 
if( $rut_inv )
{
    $investigador->setId($rut_inv);
    $investigador->delete();
}
header("Location:" . "list.php");