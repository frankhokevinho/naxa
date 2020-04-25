<?php
Include('include-global.php');
$pagename = "Deposit";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Add Money To Your $basetitle Account";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>



<div class="row">

<br>
<div class="col-md-6 col-md-offset-3">
	<a href="<?php echo $baseurl; ?>/AddMoneyLog" class="btn btn-info btn-lg btn-block uppercase">Add Money LOG</a>
</div>

<br><br><br>
<br><br><br>
</div><!-- row -->

<div class="row">




<?php

////COL SIZE

$countActive = $db->query("SELECT COUNT(*) FROM deposit_method WHERE status='1'")->fetch();

if ($countActive[0]==1) {
	$col= "6 col-md-offset-3";
}elseif ($countActive[0]==2) {
	$col= "6";
}elseif ($countActive[0]==3) {
	$col= "4";
}elseif ($countActive[0]==4) {
	$col= "3";
}elseif ($countActive[0]==0) {

echo '<br><br><br><h1 class="text-center" style="font-weight: bold;">NO DEPOSIT  METHOD IS NOT AVAILABLE AT THIS TIME!</h1><br><br><br>';

}else{
$col= "4";
}


////COL SIZE

$ddaa = $db->query("SELECT id, name, minamo, maxamo FROM deposit_method WHERE status='1' ORDER BY id");
while ($data = $ddaa->fetch()) {
?>

<div class="col-md-<?php echo $col; ?>">

<div class="portlet box blue">
<div class="portlet-title">
<div class="caption bold">
<?php echo $data[1]; ?> </div>
</div>
<div class="portlet-body text-center">



<img src="<?php echo $fronturl; ?>/assets/images/deposit-method/method<?php echo $data[0]; ?>.jpg" class="img-responsive" style="width:100%;" alt="Pic"> 

<br>

<?php
echo "
<button type=\"button\" class=\"btn btn-success btn-block bold deposit_button\" 
data-toggle=\"modal\" data-target=\"#DepositModal\"
data-max=\"$data[3]\"
data-min=\"$data[2]\"
data-name=\"$data[1]\"
data-id=\"$data[0]\">
<i class=\"fa fa-money\"></i> DEPOSIT NOW
</button> 

";
?>

</div>
</div>
</div>


<?php 
}
?>


</div><!-- row -->






<!-- Modal for DEPOSIT button -->
<div class="modal fade" id="DepositModal" tabindex="-1" role="basic" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">ADD MONEY VIA <b class="abir_name">-</b></h4>
</div>

<form method="post" action="<?php echo $baseurl; ?>/DepositPreview">


<div class="modal-body"> 

<input class="form-control abir_id" type="hidden" name="id">

<div class="row">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">DEPOSIT AMOUNT</strong>
<span class="abir_limits"></span>
</label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" name="amount" type="text" autocomplete="off">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">PREVIEW</button>
</div>

</form>

</div>
</div>
</div>
<!-- /.modal -->


<?php 
include('include-footer.php');
?>



<script>
    $(document).ready(function(){
        
$(document).on( "click", '.deposit_button',function(e) {

        var name = $(this).data('name');
        var id = $(this).data('id');
        var min = $(this).data('min');
        var max = $(this).data('max');


        $(".abir_id").val(id);
        $(".abir_name").text(name);
        $(".abir_limits").text("( "+min+"-"+max+" <?php echo $basecurrency; ?> )");
    });

       
});


</script>

</body>
</html>