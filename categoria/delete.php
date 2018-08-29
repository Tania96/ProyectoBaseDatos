<?php
require_once "../models/Categoria.php";
$db = new Database;
$categoria = new Categoria($db);
$id_cat = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
if( $id_cat )
{
    $categoria->setId($id_cat);
    $categoria->delete();
}
header("Location:" . "list.php");