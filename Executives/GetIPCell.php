<?php
class GetIPCell {
	private $IPservice = 'get_external_ip';
	private $IPserverwsdl = 'http://localhost/myworks/Simulation/GetIP/GetExternalIP/ExternalAddress.php';
	
	// Private $IPservice='get_client_ip_env';
	// Private $IPserverwsdl = 'http://localhost/myworks/Simulation/GetIP/RealIP/RealIP.php';
	
	// Private $IPservice='RemoteIP';
	// Private $IPserverwsdl = 'http://localhost/myworks/Simulation/GetIP/RemoteAddress/RemoteAddress.php';
	function setIPservice($IPservice) {
		$this->IPservice = $IPservice;
	}
	function getIPservice() {
		return $this->IPservice;
	}
	function setIPserverwsdl($IPserverwsdl) {
		$this->IPserverwsdl = $IPserverwsdl;
	}
	function getIPserverwsdll() {
		return $this->IPserverwsdl;
	}
	function getip() {
		// /selection of executer gene is done by each Cell
		$contextIP = stream_context_create ( array (
				'http' => array (
						'method' => 'POST',
						'header' => "Accept-language: en\r\n" . "Content-type: application/x-www-form-urlencoded\r\n",
						'content' => http_build_query ( array (
								'IPservice' => $this->IPservice
								
						) ) 
				) 
		) );
		$CellGetIP = file_get_contents ( 'http://localhost/myworks/Simulation/GetIP/CellGetIP.php', false, $contextIP );
		///print 'hi';
		return $CellGetIP;
	}
}

if (isset ( $_POST ['commander3'] )) {
	
	$NewGetIPCell = new GetIPCell ();
	
	$result= $NewGetIPCell->getip ();
	print $result;
	return $result;
}

?>