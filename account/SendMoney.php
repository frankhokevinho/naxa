<?php
Include('include-global.php');
$pagename = "Send Money";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Send Money To Another $basetitle Member ";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>


<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-paper-plane"></i> SEND MONEY </div>
</div>

<div class="portlet-body">

  
<form action="<?php echo $baseurl; ?>/Preview" method="post" autocomplete="off">


<div class="row">

<div class="col-md-12">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Send to</strong></label>
<div class="col-md-12">
<input type="email" class="form-control input-lg" id="sendto" name="sendto" placeholder="Receiver Email ID" required="">
<br>
<div id="sendtoerr"></div>

</div>
</div>
</div>

</div><!-- row	 -->

<div class="row">

<br>
<br>


<div class="col-md-8">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Amount</strong>

<?php 
$pkguser = $db->query("SELECT pkg FROM users WHERE id='".$uid."'")->fetch();
$pkgdata = $db->query("SELECT minamo, maxamo, limit30 FROM packs WHERE id='".$pkguser[0]."'")->fetch();

$min = $pkgdata[0]=="0" ? "1":"$pkgdata[0]  ";



$trxlimit = $pkgdata[2]-last30($uid);

$max1 = $pkgdata[2]=="-1" ? 99999999999:$trxlimit;
$max2 = $pkgdata[1]=="-1" ? 99999999999:$pkgdata[1];

$maxshow = min($max1, $max2, $mallu);
$max = $maxshow<0? 0:$maxshow;

echo "( $min - $max $basecurrency )"; 


?>


</label>
<div class="col-md-12">

       <div class="input-group mb15">
         <input class="form-control input-lg" type="text" name="amount" id="am" placeholder="Amount" required="">
         <span class="input-group-addon"><?php echo $basecurrency; ?></span>
       </div>
</div>
</div>
</div>




<div class="col-md-4">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Transaction Charge</strong></label>
<div class="col-md-12" style="text-transform: uppercase; font-weight: bold;">
<input data-toggle="toggle" data-on="I Will Pay The Charge" data-off="Receiver Will Pay The Charge" data-onstyle="success" data-offstyle="danger" data-width="100%" data-height="46" type="checkbox" name="charge">
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
<button type="submit" class="btn btn-success btn-lg btn-block"> PREVIEW </button>
</div>
</div>

</form>




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
       "<?php echo $baseurl; ?>/jsapi-sendto.php",
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