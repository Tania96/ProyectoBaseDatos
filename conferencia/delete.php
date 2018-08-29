<?php
require_once "../models/Conferencia.php";
$db = new Database;
$conferencia = new Conferencia($db);
$id_conf = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
if( $id_conf )
{
    $conferencia->setId($id_conf);
    $conferencia->delete();
}
header("Location:" . "list.php");