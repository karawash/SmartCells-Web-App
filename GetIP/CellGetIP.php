<?php
require_once ('lib/nusoap.php');
require ('CellGetIPVar.php');
// This is your webservice server WSDL URL address
$wsdl = $IPserverwsdl . '?wsdl';

// create client object
$client = new nusoap_client ( $wsdl, 'wsdl' );

$err = $client->getError ();
if ($err) {
	// Display the error
	echo 'client construction error: ' . $err;
} else {
	
	$result1 = $client->call ( $IPservice );
}
print_r ( $result1 );

?>