<?php  require_once("includes/header.php"); 
include "access.php";

?>



<?php 



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



	//save to database
	$arr['username'] = $_POST['username'];
	$arr['password'] = hash('sha1', $_POST['password']);
	
	$query = "select * from users where username = :username  &&password = :password limit 1";
	$stm = $connection->prepare($query);

	if($stm){

		$check = $stm->execute($arr);

		if($check){
		
			$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				if(is_array($data) && count($data) > 0){
	
					$_SESSION['myid'] = $data[0]['userid'];
					$_SESSION['myname'] = $data[0]['username'];
					$_SESSION['myrank'] = $data[0]['rank'];


				}else{
					$error = "wrong username or password";

				}
			}


		if($error == ""){

			Redirect::to('../index');
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
	
<div class="form-group">
	<label for="username">Username</label>
	<p id="username-err"></p>
	<input type="text" class="form-control" name="username" required>


</div>

<div class="form-group">

	<label for="password">Password</label>


	<input type="password" class="form-control" name="password"  required>


</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>

<a href="register">Register in to the page!</a>
</form>


</div>


<script src="js/index.js"></script>
 

</body>
</html>


