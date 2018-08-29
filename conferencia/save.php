<?php
require_once "../models/Conferencia.php";
if (empty($_POST['submit']))
{
      header("Location:" . "list.php");
      exit;
}

$args = array(
    'id_conf'    => FILTER_VALIDATE_INT,
    'name_conf'  => FILTER_SANITIZE_STRING,
    'fecha_ini_conf'  => FILTER_SANITIZE_STRING,
    'fecha_fin_conf'  => FILTER_SANITIZE_STRING,
    'pais'  => FILTER_SANITIZE_STRING,
    'name_resp'  => FILTER_SANITIZE_STRING,
    
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

$db = new Database;
$conferencia = new Conferencia($db);
$conferencia->setID($post->id_conf);
$conferencia->setUsername($post->name_conf);
$conferencia->setFini($post->fecha_ini_conf);
$conferencia->setFin($post->fecha_fin_conf);
$conferencia->setPais($post->pais);
$conferencia->setResp($post->name_resp);
$conferencia->update();
header("Location:" . "list.php");