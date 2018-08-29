<?php
require_once "../models/Rol.php";
if (empty($_POST['submit']))
{
      header("Location:" . "list.php");
      exit;
}

$args = array(
    'id_rol'  => FILTER_SANITIZE_INT,
    'descrip_rol'  => FILTER_SANITIZE_STRING,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

$db = new Database;
$rol = new Rol($db);
$rol->setID($post->id_rol);
$rol->setUsername($post->descrip_rol);
$rol->save();
header("Location:" . "list.php");