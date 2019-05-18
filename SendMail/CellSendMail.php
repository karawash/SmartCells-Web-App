<?php
require_once ('lib/nusoap.php');
require ('CellSendMailVar.php');
// This is your webservice server WSDL URL address
$wsdl = $mailserverwsdl . '?wsdl';

// create client object
$client = new nusoap_client ( $wsdl, 'wsdl' );

$err = $client->getError ();
if ($err) {
	// Display the error
	echo 'client construction error: ' . $err;
} else {
	// calling our first simple entry point
	$result1 = $client->call ( $mailservice, array (
			'smtp' => $smtp,
			'port' => $port,
			'authSec' => $authSec,
			'myemail' => $myemail,
			'pass' => $pass,
			'Subject' => $Subject,
			'fromName' => $fromName,
			'To' => $To,
			'toName' => $toName,
			'msg' => $msg 
	) );
}
print_r ( $result1 );

?>