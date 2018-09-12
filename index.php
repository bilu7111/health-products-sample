<?php
  session_start();
//Checking if the loggedin variable is not set and assigning a false value to it.
  if(!isset($_SESSION['loggedin'])){
  $_SESSION['loggedin']=false;
  }
  //Requiring Routes file, that contains the routing mechanism.
  require_once("routing/routes.php");
  //Including the header.
  include_once("header.html");
  //Checks if the user is logged in or not.
  loginChecker();
  //An array that contains the names of callable function names.
  $func=array("homePage","logger","contactPage","productsPage","loginPage","signupPage","profilePage","registered","result","pagenotfound");
  //Making a new instance object of classs Routes.
  $routes=new Routes($func);
  //The switch statement process the different requests and sends them to their corresponding functions.
  switch ($_SERVER['REQUEST_URI']) {
    case '/':
      $routes->actionTo('homePage');
      break;
    case '/contact':
      $routes->actionTo('contactPage');
      break;
    case '/products':
      $routes->actionTo('productsPage');
      break;
    case '/signup':
      $routes->actionTo('signupPage');
      break;
    case '/profile':
      $routes->actionTo('profilePage');
      break;
    case '/login':
      $routes->actionTo('loginPage');
      break;
    case '/logger':
      $routes->actionTo('logger','POST');
    case '/registered':
      $routes->actionTo('registered','POST');
      break;
    case '/result':
      $routes->actionTo('result','POST');
      break;
    default:
      $routes->actionTo('pagenotfound');
      break;
  }

  //Including the footer.
  include_once("footer.html");

?>
