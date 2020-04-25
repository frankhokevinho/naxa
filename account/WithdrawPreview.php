<?php
Include('include-global.php');
$pagename = "Withdraw  Preview";
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
<i class="fa fa-desktop"></i> WITHDRAW PREVIEW </div>
</div>

<div class="portlet-body">


<?php 
if ($_POST) {
$method = $_POST["method"];
$amount = round($_POST["amount"], $baseDecimal);
$info = $_POST["info"];
$message = $_POST["message"];


if ($amount<=0) {

echo '<br><br><br><h1 class="text-center" style="font-weight: bold;">AMOUNT MUST BE A POSITIVE NUMBER!</h1><br><br><br>';

}else{

$wddata = $db->query("SELECT name, minamo, maxamo, charged, chargep, processtm FROM wd_method WHERE id='".$method."'")->fetch();

$per = $amount*$wddata[4]/100;
$charge = round($per+$wddata[3], $baseDecimal);
$gt = round($amount+$charge, $baseDecimal);
?>

<div class="table-scrollable">
<table class="table table-bordered table-hover">
<tbody>


<tr>
<td><strong style="font-size: 1.5em;" class="pull-right">Method</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$wddata[0]"; ?></strong></td>
</tr>

<tr>
<td><strong style="font-size: 1.5em;" class="pull-right">TO</strong> </td>
<td> <strong><?php echo "$info"; ?></strong></td>
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
<td> <strong style="font-size: 1.2em;"><?php echo "$charge $basecurrency"; ?></strong></td>
</tr>


<tr class="info">
<td><strong style="font-size: 1.5em;" class="pull-right">TOTAL</strong> </td>
<td> <strong style="font-size: 1.5em;"><?php echo "$gt $basecurrency"; ?></strong></td>
</tr>





</tbody>
</table>
</div>




  
<form action="<?php echo $baseurl;?>/WithdrawFinal" method="post">

<input type="hidden" name="method" value="<?php echo $method; ?>">
<input type="hidden" name="amount" value="<?php echo $amount; ?>">
<input type="hidden" name="info" value="<?php echo $info; ?>">
<input type="hidden" name="message" value="<?php echo $message; ?>">

<div class="row"><br>
<br>
<div class="col-md-6">
<a href="<?php echo $baseurl;?>/WithdrawMoney" class="btn btn-danger btn-lg btn-block"> CANCEL </a>
</div>

<div class="col-md-6">
<button type="submit" class="btn btn-success btn-lg btn-block"> WITHDRAW </button>
</div>
</div>

</form>

<?php 
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