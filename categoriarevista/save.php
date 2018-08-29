<?php
require_once "../models/CategoriaRevista.php";
if (empty($_POST['submit']))
{
      header("Location:" . "list.php");
      exit;
}

$args = array(
    'id_cat_rev'  => FILTER_SANITIZE_INT,
    'descrip_cat_rev'  => FILTER_SANITIZE_STRING,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

$db = new Database;
$categoriarevista = new CategoriaRevista($db);
$categoriarevista->setID($post->id_cat_rev);
$categoriarevista->setUsername($post->descrip_cat_rev);
$categoriarevista->save();
header("Location:" . "list.php");