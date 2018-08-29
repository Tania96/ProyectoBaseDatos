<?php
require_once "../models/Categoria.php";
if (empty($_POST['submit']))
{
      header("Location:" . "list.php");
      exit;
}

$args = array(
    'id_cat'  => FILTER_SANITIZE_INT,
    'descrip_cat'  => FILTER_SANITIZE_STRING,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

$db = new Database;
$categoria = new Categoria($db);
$categoria->setID($post->id_cat);
$categoria->setUsername($post->descrip_cat);
$categoria->save();
header("Location:" . "list.php");