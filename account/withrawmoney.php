<?php
Include('include-global.php');
$pagename = "Withdraw";
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
WITHDRAW MONEY</div>

<div class="actions">


<span data-toggle="tooltip" title="Withdraw Log" >
<a class="btn btn-circle btn-icon-only btn-default" href="<?php echo $baseurl; ?>/WithdrawLog">
<i class="fa fa-list"></i>
</a>
</span>


</div>
</div>


<div class="portlet-body">




<form action="<?php echo $baseurl; ?>/WithdrawPreview" method="post" autocomplete="off">




<div class="row">

<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Method</strong></label>
<div class="col-md-12">

<select name="method" id="method" class="form-control input-lg" required="">
<option value="">Select Withdraw Method</option>
<?php
$ddaa = $db->query("SELECT id, name FROM wd_method ORDER BY id");
while($data = $ddaa->fetch()){
echo "<option value=\"$data[0]\">$data[1]</option>";
}
?>
</select>



</div>
</div>
</div>


<div class="col-md-8">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Amount</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg" type="text" name="amount" id="am" placeholder="Amount" required="">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>

<span id="limits" class="uppercase"></span>
</div>
</div>
</div>

</div><!-- row	 -->


<div class="row">
<br><br>

<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Information To send money</strong></label>
<div class="col-md-12">
<textarea class="form-control" rows="3" name="info" placeholder="Provide All information Needed to Send The Money to You" required=""></textarea>
</div>
</div>
</div>

</div><!-- row	 -->




<div class="row">
<br><br>

<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Your Message</strong></label>
<div class="col-md-12">
<textarea class="form-control" rows="3" name="message" placeholder="Your Message (Optional)"></textarea>
</div>
</div>
</div>

</div><!-- row	 -->






<div class="row">
<br><br>

<div class="col-md-12">
<div class="form-group">
<div class="col-md-12">
<button type="submit" class="btn btn-success btn-lg btn-block">PREVIEW</button>
</div>
</div>
</div>

</div><!-- row	 -->



</form>





</div>
</div>

<?php 
include('include-footer.php');
?>



<script type='text/javascript'>

jQuery(document).ready(function(){



$('#method').on('change', function() {
var id = $("#method").val();
var am = $("#am").val();
$.post( 
       "<?php echo $baseurl; ?>/jsapi-wd.php",
        { 
        id : id,
        am : am
          },
    function(data) {
    $("#limits").html(data);
      }
               );
});


$('#am').on('input', function() {
var id = $("#method").val();
var am = $("#am").val();
$.post( 
       "<?php echo $baseurl; ?>/jsapi-wd.php",
        { 
        id : id,
        am : am
          },
    function(data) {
    $("#limits").html(data);
      }
               );
});




});
</script>
</body>
</html>