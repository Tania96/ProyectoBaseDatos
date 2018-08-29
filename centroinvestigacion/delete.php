<?php
require_once "../models/CentroInvestigacion.php";
$db = new Database;
$centroinvestigacion = new CentroInvestigacion($db);
$id_centro = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
if( $id_centro )
{
    $centroinvestigacion->setId($id_centro);
    $centroinvestigacion->delete();
}
header("Location:" . "list.php");