<?php include("includes/init.php"); ?>

<?php //if(!$session->is_signed_in()) {redirect("login");} ?>

<?php 


if(empty($_GET['id'])) {

redirect("users");


}

$user = User::find_by_id($_GET['id']);

if($user) {

$session->message("The {$user->username} user has been deleted");

$user->delete_photo();
redirect("users");


} else {



redirect("users");


}










 ?>