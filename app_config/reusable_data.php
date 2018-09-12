<?php
//This file contains different functions and a class to reduce code redundancy
/*This function prints the given data in argument, and wraps them in a <div>
tag named "page-content" (makes it easy for designers)*/
function pageContent($content){
         print("<div class='page-content'>" . $content . "</div>");
}
//This function checks whether the user is already logged in or not.
function loginChecker(){
if(isset($_SESSION['loggedin'])){
    if(!$_SESSION['loggedin']){
        print("<li id='login-menu'>
            <a href='/login'>Login</a>
          </li>
        </ul>
      </nav>
      ");
    }
    else{
      print("<li id='login-menu'>
          <a href='/profile'>Profile</a>
        </li>
      </ul>
    </nav>");
    }
}
else{
      print("<li id='login-menu'>
          <a href='/login'>Login</a>
        </li>
      </ul>
    </nav>
    ");
  }
}
//This is a Product class that prints a form list containing name of products and price tag
class Product {
      private $products;
      function __construct($product=array())
      {
               $this->products=$product;
      }
//This function creates a html div element upon given arguments.
      private function products($callback,$className,$value)
          {
          return("<div class=". $className .">
          Product Name:". $value['product'] .
          "<br>
          Product Price:". number_format($value['price'],2) .
          "<br><input type='button' id='add' onclick='". $callback . "(" . $value['price'] . ")' value='Add to cart' class='buttons'/>
          </div>");
      }
//This function shows the available shipment methods.
      private function shippingMethods()
      {
        return("<div>
               <select name='shippingMethod' id='shippingMethod'>
               <option value:'5'>Home Delivery</option>
               <option value:'0'>Pick up</option>
               </select>");
      }
//It returns the submit button.
      private function submitForm()
      {
        return("<input type='submit' id='checkout' class='buttons' value='Checkout'/>
              </form>
              </div>
        ");
      }
//This is the only accessible function that returns a form.
      public function form($callback,$className)
      {
          $products=array();
          foreach ($this->products as $value){
            array_push($products,$this->products($callback,$className,$value));
          }
          $wholeForm=implode($products,"") . $this->shippingMethods() . $this->submitForm();
          return $wholeForm;
      }

  }
?>
