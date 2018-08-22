<?php
require_once "../../models/User.php";
if (empty($_POST['submit']))
{
      header("Location:" .  "../users/list.php");
      exit;
}
$args = array(

    'username'  => FILTER_SANITIZE_STRING,
    'password'  => FILTER_SANITIZE_STRING,
);

$post = (object)filter_input_array(INPUT_POST, $args);

if( $post->id === false )
{
    header("Location:" . "../users/list.php");
}

$db = new Database;
$user = new User($db);
$user->setUsername($post->username);
$user->setPassword($post->password);
$user->update();
header("Location:" . "../users/list.php");