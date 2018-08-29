<?php
require_once "../models/TipoProyecto.php";
if (empty($_POST['submit']))
{
      header("Location:" . "list.php");
      exit;
}

$args = array(
    'id_tipo'  => FILTER_SANITIZE_INT,
    'descrip_tipo'  => FILTER_SANITIZE_STRING,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

$db = new Database;
$tipoproyecto = new TipoProyecto($db);
$tipoproyecto->setID($post->id_tipo);
$tipoproyecto->setUsername($post->descrip_tipo);
$tipoproyecto->save();
header("Location:" . "list.php");