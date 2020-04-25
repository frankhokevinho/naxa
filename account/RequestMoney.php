<?php
Include('include-global.php');
$pagename = "Request Money";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Request Money From Another $basetitle Member";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>


<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-paper-plane"></i> REQUEST MONEY </div>
</div>

<div class="portlet-body">



<?php 
if($_POST){
$sendto = $_POST["sendto"];
$amount = round($_POST["amount"], $baseDecimal);
$msg = $_POST["message"];

########----------------------------->>>>>>>>>>>>> CONDITIONS
$count = $db->query("SELECT COUNT(*) FROM users WHERE email='".$sendto."'")->fetch();
$err1 = $count[0]==0?1:0;
$err2 = $amount<=0?1:0;
########----------------------------->>>>>>>>>>>>> CONDITIONS

$error = $err1+$err2;
if ($error == 0){

$recdetails = $db->query("SELECT id, firstname, mallu FROM users WHERE email='".$sendto."'")->fetch();

$res = $db->query("INSERT INTO reqmoney SET tto='".$recdetails[0]."', frm='".$uid."', amount='".$amount."', tm='".$tm."', msg='".$msg."', status='0'");

if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
Request Sent Successfully!
</div>";

echo "<center><h2>Request of <strong> $amount $basecurrency </strong> Sent Successfully to $recdetails[1]</h2> <br/><br/></center>";


///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'")->fetch();
$ru = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$recdetails[0]."'")->fetch();

$txt = "You Send a Request of $amount $basecurrency to $ru[0] $ru[1] ($ru[3]).";
abiremail($su[3], "Request Sent", $su[0], $txt);
abirsms($su[2], $txt);


$txt = " $su[0] $su[1] ($su[3]) Request a Payment of $amount $basecurrency.";
abiremail($ru[3], "Payment Request", $ru[0], $txt);
abirsms($ru[2], $txt);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS



}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
Some Problem Occurs, Please Try Again. 
</div>";
}

} else {
  
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
NO USER FOUND WITH THE EMAIL!!
</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Please Input A Valid Amount !
</div>";
}   
  

}

?>


<div class="row">
<br><br>
<div class="col-md-6 col-sm-12">
<a href="<?php echo $baseurl; ?>/RequestMoney" class="btn btn-success btn-lg btn-block"> SEND ANOTHER </a>
</div>  

<div class="col-md-6 col-sm-12">
<a href="<?php echo $baseurl; ?>/Dashboard" class="btn btn-primary btn-lg btn-block"> DASHBOARD </a>
</div>  


</div>


<?php
}else{
 ?>


  
<form action="" method="post"  autocomplete="off">


<div class="row">

<div class="col-md-8">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Request to</strong></label>
<div class="col-md-12">
<input type="email" class="form-control input-lg" id="sendto" name="sendto" placeholder="Request to Email ID" required="">
<br>
<div id="sendtoerr"></div>

</div>
</div>
</div>



<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Amount</strong></label>
<div class="col-md-12">

       <div class="input-group mb15">
         <input class="form-control input-lg" type="text" name="amount" id="am" placeholder="Amount" required="">
         <span class="input-group-addon"><?php echo $basecurrency; ?></span>
       </div>
</div>
</div>
</div>




</div><!-- row	 -->


<div class="row">

<br>
<br>

<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Message</strong></label>
<div class="col-md-12">

<textarea class="form-control" rows="3" name="message" placeholder="Your Message (Optional)"></textarea>

</div>
</div>
</div>


</div><!-- row	 -->



<div class="row"><br>
<br>
<div class="col-md-12">
<button type="submit" class="btn btn-success btn-lg btn-block"> SEND REQUEST </button>
</div>
</div>

</form>


<?php
}
 ?>


</div>
</div>


<?php 
include('include-footer.php');
?>




<script type='text/javascript'>

jQuery(document).ready(function(){

$('#sendto').on('change', function() {
	 $("#sendtoerr").fadeIn();
var email = $("#sendto").val();
$.post( 
       "<?php echo $baseurl; ?>/jsapi-reqto.php",
        { 
        sendto : email
          },
    function(data) {
    $("#sendtoerr").html(data);
      }
               );
});

$('#sendto').on('input', function() {
 $("#sendtoerr").fadeOut();
});



});
</script>


</body>
</html>