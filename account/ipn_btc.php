<?php
require_once('include-global.php');
$gatewayData = $db->query("SELECT val1, val2, name FROM deposit_method WHERE id='3'")->fetch();

$depoistTrack = $_GET['invoice_id'];
$secret = $_GET['secret'];
$address = $_GET['address'];
$value = $_GET['value'];
$confirmations = $_GET['confirmations'];
$value_in_btc = $_GET['value'] / 100000000;

$trx_hash = $_GET['transaction_hash'];

$DepositData = $db->query("SELECT usid, method, amount, charge, amountus, status, bcam, bcid FROM deposit_data WHERE track='".$depoistTrack."'")->fetch();


if ($DepositData[5]!=1) {

	if ($DepositData[6]==$value_in_btc && $DepositData[7]==$address && $secret=="ABIR" && $confirmations>2){




//////////---------------------------------------->>>> ADD THE BALANCE 
		$ct = $db->query("SELECT mallu FROM users WHERE id='".$DepositData[0]."'")->fetch();
		$ctn = $ct[0]+$DepositData[2];
		$db->query("UPDATE users SET mallu='".$ctn."' WHERE id='".$DepositData[0]."'");
//////////---------------------------------------->>>> ADD THE BALANCE

		$trx = $txn_id;

/////////////------------------------->>>>>>>>>>> UPDATE `deposit_data`
		$db->query("UPDATE deposit_data SET trx='".$trx."', trx_ext='".$trx_hash."', status='1' WHERE track='".$depoistTrack."'");

/////////////------------------------->>>>>>>>>>> TRX
		$db->query("INSERT INTO trx SET who='".$DepositData[0]."', byy='000333', amount='".$DepositData[2]."', sig='+', typ='ADD MONEY VIA ".$gatewayData[2]."', charge='0', tm='".$tm."', trxid='".$trx."', refund='7'");


// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
		$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$DepositData[0]."'")->fetch();

		$txt = "Your Deposit of $DepositData[2] $basecurrency via $gatewayData[2] Has Been Processed. Transcetion # $trx";
		abiremail($su[3], "Deposited Successfully", $su[0], $txt);
		abirsms($su[2], $txt);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS


	}

}//Already Done ?
?>