<?php
Include('include-global.php');
$pagename = "Deposit  Preview";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Add Money To Your $basetitle Account";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>


<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-desktop"></i> DEPOSIT PREVIEW </div>
</div>

<div class="portlet-body">


<?php 
if ($_POST) {
$method = $_POST["id"];
$amount =  round($_POST["amount"], $baseDecimal);

$data = $db->query("SELECT name, minamo, maxamo, charged, chargep, rate, status FROM deposit_method WHERE id='".$method."'")->fetch();

$err1 = $amount<=0 ? 1:0;
$err2 = $data[6]!=1 ? 1:0; // Status OFF
$err3 = $amount<$data[1]?1:0;
$err4 = $amount>$data[2]?1:0;


$error = $err1+$err2+$err3+$err4;
if ($error == 0){

$per = $amount*$data[4]/100;
$charge =  round($per+$data[3] , $baseDecimal);
$gt =  round($amount+$charge , $baseDecimal);
$inUS = round($gt/$data[5] , $baseDecimal);


$un = uniqid();
$ra = rand(10000,99999);
$dtrx = md5($tm.$un.$ra);

?>






<div class="table-scrollable">
<table class="table table-bordered table-hover">
<tbody>


<tr>
<td><strong style="font-size: 1.5em;" class="pull-right">Method</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$data[0]"; ?></strong></td>
</tr>



<tr class="">
<td><strong style="font-size: 1.5em;" class="pull-right">Amount</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$amount $basecurrency"; ?></strong></td>
</tr>

<tr class="">
<td><strong style="font-size: 1.5em;" class="pull-right">Charge</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$charge $basecurrency"; ?></strong></td>
</tr>


<tr class="info">
<td><strong style="font-size: 1.5em;" class="pull-right">TOTAL</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$gt $basecurrency"; ?></strong></td>
</tr>

<tr class="success">
<td><strong style="font-size: 1.5em;" class="pull-right">IN USD</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$inUS USD"; ?></strong></td>
</tr>





</tbody>
</table>
</div>





<div class="row"><br><br>

<?php 
$res = $db->query("INSERT INTO deposit_data SET usid='".$uid."', tm='".$tm."', method='".$method."', track='".$dtrx."', amount='".$amount."', charge='".$charge."', amountus='".$inUS."'");
if ($res) {
$_SESSION['depoistTrack'] = $dtrx;
?>
<div class="col-md-6">
<a href="<?php echo $baseurl;?>/AddMoney" class="btn btn-danger btn-lg btn-block"> CANCEL </a>
</div>

<div class="col-md-6">
<a href="<?php echo $baseurl;?>/DepositNow" class="btn btn-success btn-lg btn-block"> DEPOSIT NOW</a>
</div>

<?php
}else{
echo "<div class=\"alert alert-danger alert-dismissable uppercase\">
<b>SOME PROBLEM OCCURE, PLEASE RELOAD THE PAGE !</b>
</div>";
}


 ?>








</div>




<?php
}else{
  
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<b>AMOUNT MUST BE A POSITIVE NUMBER!</b>
</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<b>DEPOSIT  METHOD IS NOT AVAILABLE AT THIS TIME</b>
</div>";
}   

if ($err3 == 1 || $err4 == 1){
echo "<div class=\"alert alert-danger alert-dismissable uppercase\">
<b>You Can Only Deposit Between $data[1] - $data[2]  $basecurrency </b>
</div>";
}   

echo '
<div class="row"><br>
<br>
<div class="col-md-6">
<a href="'.$baseurl.'/AddMoney" class="btn blue btn-lg btn-block"> ADD MONEY </a>
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