<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
if($_SESSION['loggedin']){
if(!isset($_SESSION['cardNumber'])){
      print("<div id='modal'>Please click <a href='profile'>here</a> and provide your debit card details in order to buy products.</div>");
  }
else{
      print("<div id='modal'>You have ordered " . $_POST['items'] . " items
    that will be transfered to your provided address details
    and the total cost is " . $_POST['count'] . "$ that will be
    deducted from your card.
    (Please note no money will be deducted from you,this is just a conceptual website.)<br>
    <input type='button' class='buttons' onclick='hideModal()' value='Confirm'/>
    </div>");
}
}
else{
     print("<div id='modal'>You need to be loggedin in order to buy products,
 click <a href='/login'>here</a> to sign in.
</div>");
}
}
else{
    header("Location:/pagenotfound");
}
?>
