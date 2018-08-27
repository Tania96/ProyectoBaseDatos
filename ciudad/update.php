<?php
require_once "../models/Ciudad.php";
if (empty($_POST['submit']))
{
      header("Location:" .  "list.php");
      exit;
}
$args = array(
    'id_ciu'  => FILTER_SANITIZE_INT,
    'id_reg'  => FILTER_SANITIZE_INT,
    'name_ciu'  => FILTER_SANITIZE_STRING,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

if( $post->id_ciu === false )
{
    header("Location:" . "/list.php");
}

$db = new Database;
$ciudad = new Ciudad($db);
$ciudad->setIDR($post->id_reg);
$ciudad->setUsername($post->name_ciu);
$ciudad->setID($post->id_ciu);

$ciudad->update();
header("Location:" . "list.php");