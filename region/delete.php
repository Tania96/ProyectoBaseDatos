<?php
require_once "../models/Region.php";
$db = new Database;
$region = new Region($db);
$id_reg = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
if( $id_reg )
{
    $region->setId($id_reg);
    $region->delete();
}
header("Location:" . "list.php");