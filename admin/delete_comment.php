<?php include("includes/init.php"); ?>

<?php //if(!$session->is_signed_in()) {redirect("login");} ?>

<?php 


if(empty($_GET['id'])) {

redirect("comments");


}

$comment = Comment::find_by_id($_GET['id']);

if($comment) {

$comment->delete();
$session->message("The comment with {$comment->id} has been deleted");
redirect("comments");



} else {



redirect("comments");


}










 ?>