<?php
include ("Mail.php");
// require('../MailVar.php');
require_once ('lib/nusoap.php');

$server = new nusoap_server ();
$namespace = 'server';
$server->configureWSDL ( $namespace, 'urn:' . $namespace . '' );

$server->wsdl->schemaTargetNamespace = $namespace;

// SOAP complex type return type (an array/struct)

$server->register ( 'LocalMailer', array (
		'smtp' => 'xsd:string',
		'port' => 'xsd:integer',
		'authSec' => 'xsd:string',
		'myemail' => 'xsd:string',
		'pass' => 'xsd:string',
		'Subject' => 'xsd:string',
		'fromName' => 'xsd:string',
		'To' => 'xsd:string',
		'toName' => 'xsd:string',
		'msg' => 'xsd:string' 
), // parameters
array (
		'return' => 'xsd:string' 
), // output
$namespace, // namespace
'urn:' . $namespace . '#LocalMailer', // soapaction
'rpc', // style
'encoded', // use
'Check user login' ); // description
function LocalMailer($smtp, $port, $authSec, $myemail, $pass, $Subject, $fromName, $To, $toName, $msg) {
	/* mail setup recipients, subject etc */
	$recipients = $To;
	$headers ["From"] = $myemail;
	$headers ["To"] = $To;
	$headers ["Subject"] = $Subject;
	$mailmsg = $msg;
	/* SMTP server name, port, user/passwd */
	$smtpinfo ["host"] = $smtp;
	$smtpinfo ["port"] = $port;
	$smtpinfo ["auth"] = true;
	$smtpinfo ["SMTPSecure"] = $authSec;
	$smtpinfo ["username"] = $myemail;
	$smtpinfo ["password"] = $pass;
	/* Create the mail object using the Mail::factory method */
	$mail_object = & Mail::factory ( "smtp", $smtpinfo );
	/* Ok send mail */
	if ($mail_object->send ( $recipients, $headers, $mailmsg ))
		return $msg;
	else
		return 'Error sending message';
}

$HTTP_RAW_POST_DATA = isset ( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';

$server->service ( $HTTP_RAW_POST_DATA );

?>