<?php
require_once ('../lib/nusoap.php');

$server = new nusoap_server ();
$namespace = 'server';
$server->configureWSDL ( $namespace, 'urn:' . $namespace . '' );

$server->wsdl->schemaTargetNamespace = $namespace;

// SOAP complex type return type (an array/struct)

$server->register ( 'get_external_ip', array (), // parameters
array (
		'return' => 'xsd:string' 
), // output
$namespace, // namespace
'urn:' . $namespace . '#send', // soapaction
'rpc', // style
'encoded', // use
'Check user login' ); // description
function get_external_ip() {
	$ch = curl_init ( "http://icanhazip.com/" );
	curl_setopt ( $ch, CURLOPT_HEADER, FALSE );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	$result = curl_exec ( $ch );
	curl_close ( $ch );
	// return trim($result);
	if ($result == FALSE) {
		return "ERROR";
	} else {
		return trim ( $result );
	}
}

// /$extADD= new ExternalAddress();

// print $extADD->get_external_ip();
$HTTP_RAW_POST_DATA = isset ( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';

$server->service ( $HTTP_RAW_POST_DATA );
?>