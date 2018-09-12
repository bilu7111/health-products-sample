<?php
session_start();

//checking whether the user is not directly accessing this page.
if($_SESSION['loggedin']){
         $_SESSION['cardNumber']=substr($_POST['cardNumber'],-2);
           }
else{
    header("Location:pagenotfound");
}
?>
