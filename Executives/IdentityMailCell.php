<?php

require 'GetIPCell.php';
require 'GetGeoProfileCell.php';
require 'SendMailCell.php';
class IdentityMailCell {
	private $smtp = 'smtp.gmail.com';
	private $port = 587;
	private $authSec = 'tls';
	private $myemail = '';
	private $pass = '';
	private $To = 'ahmad_karawash@hotmail.com';
	private $Subject = "salam";
	private $fromName = "Ahmad karawash";
	private $toName = "A name";
	private $msg = ' Hello !...
		
		
		 
		This is the result of my SmartCells simulation
		
		
		
		Regards,
		Ahmad Karawash';
	
	function getmessage() {
		return $this->message;
	}
	function setmessage($message) {
		$this->message = $message;
	}
	function getmailservice() {
		return $this->mailservice;
	}
	function setmailservice($mailservice) {
		$this->mailservice = $mailservice;
	}
	function getmailserverwsdl() {
		return $this->mailserverwsdl;
	}
	function setmailserverwsdl($mailserverwsdl) {
		$this->mailserverwsdl = $mailserverwsdl;
	}
	function getsmtp() {
		return $this->smtp;
	}
	function setsmtp($smtp) {
		$this->smtp = $smtp;
	}
	function getport() {
		return $this->port;
	}
	function setport($port) {
		$this->port = $port;
	}
	function getauthSec() {
		return $this->authSec;
	}
	function setauthSec($authSec) {
		$this->authSec = $authSec;
	}
	function getmyemail() {
		return $this->myemail;
	}
	function setmyemail($email) {
		$this->myemail = $email;
	}
	function getpass() {
		return $this->pass;
	}
	function setpass($pass) {
		$this->pass = $pass;
	}
	function getTo() {
		return $this->To;
	}
	function setTo($to) {
		$this->To = $to;
	}
	function getmsg() {
		return $this->msg;
	}
	function setmsg($msg) {
		$this->msg = $msg;
	}
	function getsubject() {
		return $this->Subject;
	}
	function setsubject($subject) {
		$this->Subject = $subject;
	}
	function getfromname() {
		return $this->fromName;
	}
	function setfromname($fromname) {
		$this->fromName = $fromname;
	}
	function gettoName() {
		return $this->toName;
	}
	function settoName($toName) {
		$this->toName = $toName;
	}
	function Identitymailprocess() {
		$GetIp = new GetIPCell ();
		$GetGeoProfile = new GetGeoProfileCell ();
		$GetGeoProfile->setIPGeo ( $GetIp->getip () );
		$SendMail = new SendMailCell ();
		$SendMail->setauthSec ( $this->authSec );
		$SendMail->setfromname ( $this->fromName );
		$SendMail->setmessage ( $this->msg );
		$SendMail->setmsg ( '' . 

		$SendMail->getmessage () . '
				
		Sender\'s Context-Profile:
		
		' . $GetGeoProfile->getgeoprofile () . '' );
		$SendMail->setmyemail ( $this->myemail );
		$SendMail->setpass ( $this->pass );
		$SendMail->setport ( $this->port );
		$SendMail->setsmtp ( $this->smtp );
		$SendMail->setsubject ( $this->Subject );
		$SendMail->setTo ( $this->To );
		$SendMail->settoName ( $this->toName );
		if($SendMail->Sendmail())
		return 'done';
	}
}


if (isset ( $_POST ['commander'] )) {
	
	$NewSendmail = new IdentityMailCell ();
	$NewSendmail->setsmtp ( $_POST ['smtp'] );
	$NewSendmail->setmyemail ( $_POST ['myemail'] );
	$NewSendmail->setpass ( $_POST ['pass'] );
	$NewSendmail->setport ( $_POST ['port'] );
	$NewSendmail->setauthSec ( $_POST ['authSec'] );
	$NewSendmail->setsubject ( $_POST ['Subject'] );
	$NewSendmail->setTo ( $_POST ['To'] );
	$NewSendmail->settoName ( $_POST ['toName'] );
	$NewSendmail->setmsg ( $_POST ['msg'] );
	$NewSendmail->setfromname ( $_POST ['fromName'] );
	
	if($NewSendmail->Identitymailprocess ())
		print 'Message is recievde and the Sender context-Profile is detected';
}

?>