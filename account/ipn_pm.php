<?php
require_once('include-global.php');
$gatewayData = $db->query("SELECT val1, val2, name FROM deposit_method WHERE id='2'")->fetch();


$passphrase=strtoupper(md5($gatewayData[1]));


define('ALTERNATE_PHRASE_HASH',  $passphrase);
define('PATH_TO_LOG',  '/somewhere/out/of/document_root/');
$string=
      $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
      $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
      $_POST['PAYMENT_BATCH_NUM'].':'.
      $_POST['PAYER_ACCOUNT'].':'.ALTERNATE_PHRASE_HASH.':'.
      $_POST['TIMESTAMPGMT'];

$hash=strtoupper(md5($string));
$hash2 = $_POST['V2_HASH'];

if($hash==$hash2){

$amo = $_POST['PAYMENT_AMOUNT'];
$unit = $_POST['PAYMENT_UNITS'];
$depoistTrack = $_POST['PAYMENT_ID'];

$DepositData = $db->query("SELECT usid, method, amount, charge, amountus, status FROM deposit_data WHERE track='".$depoistTrack."'")->fetch();


if($_POST['PAYEE_ACCOUNT']=="$gatewayData[0]" && $unit=="USD" && $amo ==$DepositData[4]){


//////////---------------------------------------->>>> ADD THE BALANCE 
$ct = $db->query("SELECT mallu FROM users WHERE id='".$DepositData[0]."'")->fetch();
$ctn = $ct[0]+$DepositData[2];
$db->query("UPDATE users SET mallu='".$ctn."' WHERE id='".$DepositData[0]."'");
//////////---------------------------------------->>>> ADD THE BALANCE

$trx = $txn_id;

/////////////------------------------->>>>>>>>>>> UPDATE `deposit_data`
$db->query("UPDATE deposit_data SET trx='".$trx."', trx_ext='".$_POST['PAYMENT_BATCH_NUM']."', status='1' WHERE track='".$depoistTrack."'");

/////////////------------------------->>>>>>>>>>> TRX
$db->query("INSERT INTO trx SET who='".$DepositData[0]."', byy='000222', amount='".$DepositData[2]."', sig='+', typ='ADD MONEY VIA ".$gatewayData[2]."', charge='0', tm='".$tm."', trxid='".$trx."', refund='7'");


// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$DepositData[0]."'")->fetch();

$txt = "Your Deposit of $DepositData[2] $basecurrency via $gatewayData[2] Has Been Processed. Transcetion # $trx";
abiremail($su[3], "Deposited Successfully", $su[0], $txt);
abirsms($su[2], $txt);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS





}
}

?>


