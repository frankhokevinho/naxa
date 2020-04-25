<?php
Include('include-global.php');
$pagename = "Withdraw Log";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Withdraw Log of Your $basetitle Account";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>


<?php 


//----------->>>>> PAGE
$itemPerPage = 15;
$ttl = $db->query("SELECT COUNT(*) FROM wd WHERE usr='".$uid."'")->fetch();
$tpg = ceil($ttl[0]/$itemPerPage);

$page = isset($_GET['page']) ? $_GET["page"]:0;

if($page<="0" || $page==""){
$page = 1;
}
$start = $page*$itemPerPage-$itemPerPage;
//----------->>>>> PAGE



$ddaa = $db->query("SELECT id, method, usr, amount, charge, tm, details, msg, status, trx FROM wd WHERE usr='".$uid."' ORDER BY id DESC LIMIT ".$start.",".$itemPerPage."");
$count = $db->query("SELECT COUNT(*) FROM wd WHERE usr='".$uid."'")->fetch();
$boxtext = "WITHDRAW LOG";
?>




<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-list"></i>  <?php echo "$boxtext"; ?> 
</div>

</div>

<div class="portlet-body">


<?php 
if ($count[0]!=0) {
 ?>


<div class="table-scrollable">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th> # </th>
<th> DATE </th>
<th> METHOD </th>
<th> AMOUNT </th>
<th> CHARGE </th>
<th> Transaction ID </th>
<th> STATUS </th>
</tr>
</thead>
<tbody>

<?php
$i = 1;
while ($data = $ddaa->fetch()) {

if ($data[8]==0) {
$cls= "warning";
$st = '<span class="btn btn-warning"> PENDING </span>';
}

if ($data[8]==1) {
$cls= "success";
$st = '<span class="btn btn-success"> PROCESSED </span>';
}

if ($data[8]==2) {
$cls= "danger";
$st = '<span class="btn btn-danger"> REFUNDED </span>';
}

$dt = date("dS F Y - h:i A ", $data[5]);
$method = $db->query("SELECT name  FROM wd_method WHERE id='".$data[1]."'")->fetch();

echo "
<tr class=\"$cls\">
<td> $i </td>
<td> $dt </td>
<td> $method[0] </td>
<td> $data[3] $basecurrency </td>
<td> $data[4] $basecurrency </td>
<td> $data[9] </td>
<td> $st </td>
</tr>
";


$i++;
}
?>

</tbody>
</table>
</div>


<?php
}else{

echo '<br><br><br><h1 class="text-center" style="font-weight: bold;">No Withdraw Log Found!</h1><br><br><br>';
}


 ?>
        



<!-- print pagination -->
<div class="row">
<div class="text-center">
<ul class="pagination">

<?php
if (!$_POST && $tpg>1){
echo "<br><br>";

$prevnum=$page-1;
$prev ="<li> <a href=\"$baseurl/WithdrawLog/$prevnum\"> &lt;&lt;</a> </li>";
if($page<="1"){
$prev ="<li class=\"disabled\"> <a href=\"#\"> &lt;&lt;</a> </li>";
}
echo $prev;

$pSt = $page-2;
if ($pSt<=1) {
$pSt = 1;
}

$pEnd = $pSt+4;
if ($pEnd > $tpg) {
$pEnd = $tpg;
}

$pSt = $pEnd-4;
if ($pSt<=1) {
$pSt = 1;
}

while ($pSt <= $pEnd) {

if ($pSt==$page) {
echo "<li class=\"active\"><a href=\"#\"> $pSt</a> </li> ";
}else{
echo "<li><a href=\"$baseurl/WithdrawLog/$pSt\"> $pSt</a> </li> ";
}

$pSt++;
}
$nextnum=$page+1;
$next ="<li> <a href=\"$baseurl/WithdrawLog/$nextnum\">&gt;&gt;</a> </li> ";
if($page>=$tpg){
$next ="<li class=\"disabled\"> <a href=\"#\">&gt;&gt;</a> </li> ";
}

echo $next;
}
?>
</ul>
</div>
</div><!-- row -->
<!-- END print pagination -->



</div>
</div>







<?php 
include('include-footer.php');
?>     
</body>
</html>