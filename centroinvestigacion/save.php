<?php
require_once "../models/CentroInvestigacion.php";
if (empty($_POST['submit']))
{
      header("Location:" . "list.php");
      exit;
}

$args = array(
    'id_centro'  => FILTER_SANITIZE_INT,
    'name_centro'  => FILTER_SANITIZE_STRING,
    'id_ciu'  => FILTER_SANITIZE_INT,
    'telefono' => FILTER_SANITIZE_INT,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

$db = new Database;
$centroinvestigacion = new CentroInvestigacion($db);
$centroinvestigacion->setIDR($post->id_ciu);
$centroinvestigacion->setUsername($post->name_centro);
$centroinvestigacion->setTelefono($post->telefono);
$centroinvestigacion->setID($post->id_centro);
$centroinvestigacion->save();
header("Location:" . "list.php");