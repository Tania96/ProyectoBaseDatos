<?php
require_once "../models/Investigador.php";
if (empty($_POST['submit']))
{
      header("Location:" .  "list.php");
      exit;
}
$args = array(
    'id_cat'  => FILTER_SANITIZE_INT,
    'id_ciu'  => FILTER_SANITIZE_INT,
    'id_rol'  => FILTER_SANITIZE_INT,
    'rut_inv'  => FILTER_SANITIZE_STRING,
    'name_inv'  => FILTER_SANITIZE_STRING,
    'calle_inv'  => FILTER_SANITIZE_STRING,
    'numero_inv'  => FILTER_SANITIZE_INT,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

if( $post->rut_inv === false )
{
    header("Location:" . "/list.php");
}

$db = new Database;
$investigador = new Investigador($db);
$investigador->setIDC($post->id_cat);
$investigador->setIDCIU($post->id_ciu);
$investigador->setIDR($post->id_rol);
$investigador->setUsername($post->name_inv);
$investigador->setRUT($post->rut_inv);
$investigador->setCalle($post->calle_inv);
$investigador->setNumber($post->nummero_inv);

$investigador ->update();
header("Location:" . "list.php");