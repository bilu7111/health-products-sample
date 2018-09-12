<?php
/*This file contains the functions that are called upon different
requests*/

/*
  This array contains the list of products..
*/
$products=array(['product'=>'Energy Drinks','id'=>'product-1','price'=>300.00],
['product'=>'Exercise Shoes','id'=>'product-2','price'=>250.00]);

//This is a landing page, it uses Product class defined in reusable_code.php..
function productsPage(){
        global $products;
        $products=new Product($products);
        $dymamicContent=$products->form("addtocart","products");
        pageContent("<form id='productForm' class='forms'>" . $dymamicContent . "</form>
        <span id='estimate'>
             Total:0$<br>
             Items:0
        </span>
        ");
}
//This is the home page.
function homePage(){
       pageContent("
             <h2>Welcome</h2>
             <p>We provide products that are best suited to provide you a healthy life.
             <br>
             (Note:This is a fictious website. The purpose is to highlight different
             skills of the web developer. Every information provided here has no concern
             with reality.
             )<p>");
}
//This is the sign up page used for registration.
function signupPage(){
        pageContent("
        <form id='signupForm' class='forms' method='POST' action='/registered'>
        <h2> Sign up </h2> <br>
        <span id='error' style='color:red;'></span>
        <fieldset class='input-text'>
        <label for 'firstName'>
        First Name
        </label>
        <input type='text' name='firstName' id='firstName' placeholder='first name' class='text' required/>
        <label for 'lastName'>
        Last Name
        </label>
        <input type='text' name='lastName' id='lastName' placeholder='last name' class='text' required/>
        </fieldset>
        <fieldset class='input-text'>
        <label for 'email'>
        Email Address:
        </label>
        <input type='email' name='email' id='email' placeholder='email address' class='text' required/>
        </fieldset>
        <fieldset class='input-text'>
        <label for 'password'>
        Password
        </label>
        <input type='password' name='password' id='password' placeholder='password' class='text' required/>
        </fieldset>
        <select id='country' name='country' required>
        <option value='PK'>Pakistan</option>
        <option value='IND'>India</option>
        <option value='CH'>China</option>
        </select>
        <input type='submit' value='Sign up' name='signup' id='signup' class='buttons'/>
        </form>
         ");
}
//This is the login page.
function loginPage(){
        if($_SESSION['loggedin']){
              header("Location:/profile");
        }
        pageContent("
              <form method='POST' name='loginForm' id='loginForm' class='forms' action='/result'>
              <h2>Sign in</h2>
              <span id='error' style='color:red;'></span>
              <fieldset class='input-text'>
              <label for='username'>
              Username
              </label>
              <input type='email' name='username' id='username' minlength='6' autocomplete='username' required class='text'/>
              <label for='password'>
              Password
              </label>
              <input type='password' name='password' id='password' minlength='6' autocomplete='current-password' required class='text'/>
              </fieldset>
              <input type='submit' name='login' id='login' value='Log in' class='buttons'/>
              <br/>
              <span>Don't have an account? <a href='/signup'>Sign up.</a> </span>
              </form>
        ");
}
//This function is called when a user signs up, it stores data into sessions.
function registered(){
        $_SESSION['loggedin']=true;
        $_SESSION['username']=strip_tags($_POST['email']);
        $_SESSION['password']=password_hash(strip_tags($_POST['password']),PASSWORD_DEFAULT);
        $_SESSION['country']=$_POST['country'];
        $_SESSION['cardNumber']=null;
        pageContent("Congratulations! You are signed up and now you can purchase our products
        using your debit card.");
}
//This function contains the profile page.
function profilePage(){
        $profile="<div id='profile-section'>
              <h2>Profile</h2>
              Your username:" . $_SESSION['username'] . "<br>
              Country:". $_SESSION['country'] . "
              <br><a href='logout.php'>Log out</a><br>
              </div>
              ";

        $cardDetails="<div id='cardDetail'>
             <form id='cardDetails' name='cardDetails' method='POST' class='forms'>
             <h2> Add Debit Card Details</h2>
             <span id='error'></span>
             <fieldset class='input-text'>
             <label for 'CfistName'>
             First Name
             </label>
             <input type='text' name='cfirstName' id='cfirstName' placeholder='first name' class='text' required/>
             <label for 'clastName'>
             Last Name
             </label>
             <input type='text' name='clastName' id='clastName' placeholder='last name' class='text' required/>
             <fieldset class='input-text'>
             <label for 'cardNumber'>
             Card Number
             </label>
             <input type='text' name='cardNumber' id='cardNumber' placeholder='Only Mastercards' class='text' pattern='^(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$'/>
             </fieldset>
             <input type='submit' name='addCard' id='addCard' value='Add card' class='buttons'/>
             </form>
             </div>
             ";

        $cardNumber="<div id='cardDetail'>
        Debit Card : **************" . $_SESSION['cardNumber'] ."<br>
        </div>";

        if($_SESSION['loggedin']){
        if(isset($_SESSION['cardNumber'])){
                pageContent($profile . $cardNumber);
        }
        else{
               pageContent($profile . $cardDetails);
        }
        }
        else{
             header("Location:pagenotfound");
        }
}
//This is the contact page.
function contactPage(){
       pageContent("
       <h2>Contact</h2>
       <p>Hi! My name is Bilal Kazmi. I am an Intermediate PHP Web Developer. This
       website uses sessions to store your password and username so you won't be able to login once you
       close your browser. This was just a conceptual website so I didn't used Database. Your password is hashed
       before saving. Please, don't provide your real debit card information. You won't be deducted any money, though
       you can't submit any card other than that matches the pattern of a Mastercard.
       <br><br>Get in touch with me!</p>
       <div id='social-links'>
       <a href='https://www.linkedin.com/in/bilal-kazmi-1148b0168/' class='fa fa-linkedin'></a>
       <a href='https://www.github.com/bilu7111' class='fa fa-github'></a>
       <a href='https://www.stackoverflow.com/' class='fa fa-stack-overflow'></a>
       </div>
       ");
}
//This function is called when a user sign in, to ensure provided info is correct.
function result(){
                $verifyPassword=password_verify($_POST['password'],$_SESSION['password']);
                if($_POST['username']==$_SESSION['username']&&$verifyPassword){
                        $_SESSION['loggedin']=true;
                        header("Location:/profile");
                }
                else{
                       pagenotfound("Your email or password is invalid!");
                }
}
//This is the most commonly used function called upon a request for an unknown page.
function pagenotfound($errorMessage=null){
       if(!$errorMessage){
       pageContent("<div id='error-page'><h2 style='color:red;'>Page not found!</h2>
       We are sorry, but your requested page could not be found!
       </div>");
       }
       else{
         pageContent("<div id='error-page'>" . $errorMessage . "
          <br><a href='/login'>Try again</a></div>");
       }
}
?>
