<?php
require_once "../models/Universidad.php";
$db = new Database;
$universidad = new Universidad($db);
$id_u = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
if( $id_u )
{
    $universidad->setId($id_u);
    $universidad->delete();
}
header("Location:" . "list.php");