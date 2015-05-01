<?php
/**
* API Class for the connection with vickythegme.com
*/
class Api 
{
	/* Contains the last API call. */
	public $url;
	/* Set up the API root URL. */
	public $host = "http://api.vickythegme.com/api/1";
	/* Set timeout default. */
	public $timeout = 30;
	
	/* Decode returned json data. */
	public $decode_json = TRUE;
	/* Set the useragnet. */
	public $useragent = 'VickythegmeAPI';
	public $http_info;
	public $http_code;
	/* Immediately retry the API call if the response was not successful. */
	//public $retry = TRUE;
	public function accessURL() { return "http://api.vickythegme.com/api/1"; }
	
	/**
	*	Method to get all the team details from the api
	*/
	public function getTeam() {
		$url = 'http://api.vickythegme.com/api/1/show';
		$data = '';
		$method = 'POST';
		$result = $this -> get_curl_output($url,$data,$method);
		return $result;
	}
	/**
	* 	Method to get the curl output
	*/
	public function get_curl_output($url, $data, $method) {
		$dat ='';
		$this -> http_info = array();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		if($data != '') {
			foreach ($data as $key => $value) {
				$dat .= $key.'='.$value.'&';
			}
			rtrim($dat,'&');
			curl_setopt($ch, CURLOPT_POST, count($data));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dat);
		}
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		$this->http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$this->http_info = array_merge($this->http_info, curl_getinfo($ch));
		$this->url = $url;
		curl_close($ch);
		return $result;
	}
}
?>
