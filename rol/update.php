<?php
require_once "../models/Rol.php";
if (empty($_POST['submit']))
{
      header("Location:" .  "list.php");
      exit;
}
$args = array(
    'id_rol'    => FILTER_VALIDATE_INT,
    'descrip_rol'  => FILTER_SANITIZE_STRING,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

if( $post->id_rol === false )
{
    header("Location:" . "/list.php");
}

$db = new Database;
$rol = new Rol($db);
$rol->setID($post->id_rol);
$rol->setUsername($post->descrip_rol);
$rol->update();
header("Location:" . "list.php");