<?php
class GetGeoProfileCell {
	protected $IPGeo = '132.33.43.4';
	private $Geoservice = 'GeoIP';
	private $Geoserverwsdl = 'http://localhost/myworks/Simulation/Geoinfo/DBIP_Client/clientInfo.php';
	// ='GetClientGeoContext';
	// ='http://localhost/myworks/Simulation/Geoinfo/GeoPlugin/geoplugin.php';
	function getIPGeo() {
		return $this->IPGeo;
	}
	function setIPGeo($IP) {
		$this->IPGeo = $IP;
	}
	function setGeoservice($servicename) {
		$this->$Geoservice = $servicename;
	}
	function getGeoservice() {
		return $this->Geoservice;
	}
	function setGeoserverwsdl($Geoserverwsdl) {
		$this->Geoserverwsdl = $Geoserverwsdl;
	}
	function getGeoserverwsdl() {
		return $this->Geoserverwsdl;
	}
	function getgeoprofile() {
		$contextGeo = stream_context_create ( array (
				'http' => array (
						'method' => 'POST',
						'header' => "Accept-language: en\r\n" . "Content-type: application/x-www-form-urlencoded\r\n",
						'content' => http_build_query ( array (
								'IPGeo' => $this->IPGeo
								 
						) ) 
				) 
		) );
		$CellGeoProfile = file_get_contents ( 'http://localhost/myworks/Simulation/Geoinfo/CellGeoProfile.php', false, $contextGeo );
		return $CellGeoProfile;
	}
	
	// print $this->getgeoprofile();
}
// $profile= new GetGeoProfileCell;
// print $profile->getgeoprofile();

if (isset ( $_POST ['commander2'] )) {
$NewGetGeoProfileCell= new GetGeoProfileCell();
$NewGetGeoProfileCell->setIPGeo($_POST['ipaddress']);
$result= $NewGetGeoProfileCell->getgeoprofile();
print $result;
return $result;
}
?>