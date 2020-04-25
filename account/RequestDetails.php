<?php
Include('include-global.php');
$pagename = "Request Details";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Payment Request Details";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>





<?php 
$iidd = $_GET['id'];

$details = $db->query("SELECT tto, frm, amount, tm, msg, status FROM reqmoney WHERE id='".$iidd."'")->fetch();

if($details[0]!=$uid){
echo "<br><br><br><br><div class=\"alert alert-danger alert-dismissable\">
You Don't Have Permission For This Action..
</div>";
}else{


if($details[5]!=0){
echo "<br><br><br><br><div class=\"alert alert-danger alert-dismissable\">
You Already take This Action..
</div>";
}else{




if ($_POST) {

echo '
<div class="portlet box blue">
<div class="portlet-title">
<div class="caption uppercase">
<i class="fa fa-desktop"></i> 

Send  Payment On Request
</div>
</div>
<div class="portlet-body">';




$amount = $details[2];
$message = $details[4];


$count = $db->query("SELECT COUNT(*) FROM users WHERE  id='".$details[1]."'")->fetch();
$err1 = $count[0]==0?1:0;
$err2 = $amount<=0?1:0;

$pkgusersender = $db->query("SELECT pkg FROM users WHERE id='".$uid."'")->fetch();
$pkgdatasender = $db->query("SELECT minamo, maxamo FROM packs WHERE id='".$pkgusersender[0]."'")->fetch();


$err3 = $amount<$pkgdatasender[0]?1:0;
if ($pkgdatasender[1]=="-1") {
$err4 = 0;
}else{
$err4 = $amount>$pkgdatasender[1]?1:0;
}





$pkguser = $db->query("SELECT pkg FROM users WHERE id='".$uid."'")->fetch();
$pkgdata = $db->query("SELECT charged, chargep FROM packs WHERE id='".$pkguser[0]."'")->fetch();
$per = $amount*$pkgdata[1]/100;
$chargeAmo = $per+$pkgdata[0];

$cutbal = $amount+$chargeAmo;
$addbal = $amount;
$paycharge = $chargeAmo;
$reccharge = 0;






$err5 = $cutbal>$mallu?1:0;
$err6 = $amount>remain30($uid)? 1:0;
$err7 = $amount>remain30($details[1])? 1:0;


$error = $err1+$err2+$err3+$err4+$err5+$err6+$err7;
if ($error == 0){
$newbal = $mallu-$cutbal;

$res = $db->query("UPDATE users SET mallu='".$newbal."' WHERE id='".$uid."'");

if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
Payment Completed Successfully!
</div>";


$trx = $txn_id;


$recdetails = $db->query("SELECT id, firstname, mallu FROM users WHERE id='".$details[1]."'")->fetch();
$recnewbal = $recdetails[2]+$addbal;


$db->query("INSERT INTO trx SET who='".$uid."', byy='".$recdetails[0]."', amount='".$amount."', sig='-', typ='Payment Send on Request', charge='".$paycharge."', tm='".$tm."', trxid='".$trx."', msg='".$message."'");


$db->query("UPDATE users SET mallu='".$recnewbal."' WHERE id='".$recdetails[0]."'");

$db->query("INSERT INTO trx SET who='".$recdetails[0]."', byy='".$uid."', amount='".$amount."', sig='+', typ='Payment Received on Request', charge='".$reccharge."', tm='".$tm."', trxid='".$trx."', msg='".$message."'");


 echo "<center><br><br>
 <h1>You Sent <strong> $amount $basecurrency </strong> to $recdetails[1]</h1> <h4> Transaction # $trx</h4>  <br><br></center>";

// ///--------------------------TRX



$db->query("UPDATE reqmoney SET status='1' WHERE id='".$iidd."'");



// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'")->fetch();
$ru = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$recdetails[0]."'")->fetch();

$txt = "You Send $amount $basecurrency to $ru[0] $ru[1] ($ru[3]) On Request. Transcetion # $trx";
abiremail($su[3], "Payment Sent  On Request", $su[0], $txt);
abirsms($su[2], $txt);


$txt = "Payment Received From $su[0] $su[1] ($su[3])  On Request. Amount:  $amount $basecurrency . Transcetion # $trx";
abiremail($ru[3], "Payment Received  On Request", $ru[0], $txt);
abirsms($ru[2], $txt);
// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS


}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
Some Problem Occurs, Please Try Again. 
</div>";
}

echo '
<div class="row"><br>
<br>
<div class="col-md-6">
<a href="'.$baseurl.'/RequestToMe" class="btn blue btn-lg btn-block"> PENDING REQUEST </a>
</div>

<div class="col-md-6">
<a href="'.$baseurl.'/Dashboard" class="btn btn-success btn-lg btn-block"> DASHBOARD </a>
</div>
</div>
';




} else {
  
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
NO USER FOUND WITH THE EMAIL !
</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
AMOUNT MUST BE A POSITIVE NUMBER!
</div>";
}   

