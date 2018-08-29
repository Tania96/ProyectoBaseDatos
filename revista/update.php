<?php
require_once "../models/Revista.php";
if (empty($_POST['submit']))
{
      header("Location:" .  "list.php");
      exit;
}
$args = array(
    'id_rev'  => FILTER_SANITIZE_INT,
    'name_rev'  => FILTER_SANITIZE_STRING,
    'name_edit'  => FILTER_SANITIZE_STRING,
    'fact_impacto'  => FILTER_SANITIZE_STRING,
    'id_cat_rev'  => FILTER_SANITIZE_INT,
);

$post = (object)filter_input_array(INPUT_POST, $args);

if( $post->id_rev === false )
{
    header("Location:" . "/list.php");
}

$db = new Database;
$revista = new Revista($db);
$revista->setIDR($post->id_cat_rev);
$revista->setEdit($post->name_edit);
$revista->setFact($post->fact_impacto);
$revista->setUsername($post->name_rev);
$revista->setID($post->id_rev);

$revista->update();
header("Location:" . "list.php");