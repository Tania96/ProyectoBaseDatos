<?php
require_once "../models/CentroInvestigacion.php";
if (empty($_POST['submit']))
{
      header("Location:" .  "list.php");
      exit;
}
$args = array(
    'id_centro'  => FILTER_SANITIZE_INT,
    'id_ciu'  => FILTER_SANITIZE_INT,
    'name_centro'  => FILTER_SANITIZE_STRING,
    'telefono' => FILTER_SANITIZE_INT,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

if( $post->id_centro === false )
{
    header("Location:" . "/list.php");
}

$db = new Database;
$centroinvestigacion = new CentroInvestigacion($db);
$centroinvestigacion->setIDR($post->id_ciu);
$centroinvestigacion->setUsername($post->name_centro);
$centroinvestigacion->setId($post->id_centro);
$centroinvestigacion->setTelefono($post->telefono);

$centroinvestigacion->update();
header("Location:" . "list.php");