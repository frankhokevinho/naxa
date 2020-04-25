<?php
Include('include-global.php');
$pagename = "Request To Me";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Payment Request To Me";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>





<?php 

if ($_POST){
$iidd = $_POST['id'];

$details = $db->query("SELECT tto, frm, amount, tm, msg, status FROM reqmoney WHERE id='".$iidd."'")->fetch();

if($details[0]!=$uid){
	echo "<div class=\"alert alert-danger alert-dismissable\">
	You Don't Have Permission For This Action.
	</div>";
}else{


if($details[5]!=0){
echo "<div class=\"alert alert-danger alert-dismissable\">
You Already Take a Action.
</div>";
}else{

$res = $db->query("UPDATE reqmoney SET status='2' WHERE id='".$iidd."'");

if($res){
	echo "<div class=\"alert alert-success alert-dismissable\">
Request Rejected Successfully.
</div>";
}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
Some Problem Occurs, Please Try Again.
</div>";
}

}



}

}


 ?>






<?php 

$reqmo = $db->query("SELECT COUNT(*) FROM reqmoney WHERE tto='".$uid."' AND status='0'")->fetch();



if($reqmo[0]==0){

echo '<br><br><br><h1 class="text-center" style="font-weight: bold;">No Pending Request Found!</h1><br><br><br>';
}

$ddaa = $db->query("SELECT id, frm, amount, msg FROM reqmoney WHERE tto='".$uid."' AND status='0' ORDER BY id DESC");

while ($data = $ddaa->fetch()){     
$byy = $db->query("SELECT firstname, lastname, email FROM users WHERE id='".$data[1]."'")->fetch();
?>


<div class="portlet box blue">
<div class="portlet-title">
<div class="caption uppercase">

<i class="fa fa-chevron-right"></i> Request Of <strong><?php echo "$data[2] $basecurrency"; ?></strong> from  <strong><?php echo "$byy[0] $byy[1]"; ?></strong>

</div>
</div>

<div class="portlet-body">
<h4><strong>Request From:</strong> <?php echo "$byy[0] $byy[1] ($byy[2])"; ?> <br><br></h4>
<h4><strong>Message:</strong> <?php echo $data[3]; ?></h4>



<div class="row">
<br><br>
<div class="col-md-6">
<a href="<?php echo $baseurl; ?>/RequestDetails/<?php echo $data[0]; ?>" class="btn btn-success btn-lg  btn-block"> <i class="fa fa-desktop"></i>  DETAILS</a>
</div>
<div class="col-md-6">
<button type="button" class="btn btn-danger btn-lg btn-block reject_button" data-toggle="modal" data-target="#RejectModal" data-text="Request Of <strong><?php echo "$data[2] $basecurrency"; ?></strong> from  <strong><?php echo "$byy[0] $byy[1]"; ?>" data-id="<?php echo $data[0]; ?>">
<i class="fa fa-times"></i>  REJECT
</button>
</div>

</div>
</div>
</div>
<?php 
}
 ?>

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
	<form action="" method="post">
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