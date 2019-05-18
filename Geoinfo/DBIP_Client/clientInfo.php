<?php
require "dbip-client.class.php";
require_once ('../lib/nusoap.php');

$server = new nusoap_server ();
$namespace = 'server';
$server->configureWSDL ( $namespace, 'urn:' . $namespace . '' );

$server->wsdl->schemaTargetNamespace = $namespace;

// SOAP complex type return type (an array/struct)

$server->wsdl->addComplexType ( 'GeoProfile', 'complexType', 'struct', 'all', '', array (
		'address' => array (
				'name' => 'address',
				'type' => 'xsd:string' 
		),
		'country' => array (
				'name' => 'country',
				'type' => 'xsd:string' 
		),
		'region' => array (
				'name' => 'region',
				'type' => 'xsd:string' 
		),
		'city' => array (
				'name' => 'city',
				'type' => 'xsd:string' 
		) 
) );

$server->register ( 'GeoIP', array (
		'IP' => 'xsd:string' 
), // parameters
array (
		'return' => 'tns:GeoProfile' 
), // output
$namespace, // namespace
'urn:' . $namespace . '#GeoIP', // soapaction
'rpc', // style
'encoded', // use
'Check user login' ); // description
function GeoIP($IP) {
	$ip_addr = $IP or die ( "usage: {$argv[0]} <ip_address>\n" );
	
	$api_key = "a5cc462d77e4a5c375675ca36279993e2409358e";
	$dbip = new DBIP_Client ( $api_key );
	
	return array (
			'address' => $dbip->Get_Address_Info ( $ip_addr )->address,
			'country' => $dbip->Get_Address_Info ( $ip_addr )->country,
			'region' => $dbip->Get_Address_Info ( $ip_addr )->stateprov,
			'city' => $dbip->Get_Address_Info ( $ip_addr )->city 
	);
}
$HTTP_RAW_POST_DATA = isset ( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';
$server->service ( $HTTP_RAW_POST_DATA );

?>
