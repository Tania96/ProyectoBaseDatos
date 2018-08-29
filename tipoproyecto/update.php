<?php
require_once "../models/TipoProyecto.php";
if (empty($_POST['submit']))
{
      header("Location:" .  "list.php");
      exit;
}
$args = array(
    'id_tipo'    => FILTER_VALIDATE_INT,
    'descrip_tipo'  => FILTER_SANITIZE_STRING,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

if( $post->id_tipo === false )
{
    header("Location:" . "/list.php");
}

$db = new Database;
$tipoproyecto = new TipoProyecto($db);
$tipoproyecto->setID($post->id_tipo);
$tipoproyecto->setUsername($post->descrip_tipo);
$tipoproyecto->update();
header("Location:" . "list.php");