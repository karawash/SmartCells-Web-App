<?php
class SendMailCell {
	protected $mailservice = 'send'; // 'PHPMailer'; 'LocalMailer';
	protected $mailserverwsdl = 'http://localhost/myworks/Simulation/SendMail/Swiftmailer/SendMail.php';
	// ='http://localhost/myworks/Simulation/SendMail/PHPMailer/PHPMailerMaster.php';
	// ='http://localhost/myworks/Simulation/SendMail/MailwithLocalPHP/MailwithLocalPHP.php';
	private $smtp = 'smtp.gmail.com';
	private $port = 587;
	private $authSec = 'tls';
	private $myemail = '';
	private $pass = '';
	private $To = 'ahmad_karawash@hotmail.com';
	private $msg = '<br> Sender\'s Context-Profile:<br>'; // put ''.$message.'<br> Sender\'s Context-Profile:<br>'.$CellGeoProfile.''
	private $Subject = "salam";
	private $fromName = "Ahmad karawash";
	private $toName = "A name";
	
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
	function Sendmail() {
		$contextMail = stream_context_create ( array (
				'http' => array (
						'method' => "POST",
						'header' => "Accept-language: en\r\n" . "Content-type: application/x-www-form-urlencoded\r\n",
						'content' => http_build_query ( array (
								'smtp' => $this->smtp,
								'port' => $this->port,
								'authSec' => $this->authSec,
								'myemail' => $this->myemail,
								'pass' => $this->pass,
								'To' => $this->To,
								'msg' => $this->msg,
								'Subject' => $this->Subject,
								'fromName' => $this->fromName,
								'toName' => $this->toName
								
						) ) 
				) 
		) );
		$CellSendMail = file_get_contents ( 'http://localhost/myworks/Simulation/SendMail/CellSendMail.php', false, $contextMail );
		//print $CellSendMail;
		return $CellSendMail;
	}
}


if(isset($_POST['commander4'])){
	$NewSendmail= new SendMailCell;
	$NewSendmail->setsmtp($_POST['smtp']);
	$NewSendmail->setmyemail ( $_POST['myemail'] );
	$NewSendmail->setpass ( $_POST['pass'] );
	$NewSendmail->setport ( $_POST['port'] );
	$NewSendmail->setauthSec($_POST['authSec'] );
	$NewSendmail->setsubject ( $_POST['Subject'] );
	$NewSendmail->setTo ( $_POST['To'] );
	$NewSendmail->settoName ( $_POST['toName']);
	$NewSendmail->setmsg($_POST['msg']);
	$NewSendmail->setfromname($_POST['fromName']);
	return $NewSendmail->Sendmail ();
}
?>