if ($err3 == 1 || $err4 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">

You Can Only Send Between $pkgdatasender[0] - $pkgdatasender[1]  $basecurrency 


</div>";
}   
  
if ($err5 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
You Don't Have Enough Money in Your Account!
</div>";
} 


  if ($err6 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
You Do Not Have Enough LIMIT For This Transaction !
</div>";
}   


if ($err7 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Receiver Do Not Have Enough LIMIT For This Transaction !
</div>";
}   


echo '
<div class="row"><br>
<br>
<div class="col-md-6">
<a href="'.$baseurl.'/SendMoney" class="btn blue btn-lg btn-block"> SEND MONEY </a>
</div>

<div class="col-md-6">
<a href="'.$baseurl.'/Dashboard" class="btn btn-success btn-lg btn-block"> DASHBOARD </a>
</div>
</div>
';



}




}else{
///////post

$reuser = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$details[1]."'")->fetch();
?>



<div class="portlet box blue">
<div class="portlet-title">
<div class="caption uppercase">
<i class="fa fa-desktop"></i> 
<?php 

echo "You Are Going to Send  <strong> $details[2] $basecurrency </strong> to $reuser[0] $reuser[1]";
 ?>


 </div>
</div>

<div class="portlet-body">


<?php 
$amount = $details[2];
$message = $details[4];

$todata = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$details[1]."'")->fetch();
$pkguser = $db->query("SELECT pkg FROM users WHERE id='".$uid."'")->fetch();
$pkgdata = $db->query("SELECT charged, chargep FROM packs WHERE id='".$pkguser[0]."'")->fetch();
$per = $amount*$pkgdata[1]/100;
$chargeAmo = $per+$pkgdata[0];
$gt = $amount+$chargeAmo;
?>

<div class="table-scrollable">
<table class="table table-bordered table-hover">
<tbody>


<tr class="">
<td><strong style="font-size: 1.5em;" class="pull-right">To</strong> </td>
<td> <strong style="font-size: 1.2em;"><?php echo "$todata[0] $todata[1] ($todata[2])"; ?></strong></td>
</tr>

<tr class="">
<td><strong style="font-size: 1.5em;" class="pull-right">Message</strong> </td>
<td> <strong><?php echo "$message"; ?></strong></td>
</tr>


<tr class="">
<td><strong style="font-size: 1.5em;" class="pull-right">Amount</strong> </td>
<td> <strong style="font-size: 1.2em;"><?php echo "$amount $basecurrency"; ?></strong></td>
</tr>

<tr class="">
<td><strong style="font-size: 1.5em;" class="pull-right">Charge</strong> </td>
<td> <strong style="font-size: 1.2em;"><?php echo "$chargeAmo $basecurrency"; ?></strong></td>
</tr>


<tr class="info">
<td><strong style="font-size: 1.5em;" class="pull-right">TOTAL</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$gt $basecurrency"; ?></strong></td>
</tr>





</tbody>
</table>
</div>




  
<form action="" method="post">

<input type="hidden" name="success" value="1">

<div class="row"><br>
<br>
<div class="col-md-6">
<button type="button" class="btn btn-danger btn-lg btn-block reject_button" data-toggle="modal" data-target="#RejectModal" data-text="Request Of <strong><?php echo "$amount $basecurrency"; ?></strong> from  <strong><?php echo "$byy[0] $byy[1]"; ?>" data-id="<?php echo $iidd; ?>">
<i class="fa fa-times"></i>  REJECT
</button>
</div>

<div class="col-md-6">
<button type="submit" class="btn btn-success btn-lg btn-block"> <i class="fa fa-paper-plane"></i> SEND </button>
</div>
</div>

</form>







<?php
}
}
}
 ?>


</div>
</div>











<div class="modal fade" id="RejectModal" tabindex="-1" role="basic" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Reject Request</h4>
</div>
<div class="modal-body text-center"> 

<h2>Are You Sure? </h2>
<h4>You Want To Reject <span class="abir_text"> </span></h4>





</div>
<div class="modal-footer">
<div class="row">
	
<div class="col-md-6">
<button type="button" class="btn dark btn-outline btn-block" data-dismiss="modal">CANCEL</button>
</div>

<div class="col-md-6">
	<form action="<?php echo "$baseurl"; ?>/RequestToMe" method="post">
	<input class="abir_id" name="id" placeholder="" type="hidden">
	<button type="submit" class="btn green btn-block">REJECT NOW</button>
	</form>

</div>

</div>




</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>





<?php 
include('include-footer.php');
?>



<script>
    $(document).ready(function(){
        
$(document).on( "click", '.reject_button',function(e) {

        var text = $(this).data('text');
        var id = $(this).data('id');

        $(".abir_id").val(id);
        $(".abir_text").html(text);


    });




        
    });


</script>


</body>
</html>