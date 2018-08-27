<?php
require_once "../models/Ciudad.php";
$db = new Database;
$ciudad = new Ciudad($db);
$id_ciu = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
if( $id_ciu )
{
    $ciudad->setId($id_ciu);
    $ciudad->delete();
}
header("Location:" . "list.php");