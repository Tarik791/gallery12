<?php 

//provjera ranka
function access($rank, $redirect = true){

    //ako je postavljeno desit će se redirect
    if(isset($_SESSION["ACCESS"]) && !$_SESSION["ACCESS"][$rank]){

        if($redirect){

       
        header("Location: ../index");
        die;
        }
        return false;

    }
    return true;


}

$_SESSION["ACCESS"]["ADMIN"] =  isset($_SESSION['myrank']) && $_SESSION['myrank'] == "admin";

$_SESSION["ACCESS"]["USER"] = isset($_SESSION['myrank']) && ($_SESSION['myrank'] == "user" || $_SESSION['myrank'] == "admin");



?>