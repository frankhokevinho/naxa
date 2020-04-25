<?php
include ('include/header.php');
?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">
<?php
include ('include/sidebar.php');
?>

<div class="page-content-wrapper">
<div class="page-content">

<h3 class="page-title uppercase bold"> Dashboard <small>Statistics</small></h3>
<hr>


<?php
$numuser = $db->query("SELECT COUNT(*) FROM users")->fetch();
$numuserb =  $db->query("SELECT COUNT(*) FROM users WHERE block='1'")->fetch();
$numusermv =  $db->query("SELECT COUNT(*) FROM users WHERE mv='0'")->fetch();
$numuserev =  $db->query("SELECT COUNT(*) FROM users WHERE ev='0'")->fetch();
$numuserv =  $db->query("SELECT COUNT(*) FROM users WHERE ev='1' AND mv='1'")->fetch();
$numuserapi =  $db->query("SELECT COUNT(*) FROM users WHERE api<>''")->fetch();
?>
<div class="row">
<div class="col-md-12">
<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i> USERS STATISTICS </div>
</div>
<div class="portlet-body text-center">
<div class="row">


<!-- START -->
<a href="<?php echo $adminurl; ?>/AllUsers">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat blue">
<div class="visual">
<i class="fa fa-users"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numuser[0]; ?>"><?php echo $numuser[0]; ?></span>
</div>
<div class="desc uppercase"> TOTAL  USERS </div>
</div>
</div>
</div>
</a>
<!-- END -->


<!-- START -->
<a href="<?php echo $adminurl; ?>/BannedUsers">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat red">
<div class="visual">
<i class="fa fa-times"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numuserb[0]; ?>"><?php echo $numuserb[0]; ?></span>
</div>
<div class="desc uppercase"> BANNED  USERS </div>
</div>
</div>
</div>
</a>
<!-- END -->


<!-- START -->
<a href="<?php echo $adminurl; ?>/ApiPermittedUsers">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat purple">
<div class="visual">
<i class="fa fa-cog"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numuserapi[0]; ?>"><?php echo $numuserapi[0]; ?></span>
</div>
<div class="desc uppercase"> Api Permitted  USERS </div>
</div>
</div>
</div>
</a>
<!-- END -->



<!-- START -->
<a href="<?php echo $adminurl; ?>/VerifiedUsers">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat green">
<div class="visual">
<i class="fa fa-check"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numuserv[0]; ?>"><?php echo $numuserv[0]; ?></span>
</div>
<div class="desc uppercase"> Verified  USERS </div>
</div>
</div>
</div>
</a>
<!-- END -->




<!-- START -->
<a href="<?php echo $adminurl; ?>/MobileUnverifiedUsers">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat yellow">
<div class="visual">
<i class="fa fa-mobile"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numusermv[0]; ?>"><?php echo $numusermv[0]; ?></span>
</div>
<div class="desc uppercase"> Mobile Unverified Users </div>
</div>
</div>
</div>
</a>
<!-- END -->

<!-- START -->
<a href="<?php echo $adminurl; ?>/EmailUnverifiedUsers">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat yellow">
<div class="visual">
<i class="fa fa-envelope"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numuserev[0]; ?>"><?php echo $numuserev[0]; ?></span>
</div>
<div class="desc uppercase"> Email Unverified Users </div>
</div>
</div>
</div>
</a>
<!-- END -->




</div> 
</div>
</div>
</div>
</div>



<!-- ############################ row ################################# -->

<?php
$tfuser =  $db->query("SELECT SUM(mallu) FROM users")->fetch();
$generated =  $db->query("SELECT SUM(amount) FROM generated")->fetch();
$deposited =  $db->query("SELECT SUM(amount) FROM deposit_data WHERE status='1'")->fetch();
?>

<div class="row">
<div class="col-md-12">
<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-dollar"></i> FUND STATISTICS </div>
</div>
<div class="portlet-body text-center">
<div class="row">


<!-- START -->
<a href="<?php echo $adminurl; ?>/AllUsers">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat blue">
<div class="visual">
<i class="fa fa-users"></i>
</div>
<div class="details">
<div class="number">
<?php echo $basecur; ?>
<span data-counter="counterup" data-value="<?php echo round($tfuser[0] , $baseDecimal); ?>"><?php echo round($tfuser[0] , $baseDecimal); ?></span>
</div>
<div class="desc uppercase"> ALL USERS BALANCE </div>
</div>
</div>
</div>
</a>
<!-- END -->


<!-- START -->
<a href="<?php echo $adminurl; ?>/AdminGeneratedFund">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat red">
<div class="visual">
<i class="fa fa-cog"></i>
</div>
<div class="details">
<div class="number">
<?php echo $basecur; ?>
<span data-counter="counterup" data-value="<?php echo round($generated[0] , $baseDecimal); ?>"><?php echo round($generated[0] , $baseDecimal); ?></span>
</div>
<div class="desc uppercase"> ADMIN GENERATED </div>
</div>
</div>
</div>
</a>
<!-- END -->




