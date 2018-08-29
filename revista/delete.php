<?php
require_once "../models/Revista.php";
$db = new Database;
$revista = new Revista($db);
$id_rev = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
if( $id_rev )
{
    $revista->setId($id_rev);
    $revista->delete();
}
header("Location:" . "list.php");