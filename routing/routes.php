<?php
require("app_config/reusable_data.php");
require("pages.php");

//Interface for Routes class.
interface route{
     function actionTo($action,$method);
     //Calling an action(function) upon a given condition(REQUEST).
}
class Routes implements route{
      private $funcNames=array();
      //Puting each value of $func array to the private array.
      function __construct($func){
               foreach ($func as $value) {
                 array_push($this->funcNames,$value);
               }
      }
      public function actionTo($action,$method='GET'){
             //Check if the called function exists in the private array $funcNames.
             if(in_array($action,$this->funcNames)){
               //Check if the SERVER request method matches the one defined for the callback function.
               if($_SERVER['REQUEST_METHOD']==$method)
               {
                  $action();
               }
               //else redirect to page not found error.
               else{
                  header("Location:/pagenotfound");
               }
           }
           //else redirect to page not found error.
           else{
                header("Location:/pagenotfound");
           }
      }
}

?>
