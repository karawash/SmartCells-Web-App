<?php
require_once ('../lib/nusoap.php');

$server = new nusoap_server ();
$namespace = 'server';
$server->configureWSDL ( $namespace, 'urn:' . $namespace . '' );

$server->wsdl->schemaTargetNamespace = $namespace;

// SOAP complex type return type (an array/struct)

$server->register ( 'get_client_ip_env', array (), // parameters
array (
		'return' => 'xsd:string' 
), // output
$namespace, // namespace
'urn:' . $namespace . '#send', // soapaction
'rpc', // style
'encoded', // use
'Check user login' ); // description
                     
// Function to get the client ip address
function get_client_ip_env() {
	$ipaddress = '';
	if (getenv ( 'HTTP_CLIENT_IP' ))
		$ipaddress = getenv ( 'HTTP_CLIENT_IP' );
	else if (getenv ( 'HTTP_X_FORWARDED_FOR' ))
		$ipaddress = getenv ( 'HTTP_X_FORWARDED_FOR' );
	else if (getenv ( 'HTTP_X_FORWARDED' ))
		$ipaddress = getenv ( 'HTTP_X_FORWARDED' );
	else if (getenv ( 'HTTP_FORWARDED_FOR' ))
		$ipaddress = getenv ( 'HTTP_FORWARDED_FOR' );
	else if (getenv ( 'HTTP_FORWARDED' ))
		$ipaddress = getenv ( 'HTTP_FORWARDED' );
	else if (getenv ( 'REMOTE_ADDR' ))
		$ipaddress = getenv ( 'REMOTE_ADDR' );
	else
		$ipaddress = 'UNKNOWN';
	
	return $ipaddress;
}

$HTTP_RAW_POST_DATA = isset ( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';

$server->service ( $HTTP_RAW_POST_DATA );
// echo 'Your IP address (using $_SERVER[\'REMOTE_ADDR\']) is ' . $ipaddress . '<br />';
// echo 'Your IP address (using get_client_ip_env function) is ' . $class->get_client_ip_env() . '<br />';
?>
	