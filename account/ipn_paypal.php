<?php
require_once('include-global.php');

$raw_post_data = file_get_contents('php://input');
    $raw_post_array = explode('&', $raw_post_data);
    $myPost = array();
    foreach ($raw_post_array as $keyval) {
        $keyval = explode ('=', $keyval);
        if (count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
    }


    $req = 'cmd=_notify-validate';
    if(function_exists('get_magic_quotes_gpc')) {
        $get_magic_quotes_exists = true;
    }
    foreach ($myPost as $key => $value) {
        if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            $value = urlencode(stripslashes($value));
        } else {
            $value = urlencode($value);
        }
        $req .= "&$key=$value";
    }


    // $paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
    $paypalURL = "https://secure.paypal.com/cgi-bin/webscr";
    $ch = curl_init($paypalURL);
    if ($ch == FALSE) {
        return FALSE;
    }
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
    $res = curl_exec($ch);
    $tokens = explode("\r\n\r\n", trim($res));
    $res = trim(end($tokens));



    if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {


$receiver_email   = $_POST['receiver_email'];
$mc_currency    = $_POST['mc_currency'];
$depoistTrack       = $_POST['custom'];
$mc_gross     = $_POST['mc_gross'];

$gatewayData = $db->query("SELECT val1, val2, name FROM deposit_method WHERE id='1'")->fetch();

$DepositData = $db->query("SELECT usid, method, amount, charge, amountus, status FROM deposit_data WHERE track='".$depoistTrack."'")->fetch();



if($receiver_email=="$gatewayData[0]" && $mc_currency=="USD" && $mc_gross ==$DepositData[4]){


//////////---------------------------------------->>>> ADD THE BALANCE 
$ct = $db->query("SELECT mallu FROM users WHERE id='".$DepositData[0]."'")->fetch();
$ctn = $ct[0]+$DepositData[2];
$db->query("UPDATE users SET mallu='".$ctn."' WHERE id='".$DepositData[0]."'");
//////////---------------------------------------->>>> ADD THE BALANCE

$trx = $txn_id;

/////////////------------------------->>>>>>>>>>> UPDATE `deposit_data`
$db->query("UPDATE deposit_data SET trx='".$trx."', trx_ext='".$_POST['ipn_track_id']."', status='1' WHERE track='".$depoistTrack."'");

/////////////------------------------->>>>>>>>>>> TRX
$db->query("INSERT INTO trx SET who='".$DepositData[0]."', byy='000111', amount='".$DepositData[2]."', sig='+', typ='ADD MONEY VIA ".$gatewayData[2]."', charge='0', tm='".$tm."', trxid='".$trx."', refund='7'");


// ///////////////////------------------------------------->>>>>>>>>Send Email AND SMS
$su = $db->query("SELECT firstname, lastname, mobile, email FROM users WHERE id='".$DepositData[0]."'")->fetch();

$txt = "Your Deposit of $DepositData[2] $basecurrency via $gatewayData[2] Has Been Processed. Transcetion # $trx";
abiremail($su[3], "Deposited Successfully", $su[0], $txt);
abirsms($su[2], $txt);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS


}


    }

 ?>