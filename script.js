var total=$("#estimate");
var count=0;
var items=0;

function addtocart(amm){
  count+=parseFloat(amm);
  items+=1;
  total.html("Total:"+count.toFixed(2)+"$<br/>Items:"+items);
}
$('#productForm').submit(function(event){
  event.preventDefault();
  $.post("/checkout.php",
    {"count":count.toFixed(2),"items":items},
    function(data){
      $(".page-content").append(data);
      $('#checkout').attr('disabled',true);
    }
  );
  });
 $('#password').change(function (){
   if ($('#password').val().length<6)
   {
     $("#error").text("Password should contain minimum 6 characters");
     $("#login").attr('disabled',true);
     $("#password").focus();
   }
   else{
     $("#error").text("");
     $("#login").attr('disabled',false);
   }
 }
);
 $('#cardNumber').change(function(){
    var pattern=$('#cardNumber').attr('pattern');
    var isValid=$('#cardNumber').val().search(pattern)>=0;
 if(!isValid){
    $("#error").text("Invalid debit card number!");
    $("#addCard").attr('disabled',true);
    $("#cardNumber").focus();
 }
 else{
   $("#error").text("");
   $("#addCard").attr('disabled',false);
 }
 $("#cardDetails").submit(function(event){
    event.preventDefault();
    var cardNumber=$("#cardNumber").val();
    $.post('app_config/addCard.php',{"cardNumber":cardNumber},function(data){
      $("#cardDetail").html("Your card is added!<br>Your card number ends in "+cardNumber.slice(-2)+"<br>");
    });
 });
});
function hideModal(){
$("#modal").css("display","none");
window.location.href="/";
}
