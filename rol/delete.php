<?php
require_once "../models/Rol.php";
$db = new Database;
$rol = new Rol($db);
$id_rol = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
if( $id_rol )
{
    $rol->setId($id_rol);
    $rol->delete();
}
header("Location:" . "list.php");