<!-- START -->
<a href="<?php echo $adminurl; ?>/UserDepositedFund">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat green">
<div class="visual">
<i class="fa fa-user"></i>
</div>
<div class="details">
<div class="number">
<?php echo $basecur; ?>
<span data-counter="counterup" data-value="<?php echo round($deposited[0] , $baseDecimal); ?>"><?php echo round($deposited[0] , $baseDecimal); ?></span>
</div>
<div class="desc uppercase"> User Deposited </div>
</div>
</div>
</div>
</a>
<!-- END -->


</div> 
</div>
</div>
</div>
</div>


<!-- ############################ row ################################# -->

<?php
$numtrx =  $db->query("SELECT COUNT(*) FROM trx")->fetch();
$amounttrx =  $db->query("SELECT SUM(amount) FROM trx")->fetch();
$chargetrx =  $db->query("SELECT SUM(charge) FROM trx")->fetch();
?>

<div class="row">
<div class="col-md-12">
<div class="portlet box purple">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-th"></i> TRANSACTION STATISTICS </div>
</div>
<div class="portlet-body text-center">
<div class="row">



<!-- START -->
<a href="<?php echo $adminurl; ?>/Transactions">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat green">
<div class="visual">
<i class="fa fa-th"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numtrx[0]; ?>"><?php echo $numtrx[0]; ?></span>
</div>
<div class="desc uppercase"> Number of Trx </div>
</div>
</div>
</div>
</a>
<!-- END -->

<!-- START -->
<a href="<?php echo $adminurl; ?>/Transactions">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat purple">
<div class="visual">
<i class="fa fa-dollar"></i>
</div>
<div class="details">
<div class="number">
<?php echo $basecur; ?>
<span data-counter="counterup" data-value="<?php echo round($amounttrx[0] , $baseDecimal); ?>"><?php echo round($amounttrx[0] , $baseDecimal); ?></span>
</div>
<div class="desc uppercase"> Amount TRANSACTed </div>
</div>
</div>
</div>
</a>
<!-- END -->

<!-- START -->
<a href="<?php echo $adminurl; ?>/Transactions">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat yellow">
<div class="visual">
<i class="fa fa-cogs"></i>
</div>
<div class="details">
<div class="number">
<?php echo $basecur; ?>
<span data-counter="counterup" data-value="<?php echo round($chargetrx[0] , $baseDecimal); ?>"><?php echo round($chargetrx[0] , $baseDecimal); ?></span>
</div>
<div class="desc uppercase"> TRANSACTION Charge </div>
</div>
</div>
</div>
</a>
<!-- END -->


</div> 
</div>
</div>
</div>
</div>






<!-- ############################ row ################################# -->

<?php
$nummethod =  $db->query("SELECT COUNT(*) FROM deposit_method WHERE status='1'")->fetch();
$numdeposit =  $db->query("SELECT COUNT(*) FROM deposit_data WHERE status='1'")->fetch();
$deposited =  $db->query("SELECT SUM(amount) FROM deposit_data WHERE status='1'")->fetch();
$depositedcharge =  $db->query("SELECT SUM(charge) FROM deposit_data WHERE status='1'")->fetch();

?>

<div class="row">
<div class="col-md-12">
<div class="portlet box blue-ebonyclay">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-th"></i> DEPOSIT STATISTICS </div>
</div>
<div class="portlet-body text-center">
<div class="row">



<!-- START -->
<a href="<?php echo $adminurl; ?>/DepositMethod">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat green-meadow ">
<div class="visual">
<i class="fa fa-th"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $nummethod[0]; ?>"><?php echo $nummethod[0]; ?></span>
</div>
<div class="desc uppercase"> DEPOSIT METHOD </div>
</div>
</div>
</div>
</a>
<!-- END -->

<!-- START -->
<a href="<?php echo $adminurl; ?>/UserDepositedFund">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat blue">
<div class="visual">
<i class="fa fa-dollar"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numdeposit[0]; ?>"><?php echo $numdeposit[0]; ?></span>
</div>
<div class="desc uppercase">Number Of Deposit </div>
</div>
</div>
</div>
</a>
<!-- END -->

<!-- START -->
<a href="<?php echo $adminurl; ?>/UserDepositedFund">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat green">
<div class="visual">
<i class="fa fa-dollar"></i>
</div>
<div class="details">
<div class="number">
<?php echo $basecur; ?>
<span data-counter="counterup" data-value="<?php echo round($deposited[0] , $baseDecimal); ?>"><?php echo round($deposited[0] , $baseDecimal); ?></span>
</div>
<div class="desc uppercase"> Amount Deposited </div>
</div>
</div>
</div>
</a>
<!-- END -->

