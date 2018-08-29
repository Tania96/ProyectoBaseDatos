<?php
require_once "../models/TipoProyecto.php";
$db = new Database;
$tipoproyecto = new TipoProyecto($db);
$id_tipo = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
if( $id_tipo )
{
    $tipoproyecto->setId($id_tipo);
    $tipoproyecto->delete();
}
header("Location:" . "list.php");