<?php
require_once ('geoplugin.class.php');
require_once ('../lib/nusoap.php');

$server = new nusoap_server ();
$namespace = 'server';
$server->configureWSDL ( $namespace, 'urn:' . $namespace . '' );

$server->wsdl->schemaTargetNamespace = $namespace;

// SOAP complex type return type (an array/struct)

$server->wsdl->addComplexType ( 'GeoContext', 'complexType', 'struct', 'all', '', array (
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

$server->register ( 'GetClientGeoContext', array (
		'IP' => 'xsd:string' 
), // parameters
array (
		'return' => 'tns:GeoContext' 
), // output
$namespace, // namespace
'urn:' . $namespace . '#GeoContext', // soapaction
'rpc', // style
'encoded', // use
'Check user login' ); // description
function GetClientGeoContext($IP) {
	$geoplugin = new geoPlugin ();
	
	$IPgeo = $IP;
	// locate the IP
	$geoplugin->locate ( $IPgeo );
	
	return array (
			'address' => $geoplugin->ip,
			'country' => $geoplugin->countryName,
			'region' => $geoplugin->region,
			'city' => $geoplugin->city 
	);
}

$HTTP_RAW_POST_DATA = isset ( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';
$server->service ( $HTTP_RAW_POST_DATA );
?>