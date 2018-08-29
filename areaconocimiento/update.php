<?php
require_once "../models/AreaConocimiento.php";
if (empty($_POST['submit']))
{
      header("Location:" .  "list.php");
      exit;
}
$args = array(
    'id_area'    => FILTER_VALIDATE_INT,
    'descrip_area'  => FILTER_SANITIZE_STRING,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

if( $post->id_area === false )
{
    header("Location:" . "/list.php");
}

$db = new Database;
$areaconocimiento = new AreaConocimiento($db);
$areaconocimiento->setID($post->id_area);
$areaconocimiento->setUsername($post->descrip_area);
$areaconocimiento->update();
header("Location:" . "list.php");