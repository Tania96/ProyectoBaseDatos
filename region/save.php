<?php
require_once "../models/Region.php";
if (empty($_POST['submit']))
{
      header("Location:" . "list.php");
      exit;
}

$args = array(
    'id_reg'  => FILTER_SANITIZE_INT,
    'name_reg'  => FILTER_SANITIZE_STRING,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

$db = new Database;
$region = new Region($db);
$region->setID($post->id_reg);
$region->setUsername($post->name_reg);
$region->save();
header("Location:" . "list.php");