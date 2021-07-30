<?php 



//trebali znati hoće li skenirati vašu aplikaciju ili će učiniti hoće li tražiti deklarirane objekte. Dakle, ako nađete korisnika koji se prijavljuje, uhvatit će ga i predati kao parametar, zbog toga stavljamo class u funckiju
function classAutoLoad($class){

//Ono što želimo raditi većinu vremena je da želimo sve napraviti malim slovima
$class = strtolower($class);

// $the_path = "includes/{$class}.php";


//ovo je path za slanje putanje određenog fajla namjenjenog za korisnika
$the_path = INCLUDES_PATH . DS . "{$class}.php";


if(file_exists($the_path)) {

require_once($the_path);


} else {


die("This file named {$class}.php was not found man....");

	}



}

//redirect, napravljena funckija 
function redirect($location){


header("Location: {$location}");


}




function output_message($message) {


return $message;

}

spl_autoload_register("classAutoLoad");


 ?>