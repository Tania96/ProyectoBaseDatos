<?php
require_once "../models/Universidad.php";
if (empty($_POST['submit']))
{
      header("Location:" .  "list.php");
      exit;
}
$args = array(
    'id_u'  => FILTER_SANITIZE_INT,
    'id_ciu'  => FILTER_SANITIZE_INT,
    'name_u'  => FILTER_SANITIZE_STRING,
    
);

$post = (object)filter_input_array(INPUT_POST, $args);

if( $post->id_u === false )
{
    header("Location:" . "/list.php");
}

$db = new Database;
$universidad = new Universidad($db);
$universidad->setIDR($post->id_ciu);
$universidad->setUsername($post->name_u);
$universidad->setID($post->id_u);

$universidad->update();
header("Location:" . "list.php");