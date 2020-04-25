<?php
Include('include-global.php');
$pagename = "Withdraw Money";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Withdraw Money From Your $basetitle Account";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>


<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
WITHDRAW MONEY </div>
</div>

<div class="portlet-body">


<?php 
if ($_POST) {

$method = $_POST["method"];
$amount = $_POST["amount"];
$info = $_POST["info"];
$message = $_POST["message"];



$count = $db->query("SELECT COUNT(*) FROM wd_method WHERE id='".$method."'")->fetch();
$err1 = $count[0]==0?1:0;
$err2 = $amount<=0?1:0;


$wddata = $db->query("SELECT name, minamo, maxamo, charged, chargep, processtm FROM wd_method WHERE id='".$method."'")->fetch();

$err3 = $amount<$wddata[1]?1:0;
$err4 = $amount>$wddata[2]?1:0;




$per = $amount*$wddata[4]/100;
$charge = $per+$wddata[3];
$cutbal = $amount+$charge;




$err5 = $cutbal>$mallu?1:0;
$err6 = $amount>remain30($uid)? 1:0;


$error = $err1+$err2+$err3+$err4+$err5+$err6;
if ($error == 0){
$newbal = $mallu-$cutbal;

$res = $db->query("UPDATE users SET mallu='".$newbal."' WHERE id='".$uid."'");

if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
Withdraw Request Submitted Successfully!
</div>";


$trx = $txn_id;

$msg = "$message <br> $info";

$db->query("INSERT INTO trx SET who='".$uid."', byy='000wd', amount='".$amount."', sig='-', typ='Withdraw By ".$wddata[0]."', charge='".$charge."', tm='".$tm."', trxid='".$trx."', msg='".$msg."'");

$db->query("INSERT INTO wd SET method='".$method."', usr='".$uid."', amount='".$amount."', charge='".$charge."', tm='".$tm."', details='".$info."', msg='".$msg."', trx='".$trx."'");


 echo "<center><br><br>
 <h1>Withdraw Request of <strong> $amount $basecurrency via $wddata[0] </strong> Submitted Successfully! </h1> <h4> Transaction # $trx</h4> 
 <br><br></center>";



// ///--------------------------TRX

// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$uid."'")->fetch();
$txt = "You Withdraw $amount $basecurrency via  $wddata[0] . Transcetion # $trx";
abiremail($su[3], "Withdraw Money", $su[0], $txt);
abirsms($su[2], $txt);
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
<a href="'.$baseurl.'/WithdrawMoney" class="btn blue btn-lg btn-block"> WITHDRAW AGAIN </a>
</div>

<div class="col-md-6">
<a href="'.$baseurl.'/Dashboard" class="btn btn-success btn-lg btn-block"> DASHBOARD </a>
</div>
</div>
';




} else {
  
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
UNKNOWN WITHDRAW METHOD !!
</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
AMOUNT MUST BE A POSITIVE NUMBER!
</div>";
}   

if ($err3 == 1 || $err4 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
You Can Only Withdraw Between $wddata[1] - $wddata[2]  $basecurrency 
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



echo '
<div class="row"><br>
<br>
<div class="col-md-6">
<a href="'.$baseurl.'/WithdrawMoney" class="btn blue btn-lg btn-block"> WITHDRAW MONEY </a>
</div>

<div class="col-md-6">
<a href="'.$baseurl.'/Dashboard" class="btn btn-success btn-lg btn-block"> DASHBOARD </a>
</div>
</div>
';



}




}
?>


</div>
</div>


<?php 
include('include-footer.php');
?>
</body>
</html>