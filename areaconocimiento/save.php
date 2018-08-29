<?php
require_once "../models/AreaConocimiento.php";
if (empty($_POST['submit']))
{
      header("Location:" . "list.php");
      exit;
}

$args = array(
    'id_area'  => FILTER_SANITIZE_INT,
    'descrip_area'  => FILTER_SANITIZE_STRING,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

$db = new Database;
$areaconocimiento = new AreaConocimiento($db);
$areaconocimiento->setID($post->id_area);
$areaconocimiento->setUsername($post->descrip_area);
$areaconocimiento->save();
header("Location:" . "list.php");