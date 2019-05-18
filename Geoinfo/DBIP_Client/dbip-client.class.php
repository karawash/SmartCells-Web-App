<?php
class DBIP_Client_Exception extends Exception {
}
class DBIP_Client {
	private $base_url = "http://api.db-ip.com/";
	private $api_key;
	public function __construct($api_key, $base_url = null) {
		$this->api_key = $api_key;
		
		if (isset ( $base_url )) {
			$this->base_url = $base_url;
		}
	}
	protected function Do_API_Call($method, $params = array()) {
		$qp = array (
				"api_key=" . $this->api_key 
		);
		foreach ( $params as $k => $v ) {
			$qp [] = $k . "=" . urlencode ( $v );
		}
		
		$url = $this->base_url . $method . "?" . implode ( "&", $qp );
		
		if (! $jdata = @file_get_contents ( $url )) {
			throw new DBIP_Client_Exception ( "{$method}: unable to fetch URL: {$url}" );
		}
		
		if (! $data = @json_decode ( $jdata )) {
			throw new DBIP_Client_Exception ( "{$method}: error decoding server response" );
		}
		
		// if ($data->error) {
		// throw new DBIP_Client_Exception("{$method}: server reported an error: {$data->error}");
		// }
		
		return $data;
	}
	public function Get_Address_Info($addr) {
		return $this->Do_API_Call ( "addrinfo", array (
				"addr" => $addr 
		) );
	}
	public function Get_Key_Info() {
		return $this->Do_API_Call ( "keyinfo" );
	}
}

?>