<!-- START -->
<a href="<?php echo $adminurl; ?>/UserDepositedFund">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat yellow">
<div class="visual">
<i class="fa fa-cogs"></i>
</div>
<div class="details">
<div class="number">
<?php echo $basecur; ?>
<span data-counter="counterup" data-value="<?php echo round($depositedcharge[0] , $baseDecimal); ?>"><?php echo round($depositedcharge[0] , $baseDecimal); ?></span>
</div>
<div class="desc uppercase"> Deposit Charge </div>
</div>
</div>
</div>
</a>
<!-- END -->


</div> 
</div>
</div>
</div>
</div>









<!-- ############################ row ################################# -->

<?php
$nummethod =  $db->query("SELECT COUNT(*) FROM wd_method")->fetch();
$numwd =  $db->query("SELECT COUNT(*) FROM wd")->fetch();
$numwdp =  $db->query("SELECT COUNT(*) FROM wd WHERE status='0'")->fetch();
$numwds =  $db->query("SELECT COUNT(*) FROM wd WHERE status='1'")->fetch();
$numwdr =  $db->query("SELECT COUNT(*) FROM wd WHERE status='2'")->fetch();
$wded =  $db->query("SELECT SUM(amount) FROM wd WHERE status='1'")->fetch();
$wdcharge =  $db->query("SELECT SUM(charge) FROM wd WHERE status='1'")->fetch();

?>

<div class="row">
<div class="col-md-12">
<div class="portlet box red-thunderbird ">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-th"></i> WITHDRAW STATISTICS </div>
</div>
<div class="portlet-body text-center">
<div class="row">



<!-- START -->
<a href="<?php echo $adminurl; ?>/WithdrawMethod">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat green-meadow ">
<div class="visual">
<i class="fa fa-th"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $nummethod[0]; ?>"><?php echo $nummethod[0]; ?></span>
</div>
<div class="desc uppercase"> WITHDRAW METHOD </div>
</div>
</div>
</div>
</a>
<!-- END -->



<!-- START -->
<a href="<?php echo $adminurl; ?>/WithdrawSuccess">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat green">
<div class="visual">
<i class="fa fa-dollar"></i>
</div>
<div class="details">
<div class="number">
<?php echo $basecur; ?>
<span data-counter="counterup" data-value="<?php echo round($wded[0] , $baseDecimal); ?>"><?php echo round($wded[0] , $baseDecimal); ?></span>
</div>
<div class="desc uppercase"> Amount WITHDRAWN </div>
</div>
</div>
</div>
</a>
<!-- END -->


<!-- START -->
<a href="<?php echo $adminurl; ?>/WithdrawSuccess">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat yellow">
<div class="visual">
<i class="fa fa-cogs"></i>
</div>
<div class="details">
<div class="number">
<?php echo $basecur; ?>
<span data-counter="counterup" data-value="<?php echo round($wdcharge[0] , $baseDecimal); ?>"><?php echo round($wdcharge[0] , $baseDecimal); ?></span>
</div>
<div class="desc uppercase"> WITHDRAW Charge </div>
</div>
</div>
</div>
</a>
<!-- END -->


<!-- START -->
<a href="<?php echo $adminurl; ?>/WithdrawAll">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat blue">
<div class="visual">
<i class="fa fa-dollar"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numwd[0]; ?>"><?php echo $numwd[0]; ?></span>
</div>
<div class="desc uppercase">Number Of WITHDRAW </div>
</div>
</div>
</div>
</a>
<!-- END -->

<!-- START -->
<a href="<?php echo $adminurl; ?>/WithdrawSuccess">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat green">
<div class="visual">
<i class="fa fa-dollar"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numwds[0]; ?>"><?php echo $numwds[0]; ?></span>
</div>
<div class="desc uppercase"> SUCCESS </div>
</div>
</div>
</div>
</a>
<!-- END -->

<!-- START -->
<a href="<?php echo $adminurl; ?>/WithdrawPending">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat yellow">
<div class="visual">
<i class="fa fa-dollar"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numwdp[0]; ?>"><?php echo $numwdp[0]; ?></span>
</div>
<div class="desc uppercase"> Pending </div>
</div>
</div>
</div>
</a>
<!-- END -->

<!-- START -->
<a href="<?php echo $adminurl; ?>/WithdrawRefunded">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
<div class="dashboard-stat red">
<div class="visual">
<i class="fa fa-dollar"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?php echo $numwdr[0]; ?>"><?php echo $numwdr[0]; ?></span>
</div>
<div class="desc uppercase"> Refunded </div>
</div>
</div>
</div>
</a>
<!-- END -->



</div> 
</div>
</div>
</div>
</div>










</div>
</div>


<?php
include ('include/footer.php');
?>
</body>
</html>