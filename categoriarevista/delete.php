<?php
require_once "../models/CategoriaRevista.php";
$db = new Database;
$categoriarevista = new CategoriaRevista($db);
$id_cat_rev = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
if( $id_cat_rev )
{
    $categoriarevista->setId($id_cat_rev);
    $categoriarevista->delete();
}
header("Location:" . "list.php");