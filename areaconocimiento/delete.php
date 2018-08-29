<?php
require_once "../models/AreaConocimiento.php";
$db = new Database;
$areaconocimiento = new AreaConocimiento($db);
$id_area = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
if( $id_area )
{
    $areaconocimiento->setId($id_area);
    $areaconocimiento->delete();
}
header("Location:" . "list.php");