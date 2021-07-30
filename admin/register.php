<?php require_once("includes/header.php"); 
include "access.php";

?>

<?php 

if($session->is_signed_in()) {

redirect("index");

}

$error = "";
 function create_userid(){

	$length = rand(4,20);
	$number = "";

	for($i=0; $i < $length; $i++){

		$new_rand = rand(0,9);

		$number = $number . $new_rand;
	}

	return $number;

}

if($_SERVER['REQUEST_METHOD'] == "POST"){

	require_once("includes/database.php"); 
	$arr['userid'] = create_userid();

	//Izbriši cijeli dio ako stvara problem
	$condition = true;

	while($condition){

	$query = "select id from users where userid = :userid limit 1";
	$stm = $connection->prepare($query);

	if($stm){

		$check = $stm->execute($arr);

		if($check){

		$data = $stm->fetchAll(PDO::FETCH_ASSOC);
			if(is_array($data) && count($data) > 0){

				$arr['userid'] = create_userid();
				continue;

			}
		}
	}
	$condition = false;
}//dovde obrisati


	//save to database
	$arr['username'] = $_POST['username'];
	$arr['password'] = hash('sha1', $_POST['password']);

	if(empty($_POST['password'])){

		if(preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $arr['password'])){

			echo "<p style='color:red; text-align:center;'>Minimum eight characters, at least one letter and one number, that user already exists :</p>";

		}

	}
	//save to database
	$arr['username'] = $_POST['username'];
	$arr['password'] = hash('sha1', $_POST['password']);

	$arr['rank'] = "user";
	$query = "insert into users (userid, username, password, rank) values (:userid, :username, :password, :rank)";
	$stm = $connection->prepare($query);

	if($stm){

		$check = $stm->execute($arr);
		if(!$check){
			$error = "could not save to database";
		}

		if($error == ""){

			Redirect::to('login');
			if(empty($_POST['password'])){


				$errors['password'] = 'an password is required <br />';
			
			}else{
			
				$user->password =  $_POST['password'];
			
			
			
			}
		}
	}
}


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>

<div class="col-md-4 col-md-offset-3">

	<?php

	if($error != ""){

		echo "<br><span style='color:red'>$error</span><br><br>";

	}

	?>
<form id="login-id" action="" method="post">
	<div class="red-text" style="color:red;">
		<?php // echo $errors['username']; ?>
	</div>
<div class="form-group">
	<label for="username">Username</label>
	<p id="username-err"></p>
	<input type="text" class="form-control" name="username" value="<?php // echo htmlspecialchars($user->username); ?>" required>


</div>

<div class="form-group">
<div class="red-text" style="color:red;">
		<?php // echo $errors['password']; ?>
	</div>
	<label for="password">Password</label>


	<input type="password" class="form-control" name="password" value="<?php // echo htmlspecialchars($user->password); ?>" required>
	<div class="error">
	<?php // echo $errors['password'] ?? '' ?>
	</div>

</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>

<a href="login">Login in to the page!</a>
</form>


</div>


<script src="js/index.js"></script>
 

</body>
</html>
