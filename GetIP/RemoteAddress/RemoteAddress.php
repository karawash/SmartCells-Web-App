<?php
require_once ('../lib/nusoap.php');

$server = new nusoap_server ();
$namespace = 'server';
$server->configureWSDL ( $namespace, 'urn:' . $namespace . '' );

$server->wsdl->schemaTargetNamespace = $namespace;

// SOAP complex type return type (an array/struct)

$server->register ( 'RemoteIP', array (), // parameters
array (
		'return' => 'xsd:string' 
), // output
$namespace, // namespace
'urn:' . $namespace . '#send', // soapaction
'rpc', // style
'encoded', // use
'Check user login' ); // description
                     
// ///////////////////////////
function RemoteIP() {
	$source = 'http://canihazip.com';
	$c = file_get_contents ( $source );
	$ip = false;
	if (preg_match ( '/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $c, $m )) {
		$ip = $m [1];
	}
	return $ip;
}

// //////////////////////////////////

$HTTP_RAW_POST_DATA = isset ( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';

$server->service ( $HTTP_RAW_POST_DATA );

?>