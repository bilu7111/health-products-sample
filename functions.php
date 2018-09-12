<?php
//Useful PHP functions
function loginChecker(){
if(!$_SESSION['loggedin']){
    print("<li id='login-menu'>
        <a href='login.php'>Login</a>
      </li>
    </ul>
  </nav>
  ");
}
else{
  print("<li id='login-menu'>
      <a href='profile.php'>Profile</a>
    </li>
  </ul>
</nav>");
}

}
class Product {
      private $products;
      function __construct($product=Array()){
               $this->products=$product;
      }
      public function showProducts(){
        print("<form method='POST'>");
        foreach ($this->products as $value) {
          // code to fetch each product from products array and display it here..
          print("<div class=products>
          Product Name:". $value['product'] .
          "<br>
          Product Price:". $value['price'] .
          "<br><input type='button' id='add' onclick='addtocart(" . $value['price'] . ")' value='Add to cart' class='add'/>
          </div>");
        }
        print("<input type='submit' id='submit' class='button' value='Checkout'/>
              </form>
        ");
      }
}
?>
